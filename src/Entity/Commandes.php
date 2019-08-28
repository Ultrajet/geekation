<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandesRepository")
 */
class Commandes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_enregistrement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membres", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProduitsCommandes", mappedBy="commande")
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

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $date_enregistrement): self
    {
        $this->date_enregistrement = $date_enregistrement;

        return $this;
    }

    public function getMembre(): ?Membres
    {
        return $this->membre;
    }

    public function setMembre(?Membres $membre): self
    {
        $this->membre = $membre;

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
            $produitsCommande->setCommande($this);
        }

        return $this;
    }

    public function removeProduitsCommande(ProduitsCommandes $produitsCommande): self
    {
        if ($this->produitsCommandes->contains($produitsCommande)) {
            $this->produitsCommandes->removeElement($produitsCommande);
            // set the owning side to null (unless already changed)
            if ($produitsCommande->getCommande() === $this) {
                $produitsCommande->setCommande(null);
            }
        }

        return $this;
    }
}
