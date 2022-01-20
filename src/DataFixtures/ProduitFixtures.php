<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProduitFixtures extends Fixture
{
    public const PRODUITS = [
        ["Nom" => "Boite de 10 dalles vinyles auto-adhésives imitation carrelage (2,04m²) - Starfloor",
        "Prix" => "25€90",
        "Informations" => "Dalle PVC Tarkett Starfloor auto-adhésive : la solution préférée des amateurs de bricolage et des professionnels pour des rénovations rapides et efficaces

        Dalle de sol vinyle PVC avec pose auto-adhésive du fabricant français Tarkett Drapeau Francais
        Pose facile : enlevez la protection et collez directement la dalle sur n'importe quel sol lisse ou ragréé
        Sol vinyle adhésif idéal pour la rénovation : sa faible épaisseur (2mm) évite le rabotage des portes, très léger à transporter
        Revêtement compatible pièces humides : cuisines et salles de bains
        Sol vinyle résistant aux griffures, rayures et chocs
        Revêtement de sol vinyle classé A+ (émissions dans l'air intérieur)
        100% sans phtalate",
        "Marque" => "TARKETT",
        "Photo" => "https://cdn.manomano.com/images/images_products/6664056/P/24599914_1.jpg",
        "Reference" => "https://www.manomano.fr/p/sol-pvc-a-coller-boites-11-dalles-auto-adhesives-204m-design-imitation-carrelage-starfloor-venezia-black-tarkett-24303122",
        "SousCategorie" => "0"],

        ["Nom" => "Boite de 9 dalles vinyles clipsables imitation carreau de ciment",
        "Prix" => "35€90",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "https://www.decoweb.com/images/thumbs_cache/300x300_31006020-1-bxiaR.jpg",
        "Reference" => "https://www.manomano.fr/p/dalle-pvc-clipsable-tarkett-starfloor-click-30-retro-indigo-dalle-de-310-x-603-mm-9-dalles-boite-soit-167m-11997296",
        "SousCategorie" => "0"],

        ["Nom" => "Boite de 9 lames vinyles clipsables imitation parquet (2 m²)",
        "Prix" => "53€80",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "https://cdn.manomano.com/images/images_products/6664056/P/18800735_1.jpg",
        "Reference" => "https://www.manomano.fr/p/boite-9-lames-pvc-clipsables-1222x183mm-2-m-starfloor-click-30-washed-pine-snow-tarkett-18483974",
        "SousCategorie" => "0"],

        ["Nom" => "Revêtement de Sol Adhésif Lames Laminées PVC Vinyle Effet Naturel Compatible au Plancher Chauffant 28 Pièces 3,92 m² Natural Siberian Oak Chêne Sibérien",
        "Prix" => "78€19",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "https://media.adeo.com/marketplace/MKP/82912310/9510240b62f8086d06478545534ce967.jpeg?width=650&height=650&format=jpg&quality=80&fit=bounds",
        "Reference" => "https://www.manomano.fr/p/revetement-de-sol-adhesif-lames-laminees-pvc-vinyle-effet-naturel-compatible-au-plancher-chauffant-28-pieces-392-m-natural-siberian-oak-chene-siberien-23675545",
        "SousCategorie" => "0"],

        ["Nom" => "Sol PVC Best - Motif Granit Noir Argenté - 3 x 3m",
        "Prix" => "122€00",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "https://cdn.manomano.com/sol-pvc-best-motif-granit-noir-argente-4-x-3m-P-3594306-14986263_1.jpg",
        "Reference" => "https://www.manomano.fr/p/sol-pvc-best-motif-granit-noir-argente-14666419?model_id=14666422",
        "SousCategorie" => "0"],

        ["Nom" => "Carrelage imitation parquet vintage style usine LUCK 20x114 cm",
        "Prix" => "43€77",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "https://www.asdecarreaux.com/84614-product_default/carrelage-imitation-parquet-vintage-style-usine-luck-20x114-cm-114m.jpg",
        "Reference" => "https://www.manomano.fr/p/carrelage-imitation-parquet-vintage-style-usine-luck-20x114-cm-114m-17670523",
        "SousCategorie" => "1"],

        ["Nom" => "Série Electra 15x15 (carton de 0,50 m2)",
        "Prix" => "18€50",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "https://cdn.manomano.com/images/images_products/9362134/P/16907052_1.jpg",
        "Reference" => "https://www.manomano.fr/catalogue/p/serie-electra-15x15-carton-de-050-m2-11253983",
        "SousCategorie" => "1"],

        ["Nom" => "Série Fired Star Green 20x20 (carton de 1,00 m2)",
        "Prix" => "31€24",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "https://www.magasinducarrelage.fr/3343-tm_large_default/serie-fired-star-pink-20x20-carton-de-100-m2.jpg",
        "Reference" => "https://www.manomano.fr/catalogue/p/srie-fired-star-green-20x20-carton-de-100-m2-27499988",
        "SousCategorie" => "1"],

        ["Nom" => "Carrelage à motif effet terrazzo 20x20 cm BIANCO MACRO - 1.16 m²",
        "Prix" => "53€46",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "https://www.asdecarreaux.com/54424-product_default/carrelage-a-motif-effet-terrazzo-20x20-cm-bianco-macro-116-m.jpg",
        "Reference" => "https://www.manomano.fr/p/carrelage-a-motif-effet-terrazzo-20x20-cm-bianco-macro-116-m-26472457",
        "SousCategorie" => "1"],

        ["Nom" => "Carrelage hexagonal oxidé OUTEN ROBIN 17,5X20- 0,71 M²",
        "Prix" => "38€19",
        "Photo" => "https://cdn.manomano.com/carrelage-hexagonal-oxide-outen-robin-175x20-071-m-P-555685-42002181_1.jpg",
        "Reference" => "https://www.manomano.fr/p/carrelage-hexagonal-oxid-outen-robin-175x20--071-m-42094408",
        "SousCategorie" => "1"],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],

        ["Nom" => "",
        "Prix" => "",
        "Informations" => "",
        "Marque" => "",
        "Photo" => "",
        "Reference" => "",
        "SousCategorie" => ""],


    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUITS as $key => $produitInfos) {
            $produit = new Produit();
            $produit->setNom($produitInfos["Nom"]);
            $produit->setPrix($produitInfos["Prix"]);
            $produit->setInformations($produitInfos["Informations"]);
            $produit->setMarque($produitInfos["Marque"]);
            $produit->setPhoto($produitInfos["Photo"]);
            $produit->setReference($produitInfos["Reference"]);
            $produit->addSousCategory($produitInfos["SousCategorie"]);

            //$this->addReference('produit_' . $key, $produit);

            $manager->persist($produit);
        }

        $manager->flush();
    }
}