<?php

namespace App\Controller;

use App\Entity\Piece;
use App\Form\PieceType;
use App\Repository\PieceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/piece')]
class PieceController extends AbstractController
{
    #[Route('/', name: 'piece_index', methods: ['GET'])]
    public function index(PieceRepository $pieceRepository): Response
    {
        return $this->render('piece/index.html.twig', [
            'pieces' => $pieceRepository->findAll(),
        ]);
    }

    #[Route('/bureau', name: 'piece_bureau', methods: ['GET'])]
    public function indexBureau(PieceRepository $pieceRepository): Response
    {
        return $this->render('piece/bureau.html.twig', [
            'pieces' => $pieceRepository->findAll(),
            
        ]);
    }

    #[Route('/chambre1', name: 'piece_chambre1', methods: ['GET'])]
    public function indexChambre1(PieceRepository $pieceRepository): Response
    {
        return $this->render('piece/chambre1.html.twig', [
            'pieces' => $pieceRepository->findAll(),
            
        ]);
    }

    #[Route('/chambre2', name: 'piece_chambre2', methods: ['GET'])]
    public function indexChambre2(PieceRepository $pieceRepository): Response
    {
        return $this->render('piece/chambre2.html.twig', [
            'pieces' => $pieceRepository->findAll(),
            
        ]);
    }

    #[Route('/salle_de_bain', name: 'piece_salle_de_bain', methods: ['GET'])]
    public function indexSalleDeBain(PieceRepository $pieceRepository): Response
    {
        return $this->render('piece/salle_de_bain.html.twig', [
            'pieces' => $pieceRepository->findAll(),
            
        ]);
    }

    #[Route('/buanderie', name: 'piece_buanderie', methods: ['GET'])]
    public function indexBuanderie(PieceRepository $pieceRepository): Response
    {
        return $this->render('piece/buanderie.html.twig', [
            'pieces' => $pieceRepository->findAll(),
            
        ]);
    }

    #[Route('/terasse', name: 'piece_terasse', methods: ['GET'])]
    public function indexTerasse(PieceRepository $pieceRepository): Response
    {
        return $this->render('piece/terasse.html.twig', [
            'pieces' => $pieceRepository->findAll(),
            
        ]);
    }

    #[Route('/salon', name: 'piece_salon', methods: ['GET'])]
    public function indexSalon(PieceRepository $pieceRepository): Response
    {
        return $this->render('piece/salon.html.twig', [
            'pieces' => $pieceRepository->findAll(),
            
        ]);
    }

    #[Route('/cuisine', name: 'piece_cuisine', methods: ['GET'])]
    public function indexCuisine(PieceRepository $pieceRepository): Response
    {
        return $this->render('piece/cuisine.html.twig', [
            'pieces' => $pieceRepository->findAll(),
            
        ]);
    }

    #[Route('/garage', name: 'piece_garage', methods: ['GET'])]
    public function indexGarage(PieceRepository $pieceRepository): Response
    {
        return $this->render('piece/garage.html.twig', [
            'pieces' => $pieceRepository->findAll(),
            
        ]);
    }

    #[Route('/new', name: 'piece_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $piece = new Piece();
        $form = $this->createForm(PieceType::class, $piece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($piece);
            $entityManager->flush();

            return $this->redirectToRoute('piece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('piece/new.html.twig', [
            'piece' => $piece,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'piece_show', methods: ['GET'])]
    public function show(Piece $piece): Response
    {
        return $this->render('piece/show.html.twig', [
            'piece' => $piece,
        ]);
    }

    #[Route('/{id}/edit', name: 'piece_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Piece $piece, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PieceType::class, $piece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('piece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('piece/edit.html.twig', [
            'piece' => $piece,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'piece_delete', methods: ['POST'])]
    public function delete(Request $request, Piece $piece, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$piece->getId(), $request->request->get('_token'))) {
            $entityManager->remove($piece);
            $entityManager->flush();
        }

        return $this->redirectToRoute('piece_index', [], Response::HTTP_SEE_OTHER);
    }
}
