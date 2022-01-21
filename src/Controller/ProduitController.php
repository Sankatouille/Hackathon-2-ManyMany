<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
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
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
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

    #[Route('/{id}', name: 'produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/conseil', name: 'conseils_produit', methods: ['GET','POST'])]
    public function getConseilsProduit(Produit $produit){
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.manomano.fr/nos-conseils');

        $result = [];
        $crawler -> filter ('li > a.Hub_link__HJZxy')-> each (function ($node) use (&$result){
            $result[$node -> text()] = $node -> attr('href');
        });
        // dd($result);
        return $this->render('produit/show.html.twig', [
            'result' => $result,
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index', [], Response::HTTP_SEE_OTHER);
    }

    // #[Route('/{id}/comparatif', name: 'comparatif_produit', methods: ['GET','POST'])]
    // public function getComparatifProduit(Produit $produit){
    //     $client = new Client();
    //     $crawler = $client->request('GET', 'https://www.manomano.fr/nos-comparatifs%27');

    //     $comparatifs = [];
    //     $crawler -> filter ('li > a.Hub_link__HJZxy')-> each (function ($node) use (&$comparatifs){
    //         $comparatifs[] = [
    //             'title' => $node -> text(),
    //             'url' => $node -> attr('href')];
    //     });
    //     $tableCorrespondanceConseils = [
    //         "crédence" => "1",
    //         "carrelage" => "1",
    //         "carreleur" => "1",
    //         "sols" => "1",
    //         "joints de carrelage" => "1",
    //         "étanchéité" => "2",
    //         "bains" => "2",
    //         "Baignoire" => "2",
    //         "baignoire" => "2",
    //         "spa" => "2",
    //         "spas" => "2",
    //         "bains" => "2",
    //         "douche" => "2",
    //         "lavabo" => "2",
    //         "lave-main" => "3",
    //         "canalisation" => "3",
    //         "joint" => "3",
    //         "murs" => "4",
    //         "porte coulissante" => "4",
    //         "salle de bains" => "4",
    //         "spots" => "5",
    //     ];
    //     $tableCorrespondanceComparatifs = [
    //         "carrelage" => "1",
    //         "carreleur" => "1",
    //         "sols" => "1",
    //         "joints de carrelage" => "1",
    //         "étanchéité" => "2",
    //         "bains" => "2",
    //         "Baignoire" => "2",
    //         "baignoire" => "2",
    //         "spa" => "2",
    //         "spas" => "2",
    //         "bains" => "2",
    //         "bains" => "2",
    //         "hammam" => "2",
    //         "douche" => "2",
    //         "lavabo" => "2",
    //         "sauna" => "2",
    //         "vasque" => "2",
    //         "pommeau" => "2",
    //         "rideau"=>"2",
    //         "siphon"=>"2",
    //         "mains"=>"2",
    //         "canalisation" => "3",
    //         "joint" => "3",
    //         "lave-main" => "3",
    //         "murs" => "4",
    //         "porte coulissante" => "4",
    //         "salle de bains" => "4",
    //         "spots" => "5",
    //         "colonne"=>"7",
    //         "plan de travail"=>"7",
    //         "porte-serviette"=>"7",
    //         "serviette"=>"7",
    //         "porte"=>"7",
    //         "panier"=>"7",
    //         "seche main"=>"7",
    //         "tapis"=>"7",
    //         "etendoire"=>"7",
    //         "etagere"=>"7",
    //         "fixation"=>"7",
    //         "poubelle"=>"7",
    //         "sèche mains"=>"7",
    //     ];
    //     dd($comparatifs);
    //     return $this->render('produit/show.html.twig', [
    //         'comparatif' => $comparatifs,
    //         'produit' => $produit,
    //     ]);
    // }   
}
