<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LaunchRepository")
 */
class Launch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rocket", inversedBy="launches")
     */
    private $rocket;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $presskit;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $webcast;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $article;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $wikipedia;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $staticFireDateUtc;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $success;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $details;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $payloads = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $flightNumber;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateUtc;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $upcoming;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $apiId;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPresskit(): ?string
    {
        return $this->presskit;
    }

    public function setPresskit(?string $presskit): self
    {
        $this->presskit = $presskit;

        return $this;
    }

    public function getWebcast(): ?string
    {
        return $this->webcast;
    }

    public function setWebcast(?string $webcast): self
    {
        $this->webcast = $webcast;

        return $this;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(?string $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getWikipedia(): ?string
    {
        return $this->wikipedia;
    }

    public function setWikipedia(?string $wikipedia): self
    {
        $this->wikipedia = $wikipedia;

        return $this;
    }

    public function getStaticFireDateUtc(): ?\DateTimeInterface
    {
        return $this->staticFireDateUtc;
    }

    public function setStaticFireDateUtc(?\DateTimeInterface $staticFireDateUtc): self
    {
        $this->staticFireDateUtc = $staticFireDateUtc;

        return $this;
    }


    public function getSuccess(): ?bool
    {
        return $this->success;
    }

    public function setSuccess(?bool $success): self
    {
        $this->success = $success;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getPayloads(): ?array
    {
        return $this->payloads;
    }

    public function setPayloads(?array $payloads): self
    {
        $this->payloads = $payloads;

        return $this;
    }

    public function getFlightNumber(): ?int
    {
        return $this->flightNumber;
    }

    public function setFlightNumber(?int $flightNumber): self
    {
        $this->flightNumber = $flightNumber;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDateUtc(): ?\DateTimeInterface
    {
        return $this->dateUtc;
    }

    public function setDateUtc(?\DateTimeInterface $dateUtc): self
    {
        $this->dateUtc = $dateUtc;

        return $this;
    }

    public function getUpcoming(): ?bool
    {
        return $this->upcoming;
    }

    public function setUpcoming(?bool $upcoming): self
    {
        $this->upcoming = $upcoming;

        return $this;
    }

    public function getApiId(): ?string
    {
        return $this->apiId;
    }

    public function setApiId(?string $apiId): self
    {
        $this->apiId = $apiId;

        return $this;
    }
    public function getRocket(): ?Rocket
    {
        return $this->rocket;
    }

    public function setRocket(?Rocket $rocket): self
    {
        $this->rocket = $rocket;

        return $this;
    }
}
