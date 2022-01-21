<?php

namespace App\Controller;

use Goutte\Client;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\Form\ProduitType;
use App\Form\SearchBarType;
use App\Entity\Piece;
use App\Form\CategorieType;
use App\Entity\SousCategorie;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/categorie')]
class CategorieController extends AbstractController
{
    #[Route('/', name: 'categorie_index', methods: ['GET'])]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'categorie_show', methods: ['GET'])]
    public function show(Request $request, Categorie $categorie, ProduitRepository $produitRepository, string $id): Response
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.manomano.fr/nos-comparatifs');
        
        $results = [];
        $crawler -> filter ('li > a.Hub_link__HJZxy')-> each (function ($node) use (&$results){
            $results[] = [
                'title' => $node -> text(),
                'url' => $node -> attr('href')];
            });
            // dd($results);
        
        // $tableCorrespondanceConseils = [
        //     "crédence" => "1",
        //     "carrelage" => "1",
        //     "carreleur" => "1",
        //     "sols" => "1",
        //     "joints de carrelage" => "1",
        //     "étanchéité" => "2",
        //     "bains" => "2",
        //     "Baignoire" => "2",
        //     "baignoire" => "2",
        //     "spa" => "2",
        //     "spas" => "2",
        //     "bains" => "2",
        //     "douche" => "2",
        //     "lavabo" => "2",
        //     "lave-main" => "3",
        //     "canalisation" => "3",
        //     "joint" => "3",
        //     "murs" => "4",
        //     "porte coulissante" => "4",
        //     "salle de bains" => "4",
        //     "spots" => "5",
        // ];
        $tableCorrespondanceComparatifs = [
            "carrelage" => "1",
            "carreleur" => "1",
            "sols" => "1",
            "joints de carrelage" => "1",
            "étanchéité" => "2",
            "bains" => "2",
            "Baignoire" => "2",
            "baignoire" => "2",
            "spa" => "2",
            "spas" => "2",
            "bains" => "2",
            "bains" => "2",
            "hammam" => "2",
            "douche" => "2",
            "lavabo" => "2",
            "sauna" => "2",
            "vasque" => "2",
            "pommeau" => "2",
            "rideau"=>"2",
            "siphon"=>"2",
            "mains"=>"2",
            "canalisation" => "3",
            "joint" => "3",
            "lave-main" => "3",
            "murs" => "4",
            "porte coulissante" => "4",
            "salle de bains" => "4",
            "spots" => "5",
            "colonne"=>"7",
            "plan de travail"=>"7",
            "porte-serviette"=>"7",
            "serviette"=>"7",
            "porte"=>"7",
            "panier"=>"7",
            "seche main"=>"7",
            "tapis"=>"7",
            "etendoire"=>"7",
            "etagere"=>"7",
            "fixation"=>"7",
            "poubelle"=>"7",
            "sèche mains"=>"7",
        ];

        // récupération des mots clés correspondant  à l'id, stocké dans un tableau
        $motsClesParId = [];

        foreach ($tableCorrespondanceComparatifs as $key => $value) {

            if ( $id == $value) {
                array_push( $motsClesParId, $key);
            };
        }

        // Selection des articles avec les mots clés associés à l'id
        $tousArticlesFiltres = [];

        foreach ($motsClesParId as $motCle) {

            foreach($results as $result) {
                // cherche dans le titre les valeurs correspondantes
                if (str_contains($result['title'], $motCle)){
                    array_push( $tousArticlesFiltres, ["title"=>$result['title'], "url"=>"https://www.manomano.fr/".$result['url']]);
                };
            }
        }
        // retourner 4 valeurs aléatoires
        $articlesRandoms = [];

        for ($i=0; $i<4; $i++) {
            $articleRandomId = array_rand($tousArticlesFiltres);
            array_push($articlesRandoms, $tousArticlesFiltres[$articleRandomId]);
        }

        $form = $this->createForm(SearchBarType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $produits = $produitRepository->findLikeName($search);
        } else {
            $produits = $produitRepository->findAll();
        }

        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
            'produits' => $produits,
            'form' => $form->createView(),
            'results' => $results,
            'articles' => $articlesRandoms
        ]);
    }


    // #[Route('/{id}/{tag}', methods: ['GET'])]
    // public function showTag(Categorie $categorie, string $tag): Response
    // {
    //     return $this->render('categorie/showTag.html.twig', [
    //     return $this->render('categorie/show.html.twig', [
    //         'produits' => $produits,
    //         'form' => $form->createView(),
    //         'categorie' => $categorie,
    //     ]);
    // }


    // #[Route('/{id}/{tag}', name: 'categorie_show', methods: ['GET'])]
    // public function showTag(Categorie $categorie, string $tag): Response
    // {
    //     return $this->render('categorie/showTag.html.twig', [
    //         'categorie' => $categorie,
    //         'tagGet'=> $tag
    //     ]);
    // }
}
