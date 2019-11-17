<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HealthCardRepository")
 */
class HealthCard
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CardNumber;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Animal", inversedBy="HealthCard", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Animal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Examination", mappedBy="HealthCard")
     */
    private $Examinations;

    public function __construct()
    {
        $this->Examinations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCardNumber(): ?string
    {
        return $this->CardNumber;
    }

    public function setCardNumber(string $CardNumber): self
    {
        $this->CardNumber = $CardNumber;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->Animal;
    }

    public function setAnimal(Animal $Animal): self
    {
        $this->Animal = $Animal;

        return $this;
    }

    /**
     * @return Collection|Examination[]
     */
    public function getExaminations(): Collection
    {
        return $this->Examinations;
    }

    public function addExamination(Examination $examination): self
    {
        if (!$this->Examinations->contains($examination)) {
            $this->Examinations[] = $examination;
            $examination->setHealthCard($this);
        }

        return $this;
    }

    public function removeExamination(Examination $examination): self
    {
        if ($this->Examinations->contains($examination)) {
            $this->Examinations->removeElement($examination);
            // set the owning side to null (unless already changed)
            if ($examination->getHealthCard() === $this) {
                $examination->setHealthCard(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return (string)$this->getId();
    }
}
