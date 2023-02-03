<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\CategoryRepository;
use App\Repository\RecetteRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isEmpty;

#[Route('/recette')]
class RecetteController extends AbstractController
{
    #[Route('/', name: 'app_recette_index', methods: ['GET'])]
    public function index(RecetteRepository $recetteRepository, Request $request): Response
    {
        if (!isEmpty($request->get('form'))){
            $recette = $recetteRepository->findBySearch($request->get('form'));
        } else{
            $recette = $recetteRepository->findAll();
        }

        return $this->render('recette/index.html.twig', [
            'recettes' => $recette
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/new', name: 'app_recette_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RecetteRepository $recetteRepository): Response
    {
        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recette->setOwner($this->getUser());
            $recetteRepository->save($recette, true);

            return $this->redirectToRoute('app_recette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recette/new.html.twig', [
            'recette' => $recette,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/owner', name: 'app_recette_owner', methods: ['GET'])]
    public function searchByOwner(RecetteRepository $recetteRepository)
    {
        return $this->render('recette/index.html.twig', [
            'recettes' => $recetteRepository->findBy(['owner' => $this->getUser()]),
        ]);
    }

    #[Route('/{id}', name: 'app_recette_show', methods: ['GET'])]
    public function show(Recette $recette): Response
    {
        return $this->render('recette/show.html.twig', [
            'recette' => $recette,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/{id}/edit', name: 'app_recette_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recette $recette, RecetteRepository $recetteRepository): Response
    {
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recetteRepository->save($recette, true);

            return $this->redirectToRoute('app_recette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recette/edit.html.twig', [
            'recette' => $recette,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recette_delete', methods: ['POST'])]
    public function delete(Request $request, Recette $recette, RecetteRepository $recetteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recette->getId(), $request->request->get('_token'))) {
            $recetteRepository->remove($recette, true);
        }

        return $this->redirectToRoute('app_recette_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/category/{category}', name: 'app_recette_category', methods: ['GET'])]
    public function searchByCategory(Category $category, RecetteRepository $recetteRepository, CategoryRepository $categoryRepository)
    {
        return $this->render('recette/index.html.twig', [
            'recettes' => $recetteRepository->findRecetteByCategory($category->getName()),
        ]);
    }

}
