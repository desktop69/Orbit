<?php

namespace App\Entity;

use App\Repository\PerformanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PerformanceRepository::class)
 */
class Performance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, inversedBy="performance", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Client;

    /**
     * @ORM\OneToMany(targetEntity=Historique::class, mappedBy="performance", orphanRemoval=true)
     */
    private $historiques;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rem_monthly;

    /**
     * @ORM\Column(type="integer")
     */
    private $rem_total;

    /**
     * @ORM\Column(type="integer")
     */
    private $sold_solvable;

    /**
     * @ORM\Column(type="integer")
     */
    private $sold_biens;

    /**
     * @ORM\ManyToOne(targetEntity=PriceGn::class, inversedBy="performances")
     */
    private $priceGns;


    public function __construct()
    {
        $this->historiques = new ArrayCollection();
        $this->priceGns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(Client $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    /**
     * @return Collection|Historique[]
     */
    public function getHistoriques(): Collection
    {
        return $this->historiques;
    }

    public function addHistorique(Historique $historique): self
    {
        if (!$this->historiques->contains($historique)) {
            $this->historiques[] = $historique;
            $historique->setPerformance($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historiques->contains($historique)) {
            $this->historiques->removeElement($historique);
            // set the owning side to null (unless already changed)
            if ($historique->getPerformance() === $this) {
                $historique->setPerformance(null);
            }
        }

        return $this;
    }

    public function getRemMonthly(): ?int
    {
        return $this->rem_monthly;
    }

    public function setRemMonthly(?int $rem_monthly): self
    {
        $this->rem_monthly = $rem_monthly;

        return $this;
    }

    public function getRemTotal(): ?int
    {
        return $this->rem_total;
    }

    public function setRemTotal(int $rem_total): self
    {
        $this->rem_total = $rem_total;

        return $this;
    }

    public function getSoldSolvable(): ?int
    {
        return $this->sold_solvable;
    }

    public function setSoldSolvable(int $sold_solvable): self
    {
        $this->sold_solvable = $sold_solvable;

        return $this;
    }

    public function getSoldBiens(): ?int
    {
        return $this->sold_biens;
    }

    public function setSoldBiens(int $sold_biens): self
    {
        $this->sold_biens = $sold_biens;

        return $this;
    }

    public function getPriceGns(): ?PriceGn
    {
        return $this->priceGns;
    }

    public function setPriceGns(?PriceGn $priceGns): self
    {
        $this->priceGns = $priceGns;

        return $this;
    }


}
