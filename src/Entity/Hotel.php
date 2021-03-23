<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 */
class Hotel
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
    private $codeHotel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomHotel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseHotel1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseHotel2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeHotel(): ?string
    {
        return $this->codeHotel;
    }

    public function setCodeHotel(string $codeHotel): self
    {
        $this->codeHotel = $codeHotel;

        return $this;
    }

    public function getNomHotel(): ?string
    {
        return $this->nomHotel;
    }

    public function setNomHotel(string $nomHotel): self
    {
        $this->nomHotel = $nomHotel;

        return $this;
    }

    public function getAdresseHotel1(): ?string
    {
        return $this->adresseHotel1;
    }

    public function setAdresseHotel1(string $adresseHotel1): self
    {
        $this->adresseHotel1 = $adresseHotel1;

        return $this;
    }

    public function getAdresseHotel2(): ?string
    {
        return $this->adresseHotel2;
    }

    public function setAdresseHotel2(?string $adresseHotel2): self
    {
        $this->adresseHotel2 = $adresseHotel2;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }
}
