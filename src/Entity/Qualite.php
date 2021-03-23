<?php

namespace App\Entity;

use App\Repository\QualiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QualiteRepository::class)
 */
class Qualite
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
    private $LibelleQualite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleQualite(): ?string
    {
        return $this->LibelleQualite;
    }

    public function setLibelleQualite(string $LibelleQualite): self
    {
        $this->LibelleQualite = $LibelleQualite;

        return $this;
    }
}
