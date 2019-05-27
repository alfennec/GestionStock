<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
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
    private $desArt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etatArt;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteArt;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteSeilMin;

    /**
     * @ORM\Column(type="integer")
     */
    private $idCat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesArt(): ?string
    {
        return $this->desArt;
    }

    public function setDesArt(string $desArt): self
    {
        $this->desArt = $desArt;

        return $this;
    }

    public function getEtatArt(): ?string
    {
        return $this->etatArt;
    }

    public function setEtatArt(string $etatArt): self
    {
        $this->etatArt = $etatArt;

        return $this;
    }

    public function getQteArt(): ?int
    {
        return $this->qteArt;
    }

    public function setQteArt(int $qteArt): self
    {
        $this->qteArt = $qteArt;

        return $this;
    }

    public function getQteSeilMin(): ?int
    {
        return $this->qteSeilMin;
    }

    public function setQteSeilMin(int $qteSeilMin): self
    {
        $this->qteSeilMin = $qteSeilMin;

        return $this;
    }

    public function getIdCat(): ?int
    {
        return $this->idCat;
    }

    public function setIdCat(int $idCat): self
    {
        $this->idCat = $idCat;

        return $this;
    }
}
