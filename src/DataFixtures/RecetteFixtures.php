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
            if ($category == 'category_2'){
                $recette->setPicture('salade.jpg');
                $recette->setDescription('Pour faire le plein d’énergie tout en se faisant plaisir, voici une salade de pâtes aux œufs durs et au thon. Cette recette fraîche et saine est à déguster sans attendre! Vous pouvez bien entendu remplacer certains ingrédients par ce qu’il vous plaira et réaliser une bonne vinaigrette maison!');
                $recette->setTitle('Salade de pâtes aux oeufs durs et au thon');
                $recette->setIngredient('
                - 500 g de petites pâtes\n\n
                - 6 œufs durs\n\n
                - 1 boîte de thon au naturel\n\n
                - 1 oignon rouge\n\n
                - 12 bâtonnets de surimi\n\n
                - Quelques olives\n\n
                - Quelques tomates cerises\n\n
                - 1 citron\n\n
                - 6 c. à soupe de mayonnaise\n\n
                - 1 salade (mélange)\n\n
                - Sel & poivre');
                $recette->setStep('
                1. Faites cuire les pâtes comme indiqué sur le paquet puis passez-les sous l’eau froide afin de les refroidir puis égouttez-les avant de les réserver.\n\n

                2. Écaillez les œufs durs et coupez-les en deux. Détaillez les bâtonnets de surimi en petits morceaux et coupez les tomates cerises en deux.\n\n
                
                3. Dans un saladier, émiettez le thon à l’aide d’une fourchette et arrosez-le de jus de citron. Épluchez et émincez finement l’oignon rouge.\n\n
                
                4. Lavez la salade puis essorez-la. Mélangez ensuite la salade, le thon, les pâtes, le surimi, les tomates cerises, les olives et l’oignon rouge.\n\n
                
                5. Ajoutez la mayonnaise et assaisonnez de sel et poivre. Une fois bien mélangée, servez la salade de thon avec les œufs durs. Bon appétit!');
            } elseif ($category == 'category_4'){
                $recette->setPicture('tarte.jpg');
                $recette->setDescription('La tarte à la clémentine est très facile et rapide à confectionner. Rafraîchissante, elle offre une explosion de saveurs en bouche grâce au doux goût sucré et acidulé de la clémentine. Cet agrume permet par ailleurs de lutter contre les carences en vitamines C, alors n’hésitez pas à en reprendre une petite part!');
                $recette->setTitle('Tarte à la clémentine');
                $recette->setIngredient('
                - 1 pâte sablée\n\n
                - 4 œufs\n\n
                - 100 g de sucre semoule\n\n
                - 25 cl de crème fraîche épaisse\n\n
                - 20 cl de jus de clémentine (6 à 8 clémentines)\n\n
                - 4 clémentines environ pour la décoration');
                $recette->setStep('
                1. Tout d’abord, préchauffez votre four à 180 °C.\n\n

                2. Ensuite, réalisez la pâte sablée. Déposez-la dans un moule à tarte préalablement beurré, piquez-la à l’aide d’une fourchette puis faites-la cuire à blanc pendant 15 minutes.\n\n
                
                3. Pendant ce temps, pressez les clémentines afin de récupérer le jus.\n\n
                
                4. Fouettez les œufs avec le sucre jusqu’à ce que le mélange blanchisse, puis ajoutez la crème fraîche et le jus de clémentines.\n\n
                
                4. Retirez la pâte sablée du four et baissez la température à 130 °C.\n\n
                
                5. Versez la préparation sur le fond de tarte puis enfournez de nouveau pendant 45 minutes.\n\n
                
                6. Laissez la tarte refroidir puis réservez-la au frais pendant 1 heure minimum avant de déguster.');
            } else {
                $recette->setPicture('pizza.jpg');
                $recette->setDescription('Si vous avez envie de déguster une pizza automnale aussi belle que bonne, craquez pour cette recette! Pour la réaliser, vous aurez juste besoin d’un peu de patate douce, de courge et d’oignon rouge. Bien évidemment, on n’oublie pas l’incontournable mozzarella sur le dessus et le tour est joué!');
                $recette->setTitle('Pizza automnale');
                $recette->setIngredient('- 1 pâte à pizza\n\n
            - 1 petite patate douce\n\n
            - 1 oignon rouge\n\n
            - 100 g de courge\n\n
            - 1 boule de mozzarella\n\n
            - 20 g de crème fraîche');
                $recette->setStep('1. Pour commencer, préparez votre pâte à pizza. Pour ce faire, vous pouvez suivre cette recette ultra facile et rapide.\n\n

2. Pendant ce temps, épluchez votre patate douce et coupez-la en petits cubes. Faites de même avec la courge.\n\n

3. Faites revenir les cubes de patate douce et de courge dans un filet d’huile d’olive pendant 15 minutes environ.\n\n

3. Pelez et émincez l’oignon rouge.\n\n

4. Lorsque votre pâte à pizza est prête, étalez-la et préchauffez votre four à 200 °C.\n\n

5. Étalez de la crème fraîche sur la pâte, puis disposez les légumes ainsi que l’oignon rouge.\n\n

6. Déposez des rondelles de mozzarella et parsemez d’herbes aromatiques. Enfournez pendant 10 à 15 minutes selon la puissance de votre four.\n\n

Votre pizza automnale est prête!');
            }

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
