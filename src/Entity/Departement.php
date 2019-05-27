<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartementRepository")
 */
class Departement
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
    private $libDept;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibDept(): ?string
    {
        return $this->libDept;
    }

    public function setLibDept(string $libDept): self
    {
        $this->libDept = $libDept;

        return $this;
    }
}
