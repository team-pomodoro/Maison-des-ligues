<?php

namespace App\Entity;

use App\Repository\LicencieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LicencieRepository::class)
 */
class Licencie
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
    private $numLicence;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseLicencie1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseLicencie2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInscrit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateEnregistrement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cleWifi;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumLicence(): ?string
    {
        return $this->numLicence;
    }

    public function setNumLicence(string $numLicence): self
    {
        $this->numLicence = $numLicence;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresseLicencie1(): ?string
    {
        return $this->adresseLicencie1;
    }

    public function setAdresseLicencie1(string $adresseLicencie1): self
    {
        $this->adresseLicencie1 = $adresseLicencie1;

        return $this;
    }

    public function getAdresseLicencie2(): ?string
    {
        return $this->adresseLicencie2;
    }

    public function setAdresseLicencie2(?string $adresseLicencie2): self
    {
        $this->adresseLicencie2 = $adresseLicencie2;

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

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getDateInscrit(): ?\DateTimeInterface
    {
        return $this->dateInscrit;
    }

    public function setDateInscrit(\DateTimeInterface $dateInscrit): self
    {
        $this->dateInscrit = $dateInscrit;

        return $this;
    }

    public function getDateEnregistrement(): ?string
    {
        return $this->dateEnregistrement;
    }

    public function setDateEnregistrement(?string $dateEnregistrement): self
    {
        $this->dateEnregistrement = $dateEnregistrement;

        return $this;
    }

    public function getCleWifi(): ?string
    {
        return $this->cleWifi;
    }

    public function setCleWifi(?string $cleWifi): self
    {
        $this->cleWifi = $cleWifi;

        return $this;
    }
}
