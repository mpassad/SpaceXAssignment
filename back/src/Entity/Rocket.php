<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RocketRepository")
 */
class Rocket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Launch", mappedBy="rocket")
     */
    private $launches;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $diameter;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mass;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stages;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $boosters;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $costPerLaunch;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $successRatePct;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $firstFlight;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $wikipedia;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $apiId;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getDiameter(): ?float
    {
        return $this->diameter;
    }

    public function setDiameter(?float $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    public function getMass(): ?float
    {
        return $this->mass;
    }

    public function setMass(?float $mass): self
    {
        $this->mass = $mass;

        return $this;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getStages(): ?int
    {
        return $this->stages;
    }

    public function setStages(?int $stages): self
    {
        $this->stages = $stages;

        return $this;
    }

    public function getBoosters(): ?int
    {
        return $this->boosters;
    }

    public function setBoosters(?int $boosters): self
    {
        $this->boosters = $boosters;

        return $this;
    }

    public function getCostPerLaunch(): ?float
    {
        return $this->costPerLaunch;
    }

    public function setCostPerLaunch(?float $costPerLaunch): self
    {
        $this->costPerLaunch = $costPerLaunch;

        return $this;
    }

    public function getSuccessRatePct(): ?float
    {
        return $this->successRatePct;
    }

    public function setSuccessRatePct(?float $successRatePct): self
    {
        $this->successRatePct = $successRatePct;

        return $this;
    }

    public function getFirstFlight(): ?\DateTimeInterface
    {
        return $this->firstFlight;
    }

    public function setFirstFlight(?\DateTimeInterface $firstFlight): self
    {
        $this->firstFlight = $firstFlight;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function __construct()
    {
        $this->launches = new ArrayCollection();
    }

    /**
     * @return Collection|Launch[]
     */
    public function getLaunches(): Collection
    {
        return $this->launches;
    }

    public function addLaunch(Launch $launch): self
    {
        if (!$this->launch->contains($launch)) {
            $this->launch[] = $launch;
            $launch->setRocket($this);
        }
        return $this;
    }
    public function removeLaunch(Launch $launch): self
    {
        if ($this->launch->contains($launch)) {
            $this->launch->removeElement($launch);
            // set the owning side to null (unless already changed)
            if ($launch->getRocket() === $this) {
                $launch->getRocket(null);
            }
        }
        return $this;
    }

}
