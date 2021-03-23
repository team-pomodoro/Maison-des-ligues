<?php

namespace App\Entity;

use App\Repository\CategorieChambreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieChambreRepository::class)
 */
class CategorieChambre
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
    private $libelleCategorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleCategorie(): ?string
    {
        return $this->libelleCategorie;
    }

    public function setLibelleCategorie(string $libelleCategorie): self
    {
        $this->libelleCategorie = $libelleCategorie;

        return $this;
    }
}
