<?php

namespace App\DataFixtures;

use App\Entity\Valeurs;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategorieFixtures extends Fixture
{
    public const CATEGORIES = [
        ["Nom" => "Sols"],
        ["Nom" => "Bain/Douche"],
        ["Nom" => "Robinetterie"],
        ["Nom" => "Murs"],
        ["Nom" => "Eclairage"],
        ["Nom" => "Quincaillerie"],
        ["Nom" => "Meuble de rangement"],


    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $key => $categorieInfos) {
            $categorie = new Categorie();
            $categorie->setNom($categorieInfos["Nom"]);

            $manager->persist($categorie);
        }

        $manager->flush();
    }
}