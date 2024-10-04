<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentaireFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $commentaires = [
            ['name' => 'Excellent burger, je recommande !', 'burger_reference' => 'burger_0'],
            ['name' => 'Un peu trop de fromage à mon goût...', 'burger_reference' => 'burger_1'],
        ];

        foreach ($commentaires as $commentaireData) {
            $commentaire = new Commentaire();
            $commentaire->setName($commentaireData['name']);
            $burger = $this->getReference($commentaireData['burger_reference']);
            $commentaire->setBurger($burger);

            $manager->persist($commentaire);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BurgerFixtures::class,
        ];
    }
}