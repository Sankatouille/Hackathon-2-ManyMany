<?php

namespace App\DataFixtures;

use App\Entity\SousCategorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SousCategorieFixtures extends Fixture implements DependentFixtureInterface
{
    public const SOUSCATEGORIES = [

        ["Nom" => "Sol PVC et Vinyle",
        "Reference" => "categorie_0"],
        ["Nom" => "Carrelage",
        "Reference" => "categorie_0"],
        ["Nom" => "Beton Ciré",
        "Reference" => "categorie_0"],
        ["Nom" => "Pierre naturelle",
        "Reference" => "categorie_0"],

        ["Nom" => "Douche à l'italienne",
        "Reference" => "categorie_1"],
        ["Nom" => "Cabine de douche",
        "Reference" => "categorie_1"],
        ["Nom" => "Douche hydromassante",
        "Reference" => "categorie_1"],
        ["Nom" => "Baignoire",
        "Reference" => "categorie_1"],

        ["Nom" => "Robinet Bas",
        "Reference" => "categorie_2"],
        ["Nom" => "Robinet Mural",
        "Reference" => "categorie_2"],
        ["Nom" => "Lavabo",
        "Reference" => "categorie_2"],
        ["Nom" => "Mitigeur de baignoire",
        "Reference" => "categorie_2"],
        ["Nom" => "Robinetterie de douche",
        "Reference" => "categorie_2"],


        ["Nom" => "Carrelage mural",
        "Reference" => "categorie_3"],
        ["Nom" => "Toile de verre",
        "Reference" => "categorie_3"],
        ["Nom" => "Mosaïque",
        "Reference" => "categorie_3"],
        ["Nom" => "Panneau mural",
        "Reference" => "categorie_3"],


        ["Nom" => "Plafonnier",
        "Reference" => "categorie_4"],
        ["Nom" => "Applique",
        "Reference" => "categorie_4"],
        ["Nom" => "Lampe de mirroir",
        "Reference" => "categorie_4"],

        ["Nom" => "Barre de serviette",
        "Reference" => "categorie_5"],
        ["Nom" => "Porte papier-toilette",
        "Reference" => "categorie_5"],
        ["Nom" => "Porte-savon",
        "Reference" => "categorie_5"],

        ["Nom" => "Meuble haut",
        "Reference" => "categorie_6"],
        ["Nom" => "Colonne salle de bain ",
        "Reference" => "categorie_6"],
        ["Nom" => "Meuble sous-vasque",
        "Reference" => "categorie_6"],




    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SOUSCATEGORIES as $key => $sousCategorieInfos) {
            $sousCategorie = new Souscategorie();
            $sousCategorie->setNom($sousCategorieInfos["Nom"]);
            $sousCategorie->addCategory($this->getReference($sousCategorieInfos["Reference"]));
            $this->addReference('sousCategorie_' . $key, $sousCategorie);

            $manager->persist($sousCategorie);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategorieFixtures::class,
        ];
    }
}
