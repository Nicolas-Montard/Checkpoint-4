<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES = ['Apéro', 'Entrée', 'Plat', 'Dessert', 'Boisson', 'Accompagnement'];

    public function load(ObjectManager $manager): void
    {
        $i = 0;
        foreach (self::CATEGORIES as $name)
        {
            $i++;
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $this->addReference('category_' . $i, $category);
        }

        $manager->flush();
    }
}
