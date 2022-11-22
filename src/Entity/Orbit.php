<?php

namespace App\Entity;

use App\Repository\OrbitRepository;
use App\Entity\Users;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrbitRepository::class)
 */
class Orbit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="parent")
     */
    private $fils;

    /**
     * @ORM\Column(type="integer")
     */
    private $generation;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="myparente")
     */
    private $parent;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;



    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFils(): ?Client
    {
        return $this->fils;
    }

    public function setFils(?Client $fils): self
    {
        $this->fils = $fils;

        return $this;
    }

    public function getGeneration(): ?int
    {
        return $this->generation;
    }

    public function setGeneration(int $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    public function getParent(): ?Client
    {
        return $this->parent;
    }

    public function setParent(?Client $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

}
