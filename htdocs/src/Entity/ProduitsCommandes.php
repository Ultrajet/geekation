<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitsCommandesRepository")
 */
class ProduitsCommandes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut_location;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_fin_location;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produits", inversedBy="produitsCommandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commandes", inversedBy="produitsCommandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebutLocation(): ?\DateTimeInterface
    {
        return $this->date_debut_location;
    }

    public function setDateDebutLocation(\DateTimeInterface $date_debut_location): self
    {
        $this->date_debut_location = $date_debut_location;

        return $this;
    }

    public function getDateFinLocation(): ?\DateTimeInterface
    {
        return $this->date_fin_location;
    }

    public function setDateFinLocation(\DateTimeInterface $date_fin_location): self
    {
        $this->date_fin_location = $date_fin_location;

        return $this;
    }

    public function getProduit(): ?Produits
    {
        return $this->produit;
    }

    public function setProduit(?Produits $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getCommande(): ?Commandes
    {
        return $this->commande;
    }

    public function setCommande(?Commandes $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
}
