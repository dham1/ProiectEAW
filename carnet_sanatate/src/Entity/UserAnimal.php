<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserAnimalRepository")
 */
class UserAnimal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="UserAnimals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Animal", inversedBy="AnimalUser")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Animal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->Animal;
    }

    public function setAnimal(?Animal $Animal): self
    {
        $this->Animal = $Animal;

        return $this;
    }
    public function __toString() {
        return (string)$this->getId();
    }
}
