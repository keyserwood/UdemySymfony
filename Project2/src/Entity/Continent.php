<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContinentRepository")
 */
class Continent
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
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Animal", inversedBy="continents")
     */
    private $Animaux;

    public function __construct()
    {
        $this->Animaux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Animal[]
     */
    public function getAnimaux(): Collection
    {
        return $this->Animaux;
    }

    public function addAnimaux(Animal $animaux): self
    {
        if (!$this->Animaux->contains($animaux)) {
            $this->Animaux[] = $animaux;
        }

        return $this;
    }

    public function removeAnimaux(Animal $animaux): self
    {
        if ($this->Animaux->contains($animaux)) {
            $this->Animaux->removeElement($animaux);
        }

        return $this;
    }
}
