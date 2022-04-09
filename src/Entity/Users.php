<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $height;

    /**
     * @ORM\Column(type="integer")
     */
    private $mass;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $hair_color;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $skin_color;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $eye_color;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $birth_year;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $gender;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(string $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getMass(): ?int
    {
        return $this->mass;
    }

    public function setMass(int $mass): self
    {
        $this->mass = $mass;

        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->hair_color;
    }

    public function setHairColor(string $hair_color): self
    {
        $this->hair_color = $hair_color;

        return $this;
    }

    public function getSkinColor(): ?string
    {
        return $this->skin_color;
    }

    public function setSkinColor(string $skin_color): self
    {
        $this->skin_color = $skin_color;

        return $this;
    }

    public function getEyeColor(): ?string
    {
        return $this->eye_color;
    }

    public function setEyeColor(string $eye_color): self
    {
        $this->eye_color = $eye_color;

        return $this;
    }

    public function getBirthYear(): ?string
    {
        return $this->birth_year;
    }

    public function setBirthYear(string $birth_year): self
    {
        $this->birth_year = $birth_year;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }
}
