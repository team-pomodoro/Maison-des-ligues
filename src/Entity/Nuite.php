<?php

namespace App\Entity;

use App\Repository\NuiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NuiteRepository::class)
 */
class Nuite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateNuite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateNuite(): ?\DateTimeInterface
    {
        return $this->dateNuite;
    }

    public function setDateNuite(\DateTimeInterface $dateNuite): self
    {
        $this->dateNuite = $dateNuite;

        return $this;
    }
}
