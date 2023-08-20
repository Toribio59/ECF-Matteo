<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScheduleRepository::class)
 */
class Schedule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $mondayOTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $mondayCTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $mondayOTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $mondayCTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $tuesdayOTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $tuesdayCTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $tuesdayOTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $tuesdayCTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $wednesdayOTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $wednesdayCTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $wednesdayOTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $wednesdayCTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $thursdayOTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $thursdayCTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $thursdayOTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $thursdayCTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $fridayOTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $fridayCTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $fridayOTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $fridayCTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $saturdayOTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $saturdayCTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $saturdayOTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $saturdayCTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $sundayOTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $sundayCTM;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $sundayOTA;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $sundayCTA;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMondayOTM(): ?string
    {
        return $this->mondayOTM;
    }

    public function setMondayOTM(?string $mondayOTM): self
    {
        $this->mondayOTM = $mondayOTM;

        return $this;
    }

    public function getMondayCTM(): ?string
    {
        return $this->mondayCTM;
    }

    public function setMondayCTM(?string $mondayCTM): self
    {
        $this->mondayCTM = $mondayCTM;

        return $this;
    }

    public function getMondayOTA(): ?string
    {
        return $this->mondayOTA;
    }

    public function setMondayOTA(?string $mondayOTA): self
    {
        $this->mondayOTA = $mondayOTA;

        return $this;
    }

    public function getMondayCTA(): ?string
    {
        return $this->mondayCTA;
    }

    public function setMondayCTA(?string $mondayCTA): self
    {
        $this->mondayCTA = $mondayCTA;

        return $this;
    }

    public function getTuesdayOTM(): ?string
    {
        return $this->tuesdayOTM;
    }

    public function setTuesdayOTM(?string $tuesdayOTM): self
    {
        $this->tuesdayOTM = $tuesdayOTM;

        return $this;
    }

    public function getTuesdayCTM(): ?string
    {
        return $this->tuesdayCTM;
    }

    public function setTuesdayCTM(?string $tuesdayCTM): self
    {
        $this->tuesdayCTM = $tuesdayCTM;

        return $this;
    }

    public function getTuesdayOTA(): ?string
    {
        return $this->tuesdayOTA;
    }

    public function setTuesdayOTA(?string $tuesdayOTA): self
    {
        $this->tuesdayOTA = $tuesdayOTA;

        return $this;
    }

    public function getTuesdayCTA(): ?string
    {
        return $this->tuesdayCTA;
    }

    public function setTuesdayCTA(?string $tuesdayCTA): self
    {
        $this->tuesdayCTA = $tuesdayCTA;

        return $this;
    }

    public function getWednesdayOTM(): ?string
    {
        return $this->wednesdayOTM;
    }

    public function setWednesdayOTM(?string $wednesdayOTM): self
    {
        $this->wednesdayOTM = $wednesdayOTM;

        return $this;
    }

    public function getWednesdayCTM(): ?string
    {
        return $this->wednesdayCTM;
    }

    public function setWednesdayCTM(?string $wednesdayCTM): self
    {
        $this->wednesdayCTM = $wednesdayCTM;

        return $this;
    }

    public function getWednesdayOTA(): ?string
    {
        return $this->wednesdayOTA;
    }

    public function setWednesdayOTA(?string $wednesdayOTA): self
    {
        $this->wednesdayOTA = $wednesdayOTA;

        return $this;
    }

    public function getWednesdayCTA(): ?string
    {
        return $this->wednesdayCTA;
    }

    public function setWednesdayCTA(?string $wednesdayCTA): self
    {
        $this->wednesdayCTA = $wednesdayCTA;

        return $this;
    }

    public function getThursdayOTM(): ?string
    {
        return $this->thursdayOTM;
    }

    public function setThursdayOTM(?string $thursdayOTM): self
    {
        $this->thursdayOTM = $thursdayOTM;

        return $this;
    }

    public function getThursdayCTM(): ?string
    {
        return $this->thursdayCTM;
    }

    public function setThursdayCTM(?string $thursdayCTM): self
    {
        $this->thursdayCTM = $thursdayCTM;

        return $this;
    }

    public function getThursdayOTA(): ?string
    {
        return $this->thursdayOTA;
    }

    public function setThursdayOTA(?string $thursdayOTA): self
    {
        $this->thursdayOTA = $thursdayOTA;

        return $this;
    }

    public function getThursdayCTA(): ?string
    {
        return $this->thursdayCTA;
    }

    public function setThursdayCTA(?string $thursdayCTA): self
    {
        $this->thursdayCTA = $thursdayCTA;

        return $this;
    }

    public function getFridayOTM(): ?string
    {
        return $this->fridayOTM;
    }

    public function setFridayOTM(?string $fridayOTM): self
    {
        $this->fridayOTM = $fridayOTM;

        return $this;
    }

    public function getFridayCTM(): ?string
    {
        return $this->fridayCTM;
    }

    public function setFridayCTM(?string $fridayCTM): self
    {
        $this->fridayCTM = $fridayCTM;

        return $this;
    }

    public function getFridayOTA(): ?string
    {
        return $this->fridayOTA;
    }

    public function setFridayOTA(?string $fridayOTA): self
    {
        $this->fridayOTA = $fridayOTA;

        return $this;
    }

    public function getFridayCTA(): ?string
    {
        return $this->fridayCTA;
    }

    public function setFridayCTA(?string $fridayCTA): self
    {
        $this->fridayCTA = $fridayCTA;

        return $this;
    }

    public function getSaturdayOTM(): ?string
    {
        return $this->saturdayOTM;
    }

    public function setSaturdayOTM(?string $saturdayOTM): self
    {
        $this->saturdayOTM = $saturdayOTM;

        return $this;
    }

    public function getSaturdayCTM(): ?string
    {
        return $this->saturdayCTM;
    }

    public function setSaturdayCTM(?string $saturdayCTM): self
    {
        $this->saturdayCTM = $saturdayCTM;

        return $this;
    }

    public function getSaturdayOTA(): ?string
    {
        return $this->saturdayOTA;
    }

    public function setSaturdayOTA(?string $saturdayOTA): self
    {
        $this->saturdayOTA = $saturdayOTA;

        return $this;
    }

    public function getSaturdayCTA(): ?string
    {
        return $this->saturdayCTA;
    }

    public function setSaturdayCTA(?string $saturdayCTA): self
    {
        $this->saturdayCTA = $saturdayCTA;

        return $this;
    }

    public function getSundayOTM(): ?string
    {
        return $this->sundayOTM;
    }

    public function setSundayOTM(?string $sundayOTM): self
    {
        $this->sundayOTM = $sundayOTM;

        return $this;
    }

    public function getSundayCTM(): ?string
    {
        return $this->sundayCTM;
    }

    public function setSundayCTM(?string $sundayCTM): self
    {
        $this->sundayCTM = $sundayCTM;

        return $this;
    }

    public function getSundayOTA(): ?string
    {
        return $this->sundayOTA;
    }

    public function setSundayOTA(?string $sundayOTA): self
    {
        $this->sundayOTA = $sundayOTA;

        return $this;
    }

    public function getSundayCTA(): ?string
    {
        return $this->sundayCTA;
    }

    public function setSundayCTA(?string $sundayCTA): self
    {
        $this->sundayCTA = $sundayCTA;

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
}
