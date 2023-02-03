<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\RecetteRepository;
use App\Service\SearchBar;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(RecetteRepository $recetteRepository, CategoryRepository $categoryRepository, SearchBar $searchBar): Response
    {
        $form = $searchBar->createSearchBar('app_recette_index');

        $entree = $recetteRepository->findRecetteByCategory('Entrée', 3);
        $plat = $recetteRepository->findRecetteByCategory('Plat', 3);
        $dessert = $recetteRepository->findRecetteByCategory('Dessert', 3);
        return $this->render('home/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'entrees' => $entree,
            'plats' => $plat,
            'desserts' => $dessert,
            'form' => $form,
        ]);
    }
}
