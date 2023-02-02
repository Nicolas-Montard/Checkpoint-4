<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Recette;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RecetteFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i=1; $i<=150; $i++)
        {
            $recette = new Recette();
            $category = 'category_' .
                $faker->numberBetween(1, count(CategoryFixtures::CATEGORIES));
            $recette->setCategory($this->getReference($category));
            $recette->setOwner($this->getReference('user' . $faker->numberBetween(1, 20)));
            $recette->setPicture('pizza.jpg');
            $recette->setDescription('Si vous avez envie de déguster une pizza automnale aussi belle que bonne, craquez pour cette recette! Pour la réaliser, vous aurez juste besoin d’un peu de patate douce, de courge et d’oignon rouge. Bien évidemment, on n’oublie pas l’incontournable mozzarella sur le dessus et le tour est joué!');
            $recette->setTitle('Pizza automnale');
            $recette->setIngredient('- 1 pâte à pizza
1 petite- patate douce
1 oignon- rouge
100 g de- courge
1 boule - de mozzarella
20 g de - crème fraîche');
            $recette->setStep('1. Pour commencer, préparez votre pâte à pizza. Pour ce faire, vous pouvez suivre cette recette ultra facile et rapide.

2. Pendant ce temps, épluchez votre patate douce et coupez-la en petits cubes. Faites de même avec la courge.

3. Faites revenir les cubes de patate douce et de courge dans un filet d’huile d’olive pendant 15 minutes environ.

3. Pelez et émincez l’oignon rouge.

4. Lorsque votre pâte à pizza est prête, étalez-la et préchauffez votre four à 200 °C.

5. Étalez de la crème fraîche sur la pâte, puis disposez les légumes ainsi que l’oignon rouge.

6. Déposez des rondelles de mozzarella et parsemez d’herbes aromatiques. Enfournez pendant 10 à 15 minutes selon la puissance de votre four.

Votre pizza automnale est prête!');

            $manager->persist($recette);

        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            UserFixtures::class,
        ];
    }
}
