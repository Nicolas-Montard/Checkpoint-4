<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavBarController extends AbstractController
{
    #[Route('/navbar', name: 'app_nav_bar')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('_include/_navbar.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}
