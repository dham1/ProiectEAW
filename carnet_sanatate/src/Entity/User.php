<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
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
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Password;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserDetails", mappedBy="User", cascade={"persist", "remove"})
     */
    private $UserDetails;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserAnimal", mappedBy="User", orphanRemoval=true)
     */
    private $UserAnimals;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    public function __construct()
    {
        $this->UserAnimals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getUserDetails(): ?UserDetails
    {
        return $this->UserDetails;
    }

    public function setUserDetails(?UserDetails $UserDetails): self
    {
        $this->UserDetails = $UserDetails;

        // set the owning side of the relation if necessary
        if ($UserDetails->getUser() !== $this) {
            $UserDetails->setUser($this);
        }

        return $this;
    }
    public function __toString() {
        return (string)$this->getId();
    }

    /**
     * @return Collection|UserAnimal[]
     */
    public function getUserAnimals(): Collection
    {
        return $this->UserAnimals;
    }

    public function addUserAnimal(UserAnimal $userAnimal): self
    {
        if (!$this->UserAnimals->contains($userAnimal)) {
            $this->UserAnimals[] = $userAnimal;
            $userAnimal->setUser($this);
        }

        return $this;
    }

    public function removeUserAnimal(UserAnimal $userAnimal): self
    {
        if ($this->UserAnimals->contains($userAnimal)) {
            $this->UserAnimals->removeElement($userAnimal);
            // set the owning side to null (unless already changed)
            if ($userAnimal->getUser() === $this) {
                $userAnimal->setUser(null);
            }
        }

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }
    public function eraseCredentials()
    {
        return null;
    }
}
