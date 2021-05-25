<?php

namespace App\Entity;

use App\Repository\ProposerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProposerRepository::class)
 */
class Proposer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $tarifNuite;

    /**
     * @ORM\OneToMany(targetEntity=Hotel::class, mappedBy="tarifs", orphanRemoval=true)
     */
    private $hotel;

    /**
     * @ORM\OneToMany(targetEntity=CategorieChambre::class, mappedBy="tarifs", orphanRemoval=true)
     */
    private $categorie;

    public function __construct()
    {
        $this->hotel = new ArrayCollection();
        $this->categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarifNuite(): ?string
    {
        return $this->tarifNuite;
    }

    public function setTarifNuite(string $tarifNuite): self
    {
        $this->tarifNuite = $tarifNuite;

        return $this;
    }

    /**
     * @return Collection|Hotel[]
     */
    public function getHotel(): Collection
    {
        return $this->hotel;
    }

    public function addHotel(Hotel $hotel): self
    {
        if (!$this->hotel->contains($hotel)) {
            $this->hotel[] = $hotel;
            $hotel->setTarifs($this);
        }

        return $this;
    }

    public function removeHotel(Hotel $hotel): self
    {
        if ($this->hotel->removeElement($hotel)) {
            // set the owning side to null (unless already changed)
            if ($hotel->getTarifs() === $this) {
                $hotel->setTarifs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CategorieChambre[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(CategorieChambre $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
            $categorie->setTarifs($this);
        }

        return $this;
    }

    public function removeCategorie(CategorieChambre $categorie): self
    {
        if ($this->categorie->removeElement($categorie)) {
            // set the owning side to null (unless already changed)
            if ($categorie->getTarifs() === $this) {
                $categorie->setTarifs(null);
            }
        }

        return $this;
    }
}
