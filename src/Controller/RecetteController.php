<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/', name: 'recette')]
class RecetteController extends AbstractController
{
    #[Route('', name: 'search')]
    public function search(): Response
    {

        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
        ]);
    }
}
