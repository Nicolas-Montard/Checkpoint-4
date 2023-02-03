<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchBar extends AbstractController
{
    public function createSearchBar(string $route)
    {
        $form = $this->createFormBuilder()
            ->add('searchQuery', TextType::class, [
                'label' => 'Champ de recherche',
                'attr' => ['placeholder' => 'votre recherche', 'class' => 'form-control'],
                'required' => false,
            ])
            ->setMethod('GET')
            ->setAction($this->generateUrl($route))
            ->getForm();

        return $form;
    }
}