<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AloiteRepository")
 */
class Aloite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $aihe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kuvaus;

    /**
     * @ORM\Column(type="datetime")
     */
    private $kirjauspvm;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nimi;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAihe(): ?string
    {
        return $this->aihe;
    }

    public function setAihe(string $aihe): self
    {
        $this->aihe = $aihe;

        return $this;
    }

    public function getKuvaus(): ?string
    {
        return $this->kuvaus;
    }

    public function setKuvaus(string $kuvaus): self
    {
        $this->kuvaus = $kuvaus;

        return $this;
    }

    public function getKirjauspvm(): ?\DateTimeInterface
    {
        return $this->kirjauspvm;
    }

    public function setKirjauspvm(\DateTimeInterface $kirjauspvm): self
    {
        $this->kirjauspvm = $kirjauspvm;

        return $this;
    }

    public function getNimi(): ?string
    {
        return $this->nimi;
    }

    public function setNimi(string $nimi): self
    {
        $this->nimi = $nimi;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
