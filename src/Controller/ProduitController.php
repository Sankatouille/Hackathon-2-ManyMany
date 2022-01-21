<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Form\SearchBarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'produit_index', methods: ['GET'])]
    public function index(request $request, ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig');
    }

    #[Route('/new', name: 'produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/conseil', name: 'conseils_produit', methods: ['GET','POST'])]
    public function getConseilsProduit(Produit $produit){
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.manomano.fr/nos-conseils');

        $result = [];
        $crawler -> filter ('li > a.Hub_link__HJZxy')-> each (function ($node) use (&$result){
            $result[] = [
                'title' => $node -> text(),
                'url' => $node -> attr('href')];
        });

        return $this->render('produit/show.html.twig', [
            'result' => $result,
            'produit' => $produit,
        ]);
    }


    #[Route('/{id}/conseil', name: 'conseils_produit', methods: ['GET','POST'])]
    public function getConseilsProduit(Produit $produit,  string $id){
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.manomano.fr/nos-conseils');

        $results = [];
        $crawler -> filter ('li > a.Hub_link__HJZxy')-> each (function ($node) use (&$results){
            $results[] = [
                "title" => $node -> text(),
                "url" => $node -> attr('href')
            ];
        });

        // création d'une table de correspondance entre mot clé et categorie
        $tableCorrespondance = [
            "crédance" => "99",
            "murs" => "102",
            "sols" => "99",
            "étanchéité" => "100",
            "porte coulissante" => "102",
            "salle de bains" => "102",
            "bains" => "100",
            "Baignoire" => "100",
            "baignoire" => "100",
            "spa" => "100",
            "spas" => "100",
            "bains" => "100",
            "spots" => "103",
            "carrelage" => "99",
            "carreleur" => "99",
            "canalisation" => "101",
            "joint" => "101",
            "douche" => "100",
            "lavabo" => "100",
            "lave-main" => "101",
            "joints de carrelage" => "99"
        ];

        // récupération des mots clés correspondant  à l'id, stocké dans un tableau
        $motsClesParId = [];

        foreach ($tableCorrespondance as $key => $value) {

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
                    array_push( $tousArticlesFiltres, ["title"=>$result['title'], "url"=>$result['url']]);
                };
            }
        }

        // retourner 4 valeurs aléatoires
        $articlesRandoms = [];

        for ($i=0; $i<4; $i++) {
            $articleRandomId = array_rand($tousArticlesFiltres);
            array_push($articlesRandoms, $tousArticlesFiltres[$articleRandomId]);
        }

      
        return $this->render('produit/show.html.twig', [
            'results' => $results,
            'articles' => $articlesRandoms
        ]);
    }
  
  
  #[Route('/{id}', name: 'produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.manomano.fr/nos-conseils');

        $result = [];
        $crawler -> filter ('li > a.Hub_link__HJZxy')-> each (function ($node) use (&$result){
            $result[] = [
                'title' => $node -> text(),
                'url' => $node -> attr('href')];
        });
        return $this->render('produit/show.html.twig', [
            'result' => $result,
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/comparatif', name: 'comparatif_produit', methods: ['GET','POST'])]
    public function getComparatifProduit(Produit $produit){
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.manomano.fr/nos-comparatifs');

        $comparatifs = [];
        $crawler -> filter ('li > a.Hub_link__HJZxy')-> each (function ($node) use (&$comparatifs){
            $comparatifs[] = [
                'title' => $node -> text(),
                'url' => $node -> attr('href')];
        });
        dd($comparatifs);
        return $this->render('produit/show.html.twig', [
            'comparatif' => $comparatifs,
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);



}
