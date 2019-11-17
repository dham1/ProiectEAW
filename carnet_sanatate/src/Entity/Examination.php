<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExaminationRepository")
 */
class Examination
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HealthCard", inversedBy="Examinations")
     */
    private $HealthCard;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getHealthCard(): ?HealthCard
    {
        return $this->HealthCard;
    }

    public function setHealthCard(?HealthCard $HealthCard): self
    {
        $this->HealthCard = $HealthCard;

        return $this;
    }
    public function __toString() {
        return (string)$this->getId();
    }
}
