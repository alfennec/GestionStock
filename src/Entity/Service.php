<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
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
    private $libService;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibService(): ?string
    {
        return $this->libService;
    }

    public function setLibService(string $libService): self
    {
        $this->libService = $libService;

        return $this;
    }
}
