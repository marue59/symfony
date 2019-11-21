<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WilderRepository")
 */
class Wilder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $surname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_registered;


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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getIsRegistered(): ?bool
    {
        return $this->is_registered;
    }

    public function setIsRegistered(bool $is_registered): self
    {
        $this->is_registered = $is_registered;

        return $this;
    }
}
