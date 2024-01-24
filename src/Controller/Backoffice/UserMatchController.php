<?php

namespace App\Controller\Backoffice;

use App\Entity\UserMatch;
use App\Form\UserMatchType;
use App\Repository\UserMatchRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backoffice/user/match')]
class UserMatchController extends AbstractController
{
    #[Route('/', name: 'app_backoffice_user_match_index', methods: ['GET'])]
    public function index(UserMatchRepository $userMatchRepository): Response
    {
        return $this->render('backoffice/user_match/index.html.twig', [
            'user_matches' => $userMatchRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_backoffice_user_match_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userMatch = new UserMatch();
        $form = $this->createForm(UserMatchType::class, $userMatch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($userMatch);
            $entityManager->flush();

            return $this->redirectToRoute('app_backoffice_user_match_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backoffice/user_match/new.html.twig', [
            'user_match' => $userMatch,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_backoffice_user_match_show', methods: ['GET'])]
    public function show(UserMatch $userMatch): Response
    {
        return $this->render('backoffice/user_match/show.html.twig', [
            'user_match' => $userMatch,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_backoffice_user_match_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserMatch $userMatch, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserMatchType::class, $userMatch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_backoffice_user_match_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backoffice/user_match/edit.html.twig', [
            'user_match' => $userMatch,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_backoffice_user_match_delete', methods: ['POST'])]
    public function delete(Request $request, UserMatch $userMatch, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userMatch->getId(), $request->request->get('_token'))) {
            $entityManager->remove($userMatch);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_backoffice_user_match_index', [], Response::HTTP_SEE_OTHER);
    }
}
