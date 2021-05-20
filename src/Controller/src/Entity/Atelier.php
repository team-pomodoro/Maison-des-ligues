<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AtelierRepository::class)
 */
class Atelier
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
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlacesMaxi;

    /**
     * @ORM\OneToMany(targetEntity=Vacation::class, mappedBy=Vacation::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $vacations;

    /**
     * @ORM\ManyToOne(targetEntity=Theme::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $themes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getNbPlacesMaxi(): ?int
    {
        return $this->nbPlacesMaxi;
    }

    public function setNbPlacesMaxi(int $nbPlacesMaxi): self
    {
        $this->nbPlacesMaxi = $nbPlacesMaxi;

        return $this;
    }

    public function getVacations(): ?Vacation
    {
        return $this->vacations;
    }

    public function setVacations(?Vacation $vacations): self
    {
        $this->vacations = $vacations;

        return $this;
    }

    public function getThemes(): ?Theme
    {
        return $this->themes;
    }

    public function setThemes(?Theme $themes): self
    {
        $this->themes = $themes;

        return $this;
    }
}
