<?php

namespace App\DataFixtures;

use DateTime;
use DateTimeZone;
use App\Entity\Membres;
use App\Entity\Produits;
use App\Entity\Commandes;
use App\Entity\ProduitsCommandes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //---------------------
        // FIXTURE PRODUITS
        //---------------------

        // $type = ["jeu", "console", "accessoire"];
        // $univers = ["Playstation", "Xbox", "Switch"];

        // for ($i = 0; $i < 10; $i++) {
        //     $nom = "Lorem-$i";
        //     $prix = rand(10,30);
        //     $typeProduit = $type[array_rand($type)];
        //     $universProduit = $univers[array_rand($univers)];
        //     $nb = rand(3,5);
        //     for ($j = 0; $j < $nb; $j++) {
        //         $produit = new Produits();
        //         $produit->setNom($nom);
        //         $produit->setPrix($prix);
        //         $produit->setType($typeProduit);
        //         $produit->setUnivers($universProduit);
        //         $manager->persist($produit);
        //     }
        // }

        //---------------------
        // FIXTURE MEMBRES
        //---------------------

        // $sexe = ["m", "f", "b"];

        // for ($i = 0; $i < 10; $i++) {
        //     $membre = new Membres;
        //     $username = "User-$i";
        //     $ville = "Ville-$i";

        //     $membre->setUsername($username);
        //     $membre->setPassword("123456");
        //     $membre->setPrenom("Prenom-$i");
        //     $membre->setNom("Nom-$i");
        //     $membre->setSexe($sexe[array_rand($sexe)]);
        //     $membre->setEmail("$username@mail.com");
        //     $membre->setAdresse(rand(1,10) . " Rue de " . $ville);
        //     $membre->setCodePostal(rand(10000,90000));
        //     $membre->setVille($ville);
        //     $membre->setDateDeNaissance(new DateTime('now'));
        //     $membre->setTelephone(rand(10,90).rand(10,90).rand(10,90).rand(10,90).rand(10,90));
        //     $membre->setScanCNI("default.pdf");
        //     $membre->setRIB("default.pdf");
        //     $manager->persist($membre);
        // }

        //---------------------
        // FIXTURE PRODUIT-COMMANDES
        //---------------------

        $commandes = $manager->getRepository(Commandes::class)->findAll();
        $produits = $manager->getRepository(Produits::class)->findAll();

        foreach ($commandes as $commande) {

            //-----------------------
            // HEURE DEBUT LOCATION
            //-----------------------
            
            $commandeDateDebut = $commande->getDateEnregistrement();

            // si la commande est passée après 17h, la location démarre le lendemain 18h
            if ($commandeDateDebut->format('H') >= 17) {
                $commandeDateDebut->modify('+1 day');
            };

            $commandeDateDebut->setTime(18, 00);

            //-----------------------
            // HEURE FIN LOCATION
            //-----------------------

            $dureeLocation = ["+1 day", "+2 days", "+3 days", "+1 week"];

            $commandeDateFin = clone $commandeDateDebut;
            $commandeDateFin->modify($dureeLocation[array_rand($dureeLocation)]);

            //----------------------------------
            //----------------------------------

            
            $nb = rand(1, 4);

            for ($i = 0; $i < $nb; $i++) {
                $produit = $produits[array_rand($produits)];

                // par exemple, la personne fait sa commande le 2019-06-29 à 02:38:18
                // la commande est donc disponible à partir du 18h le jour-même, jusqu'à 18h jour de fin de commande
                // on empêche (arbitrairement) une personne de passer commande pour le jour-même, après 17h
    
                $produitCommande = new ProduitsCommandes;
                $produitCommande->setDateDebutLocation($commandeDateDebut);
                $produitCommande->setDateFinLocation($commandeDateFin);
                $produitCommande->setProduit($produit);
                $produitCommande->setCommande($commande);
                $manager->persist($produitCommande);
            }
        }

        //---------------------
        // FIXTURE COMMANDES
        //---------------------

        // $membres = $manager->getRepository(Membres::class)->findAll();

        // foreach ($membres as $membre) {

        //     $nb = rand(1, 4);

        //     for ($i = 0; $i < $nb; $i++) {
        //         // génération date qui marche! :)
        //         $range = mt_rand(1546300800, 1567036800); // entre le 01/01/19 à 0h00 et le 29/08/19 à 0h00
        //         $date = new Datetime("@$range");
    
        //         $commande = new Commandes;
        //         $commande->setMontant(rand(20, 100));
        //         $commande->setDateEnregistrement($date);
        //         $commande->setMembre($membre);
        //         $manager->persist($commande);
        //     }

        // }

        $manager->flush();
    }
}
