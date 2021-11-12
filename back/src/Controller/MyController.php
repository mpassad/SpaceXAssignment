<?php


namespace App\Controller;

use App\Entity\Launch;
use App\Entity\Rocket;
// use Requests;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MyController extends AbstractController
{
    // public function index(Request $request)
    // {
    //     $launches = Requests::get('https://api.spacexdata.com/v5/launches');
    //     $rockets = Requests::get('https://api.spacexdata.com/v4/rockets');
    //     // dump($request);
    //     $decoded_launches = json_decode($launches->body, false, 512, JSON_UNESCAPED_UNICODE);
    //     $decoded_rockets = json_decode($launches->body, false, 512, JSON_UNESCAPED_UNICODE);
    //     // dump($decoded_launches[0]);
    //     // dump($decoded_rockets[0]);
    //     return new JsonResponse($decoded_launches, 200, array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin'=> '*'));
    // }

    // public function tester(Request $request)
    // {
    //     $json_to_return = null;

    //     if ($request->getMethod() == "POST") {
    //         $launches = Requests::get('https://api.spacexdata.com/v5/launches');
    //         $rockets = Requests::get('https://api.spacexdata.com/v4/rockets');

    //         // dump($request);
    //         $decoded_launches = json_decode($launches->body, false, 512, JSON_UNESCAPED_UNICODE);
    //         $decoded_rockets = json_decode($rockets->body, false, 512, JSON_UNESCAPED_UNICODE);
    //         $json_to_return = array(
    //             'launches' => $decoded_launches,
    //             'rockets' => $decoded_rockets
    //         );
    //         $status = 200;
    //     } else {
    //         $json_to_return = ['details' => 'Only POST method is accepted'];
    //         $status = 400;
    //     }

    //     // dump($request->getContent());
    //     $data = json_decode($request->getContent(), false, 512, JSON_UNESCAPED_UNICODE);

    //     return new JsonResponse($json_to_return, $status, array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin'=> '*'));
    // }
    /**
     * @Route("/launch/edit", name="launch")
     */
    public function editLaunch(Request $request)
    {

        if ($request->getMethod() == "GET") {
            $launch = $this->getDoctrine()->getRepository(Launch::class)->findOneBy(array('id'=>(int)$request->query->get('id')));
            $em = $this->getDoctrine()->getManager();
            $launch->setName($request->query->get('name'));
            $date = new \DateTime($request->query->get('date'));
            $launch->setDateUtc($date);
            $em->persist($launch);
            $em->flush();

            $data_to = json_decode($request->getContent(), false, 512, JSON_UNESCAPED_UNICODE);
        } else {
            $data_to = ['details' => 'Only POST method is accepted'];
            $status = 400;
        }

        return new JsonResponse($data_to, 200, array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin'=> '*'));
    }
    /**
     * @Route("/rockets", name="rockets")
     */
    public function getRockets(Request $request)
    {
        $rockets = $this->getDoctrine()->getRepository(Rocket::class)->findAll();
        $rockets_json = array();
        foreach ($rockets as $rocket) {
            $rockets_json[] = array(
                "value" => $rocket->getId(),
                "label" =>  $rocket->getName()
            );
        }
        return new JsonResponse($rockets_json, 200, array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin'=> '*'));
    }
    /**
     * @Route("/launches", name="launches")
     */
    public function getLaunches(Request $request)
    {
        $from = null;
        $to = null;
        $sort = 'ASC';
        $rocket = null;
        if($request->query->get('from') != '' && $request->query->get('from') != null){
            $from = \DateTime::createFromFormat('Y-m-d', $request->query->get('from'));
        }
        if($request->query->get('to') != '' && $request->query->get('to') != null){
            $to = \DateTime::createFromFormat('Y-m-d', $request->query->get('to'));
        }
        if($request->query->get('sort') != null){
            $sort = $request->query->get('sort');
        }
        if($request->query->get('rocket') != null){
            $rocket_id= $request->query->get('rocket');
        }
        if ($request->query->get('rocket') != null && $request->query->get('rocket') != '0' ){
            $rocket = $this->getDoctrine()->getRepository(Rocket::class)->findOneBy(array('id'=>(int)$rocket_id));
        }
        $launches = $this->getDoctrine()->getRepository(Launch::class)->findBetweenDates($from = $from, $to= $to ,$order_by=$sort, $rocket = $rocket);
        $launches_json = array();
        foreach ($launches as $launch) {
            $launches_json[] = array(
                "id" => $launch->getId(),
                "name" =>  $launch->getName(),
                "image" => $launch->getImage(),
                "date" => $launch->getDateUtc()
            );
        }
        return new JsonResponse($launches_json, 200, array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin'=> '*'));
    }
}
