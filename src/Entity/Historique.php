<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoriqueRepository::class)
 */
class Historique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Performance::class, inversedBy="historiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $performance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $operation;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="integer")
     */
    private $rem_acquis;

    /**
     * @ORM\Column(type="integer")
     */
    private $rem_consommees;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerformance(): ?Performance
    {
        return $this->performance;
    }

    public function setPerformance(?Performance $performance): self
    {
        $this->performance = $performance;

        return $this;
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(string $operation): self
    {
        $this->operation = $operation;

        return $this;
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

    public function getRemAcquis(): ?int
    {
        return $this->rem_acquis;
    }

    public function setRemAcquis(int $rem_acquis): self
    {
        $this->rem_acquis = $rem_acquis;

        return $this;
    }

    public function getRemConsommees(): ?int
    {
        return $this->rem_consommees;
    }

    public function setRemConsommees(int $rem_consommees): self
    {
        $this->rem_consommees = $rem_consommees;

        return $this;
    }
}
