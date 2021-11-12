<?php

namespace App\Command;

use Requests;
use Symfony\Component\Console\Command\Command;
use App\Entity\Launch;
use App\Entity\Rocket;
use App\Controller\PopulateController;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
// 1. Import the ORM EntityManager Interface
use Doctrine\ORM\EntityManagerInterface;

class PopulateDataCommand extends Command
{
    private $container;
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:pop_data';
    protected static $defaultDescription = 'Generates the data for the api.';
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        // 3. Update the value of the private entityManager variable through injection
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('This command generates the data for the db');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $launches = Requests::get('https://api.spacexdata.com/v5/launches');
        $rockets = Requests::get('https://api.spacexdata.com/v4/rockets');
        $em = $this->entityManager;

        if ($rockets->status_code == 200) {
            $data = json_decode($rockets->body, false, 512, JSON_UNESCAPED_UNICODE);
            foreach ($data as $row){
                $rocket = new Rocket();
                $rocket->setHeight($row->height->meters);
                $rocket->setDiameter($row->diameter->meters);
                $rocket->setMass($row->mass->kg);
                if(count($row->flickr_images) != 0){
                    $images_list = $row->flickr_images;
                    $rocket->setImage($images_list[0]);
                }else{
                    $rocket->setImage(NULL);
                }
                $rocket->setName($row->name);
                $rocket->setType($row->type);
                $rocket->setActive($row->active);
                $rocket->setStages($row->stages);
                $rocket->setBoosters($row->boosters);
                $rocket->setCostPerLaunch($row->cost_per_launch);
                $rocket->setSuccessRatePct($row->success_rate_pct);
                $date_format = \DateTime::createFromFormat('Y-m-d', $row->first_flight);
                $rocket->setFirstFlight($date_format);
                $rocket->setCountry($row->country);
                $rocket->setCompany($row->company);
                $rocket->setWikipedia($row->wikipedia);
                $rocket->setDescription($row->description);
                $rocket->setApiId($row->id);
                $em->persist($rocket);
                $em->flush();
                unset($rocket);
    
            }
            $output->writeln('Launches successfully generated!');
            // $pop_controller = new PopulateController();
            // $pop_controller->storeLaunches($data);
            $done_rockets = true;
        }

        $repo = $em->getRepository("App:Rocket");
        if ($launches->status_code == 200) {
            $data = json_decode($launches->body, false, 512, JSON_UNESCAPED_UNICODE);
            $launch = new Launch();
            foreach($data as $row){
                $rocket = $repo->findBy(['apiId' => $row->rocket]);
                $launch = new Launch();
                $launch->setRocket($rocket[0]);
                $launch->setImage($row->links->patch->small);
                $launch->setPresskit($row->links->presskit);
                $launch->setWebcast($row->links->webcast);
                $launch->setArticle($row->links->article);
                $launch->setWikipedia($row->links->wikipedia);
                if ($row->static_fire_date_utc == NULL){
                    $date_time = NULL;
                }else{
                    $date_time = new \DateTime($row->static_fire_date_utc);
                }
                $launch->setStaticFireDateUtc($date_time);
                $launch->setSuccess($row->success);
                $launch->setDetails($row->details);
                $launch->setPayloads($row->payloads);
                $launch->setFlightNumber($row->flight_number);
                $launch->setName($row->name);
                if ($row->date_utc == NULL){
                    $date_time_utc = NULL;
                }else{
                    $date_time_utc = new \DateTime($row->date_utc);
                }
                $launch->setDateUtc($date_time_utc);
                $launch->setUpcoming($row->upcoming);
                $launch->setApiId($row->id);
                $em->persist($launch);
                $em->flush();
            }
            $output->writeln('Rockets successfully generated!');

            $done_launches = true;
        }

        if ($done_rockets == true && $done_launches == true) {
            return Command::SUCCESS;
        }
        return Command::FAILURE;
    }
}
