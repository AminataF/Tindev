<?php

namespace App\Controller\Backoffice;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backoffice/user')]
class UserController extends AbstractController
{
    // #[Route('/', name: 'app_backoffice_user_index', methods: ['GET'])]
    // public function index(UserRepository $userRepository): Response
    // {
    //     return $this->render('backoffice/user/index.html.twig', [
    //         'users' => $userRepository->findAll(),
    //     ]);
    // }

    // #[Route('/new', name: 'app_backoffice_user_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $user = new User();
    //     $form = $this->createForm(UserType::class, $user);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($user);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_backoffice_user_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('backoffice/user/new.html.twig', [
    //         'user' => $user,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_backoffice_user_show', methods: ['GET'])]
    // public function show(User $user): Response
    // {
    //     return $this->render('backoffice/user/show.html.twig', [
    //         'user' => $user,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'app_backoffice_user_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(UserType::class, $user);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_backoffice_user_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('backoffice/user/edit.html.twig', [
    //         'user' => $user,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_backoffice_user_delete', methods: ['POST'])]
    // public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
    //         $entityManager->remove($user);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_backoffice_user_index', [], Response::HTTP_SEE_OTHER);
    // }

    /**
     * @Route("/", name="app_backoffice_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        $allUsers = $userRepository->findAll();
        // dd($allUsers);
        
        return $this->render('backoffice/user/index.html.twig', [
            'users' => $allUsers
        ]);
    }

    /**
     * @Route("/new", name="app_backoffice_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get("password")->getData())
            {
                $password = $form->get("password")->getData();
                $hashedpassword = $userPasswordHasherInterface->hashPassword($user, $password);
                $user->setPassword($hashedpassword);
            }
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_backoffice_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backoffice/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('backoffice/user/show.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_backoffice_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get("password")->getData())
            {
                $password = $form->get("password")->getData();
                $hashedpassword = $userPasswordHasherInterface->hashPassword($user, $password);
                $user->setPassword($hashedpassword);
            }
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_backoffice_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backoffice/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_backoffice_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
