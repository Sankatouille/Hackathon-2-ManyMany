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
}
