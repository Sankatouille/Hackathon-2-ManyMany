<?php

namespace App\Controller;


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

    #[Route('/{id}', name: 'categorie_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Categorie $categorie, ProduitRepository $produitRepository, string $tag): Response
    {
        $form = $this->createForm(SearchBarType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $produits = $produitRepository->findLikeName($search);
        } else {
            $produits = $produitRepository->findAll();
        }

        return $this->render('categorie/show.html.twig', [
            'produits' => $produits,
            'form' => $form->createView(),
            'categorie' => $categorie,
            // 'tagGet' => $tag,
        ]);
    }


    #[Route('/{id}/{tag}', name: 'tag_show', methods: ['GET'])]
    public function showTag(Categorie $categorie, string $tag): Response
    {
        return $this->render('categorie/showTag.html.twig', [
            'categorie' => $categorie,
            'tagGet' => $tag
        ]);
    }
}
