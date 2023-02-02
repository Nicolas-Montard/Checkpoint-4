<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <21; $i++) {
            $user = new User();
            $user->setEmail('User' . $i . '@mail.com');
            $hashedPassword = $this->userPasswordHasher->hashPassword($user, 'motdepasse');
            $user->setPassword($hashedPassword);
            $user->isVerified(true);
            $manager->persist($user);
            $this->addReference('user' . $i, $user);
        }
        $manager->flush();
    }
}
