<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimalRepository")
 */
class Animal
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
    private $Name;

    /**
     * @ORM\Column(type="date")
     */
    private $BirthDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Breed;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Sex;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Allergies;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Weight;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\HealthCard", mappedBy="Animal", cascade={"persist", "remove"})
     */
    private $HealthCard;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserAnimal", mappedBy="Animal")
     */
    private $AnimalUser;

    public function __construct()
    {
        $this->AnimalUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->BirthDate;
    }

    public function setBirthDate(\DateTimeInterface $BirthDate): self
    {
        $this->BirthDate = $BirthDate;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getBreed(): ?string
    {
        return $this->Breed;
    }

    public function setBreed(string $Breed): self
    {
        $this->Breed = $Breed;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->Sex;
    }

    public function setSex(string $Sex): self
    {
        $this->Sex = $Sex;

        return $this;
    }

    public function getAllergies(): ?string
    {
        return $this->Allergies;
    }

    public function setAllergies(string $Allergies): self
    {
        $this->Allergies = $Allergies;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->Weight;
    }

    public function setWeight(?int $Weight): self
    {
        $this->Weight = $Weight;

        return $this;
    }

    public function getHealthCard(): ?HealthCard
    {
        return $this->HealthCard;
    }

    public function setHealthCard(HealthCard $HealthCard): self
    {
        $this->HealthCard = $HealthCard;

        // set the owning side of the relation if necessary
        if ($HealthCard->getAnimal() !== $this) {
            $HealthCard->setAnimal($this);
        }

        return $this;
    }
    public function __toString() {
        return (string)$this->getId();
    }

    /**
     * @return Collection|UserAnimal[]
     */
    public function getAnimalUser(): Collection
    {
        return $this->AnimalUser;
    }

    public function addAnimalUser(UserAnimal $animalUser): self
    {
        if (!$this->AnimalUser->contains($animalUser)) {
            $this->AnimalUser[] = $animalUser;
            $animalUser->setAnimal($this);
        }

        return $this;
    }

    public function removeAnimalUser(UserAnimal $animalUser): self
    {
        if ($this->AnimalUser->contains($animalUser)) {
            $this->AnimalUser->removeElement($animalUser);
            // set the owning side to null (unless already changed)
            if ($animalUser->getAnimal() === $this) {
                $animalUser->setAnimal(null);
            }
        }

        return $this;
    }
}
