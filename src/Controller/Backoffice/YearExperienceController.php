<?php

namespace App\Controller\Backoffice;

use App\Entity\YearExperience;
// use App\Form\YearExperienceType;
use App\Repository\YearExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/backoffice/year")
 */
class YearExperienceController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_year_experience_index", methods={"GET"})
     */
    public function index(YearExperienceRepository $yearExperienceRepository): Response
    {
        // dump($yearExperienceRepository->findAll());
        // die();
        return $this->render('backoffice/yearExperience/index.html.twig', [
            'year_experiences' => $yearExperienceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_year_experience_show", methods={"GET"})
     */
    public function show(YearExperience $yearExperience): Response
    {
        return $this->render('backoffice/yearExperience/show.html.twig', [
            'year_experience' => $yearExperience,
        ]);
    }

    /**
     * @Route("/new", name="app_backoffice_year_experience_new", methods={"GET", "POST"})
     */
    // public function new(Request $request, YearExperienceRepository $yearExperienceRepository): Response
    // {
    //     $yearExperience = new YearExperience();
    //     $form = $this->createForm(YearExperienceType::class, $yearExperience);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $yearExperienceRepository->add($yearExperience, true);

    //         return $this->redirectToRoute('app_backoffice_year_experience_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('backoffice/yearExperience/new.html.twig', [
    //         'year_experience' => $yearExperience,
    //         'form' => $form,
    //     ]);
    // }


    /**
     * @Route("/{id}/edit", name="app_backoffice_year_experience_edit", methods={"GET", "POST"})
     */
    // public function edit(Request $request, YearExperience $yearExperience, YearExperienceRepository $yearExperienceRepository): Response
    // {
    //     $form = $this->createForm(YearExperienceType::class, $yearExperience);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $yearExperienceRepository->add($yearExperience, true);

    //         return $this->redirectToRoute('app_backoffice_year_experience_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('backoffice/yearExperience/edit.html.twig', [
    //         'year_experience' => $yearExperience,
    //         'form' => $form,
    //     ]);
    // }

    /**
     * @Route("/{id}", name="app_backoffice_year_experience_delete", methods={"POST"})
     */
    // public function delete(Request $request, YearExperience $yearExperience, YearExperienceRepository $yearExperienceRepository): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$yearExperience->getId(), $request->request->get('_token'))) {
    //         $yearExperienceRepository->remove($yearExperience, true);
    //     }

    //     return $this->redirectToRoute('app_backoffice_year_experience_index', [], Response::HTTP_SEE_OTHER);
    // }
}
