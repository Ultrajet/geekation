<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitsRepository")
 */
class Produits
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
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $univers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProduitsCommandes", mappedBy="produit")
     */
    private $produitsCommandes;

    public function __construct()
    {
        $this->produitsCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUnivers(): ?string
    {
        return $this->univers;
    }

    public function setUnivers(string $univers): self
    {
        $this->univers = $univers;

        return $this;
    }

    /**
     * @return Collection|ProduitsCommandes[]
     */
    public function getProduitsCommandes(): Collection
    {
        return $this->produitsCommandes;
    }

    public function addProduitsCommande(ProduitsCommandes $produitsCommande): self
    {
        if (!$this->produitsCommandes->contains($produitsCommande)) {
            $this->produitsCommandes[] = $produitsCommande;
            $produitsCommande->setProduit($this);
        }

        return $this;
    }

    public function removeProduitsCommande(ProduitsCommandes $produitsCommande): self
    {
        if ($this->produitsCommandes->contains($produitsCommande)) {
            $this->produitsCommandes->removeElement($produitsCommande);
            // set the owning side to null (unless already changed)
            if ($produitsCommande->getProduit() === $this) {
                $produitsCommande->setProduit(null);
            }
        }

        return $this;
    }
}
