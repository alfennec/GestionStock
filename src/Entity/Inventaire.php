<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InventaireRepository")
 */
class Inventaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numInv;

    /**
     * @ORM\Column(type="integer")
     */
    private $anneeInv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateSaisie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $validation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumInv(): ?string
    {
        return $this->numInv;
    }

    public function setNumInv(string $numInv): self
    {
        $this->numInv = $numInv;

        return $this;
    }

    public function getAnneeInv(): ?int
    {
        return $this->anneeInv;
    }

    public function setAnneeInv(int $anneeInv): self
    {
        $this->anneeInv = $anneeInv;

        return $this;
    }

    public function getDateSaisie(): ?string
    {
        return $this->dateSaisie;
    }

    public function setDateSaisie(string $dateSaisie): self
    {
        $this->dateSaisie = $dateSaisie;

        return $this;
    }

    public function getValidation(): ?string
    {
        return $this->validation;
    }

    public function setValidation(string $validation): self
    {
        $this->validation = $validation;

        return $this;
    }
}
