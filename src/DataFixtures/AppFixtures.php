<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Membres;
use App\Entity\Produits;
use App\Entity\Commandes;
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
        //     for ($j = 0; $j < rand(3,5); $j++) {
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

        // for ($i = 0; $i < 10; $i++) {
        //     $membre = new Membres;
        //     $username = "User-$i";
        //     $ville = "Ville-$i";

        //     $membre->setUsername($username);
        //     $membre->setPassword("123456");
        //     $membre->setPrenom("Prenom-$i");
        //     $membre->setNom("Nom-$i");
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


        $manager->flush();
    }
}