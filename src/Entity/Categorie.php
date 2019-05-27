<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
    private $libCat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibCat(): ?string
    {
        return $this->libCat;
    }

    public function setLibCat(string $libCat): self
    {
        $this->libCat = $libCat;

        return $this;
    }
}
