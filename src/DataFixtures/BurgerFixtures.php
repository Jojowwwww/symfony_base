<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Image;
use App\Entity\Pain;
use App\Entity\Oignon;
use App\Entity\Sauce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BurgerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $image1 = new Image();
        $image1->setName("https://thespiceway.com/cdn/shop/files/Signature_Savory_Classic_Burger.jpg?v=1712161801");
        $manager->persist($image1);

        $image2 = new Image();
        $image2->setName("https://p.turbosquid.com/ts-thumb/uh/SQ7o53/8GkD5TqE/big_2/jpg/1582711423/600x600/fit_q87/6a27162beaaf66273d0f5d7713b0055f9aa79740/big_2.jpg");
        $manager->persist($image2);

        $image3 = new Image();
        $image3->setName("https://actualveggies.com/cdn/shop/products/ActualVeggies_Packaging7662_600x.jpg?v=1713819449");
        $manager->persist($image3);

        $image4 = new Image();
        $image4->setName("https://thespiceway.com/cdn/shop/articles/Bourbon_BBQ_Burger.jpg?v=1718986691");
        $manager->persist($image4);

        $image5 = new Image();
        $image5->setName("https://fusionfriedchicken.com/wp-content/uploads/2022/12/spicy-chicken-sand-wich.png");
        $manager->persist($image5);

        $image6 = new Image();
        $image6->setName("https://hrdprodcmsimages-d4d2dhb9fvh9ftde.a03.azurefd.net/hrdprodcmsimages/hrd/ksa/imagestemp/130005.png");
        $manager->persist($image6);

        $pain = new Pain();
        $pain->setName('Pain classique');
        $manager->persist($pain);

        $oignon1 = new Oignon();
        $oignon1->setName('Oignon Rouge');
        $manager->persist($oignon1);

        $oignon2 = new Oignon();
        $oignon2->setName('Oignon Blanc');
        $manager->persist($oignon2);

        $sauce1 = new Sauce();
        $sauce1->setName('Ketchup');
        $manager->persist($sauce1);

        $sauce2 = new Sauce();
        $sauce2->setName('Mayonnaise');
        $manager->persist($sauce2);

        $burgers = [
            ['name' => 'Classic Burger', 'price' => 5.99, 'image' => $image1, 'pain' => $pain, 'oignons' => [$oignon1], 'sauces' => [$sauce1], 'description' => "Un classic burger, c'est un burger mais un classic burger en fait"],
            ['name' => 'Cheese Burger', 'price' => 6.99, 'image' => $image2, 'pain' => $pain, 'oignons' => [$oignon2], 'sauces' => [$sauce2], 'description' => "Burger avec full de fromage"],
            ['name' => 'Veggie Burger', 'price' => 7.99, 'image' => $image3, 'pain' => $pain, 'oignons' => [], 'sauces' => [], 'description' => "Burger sans pain, sans viande, sans fromage, sans salade, sans tomates"],
            ['name' => 'BBQ Burger', 'price' => 8.49, 'image' => $image4, 'pain' => $pain, 'oignons' => [$oignon1], 'sauces' => [$sauce2], 'description' => "Burger grillé avec une sauce barbecue délicieuse."],
            ['name' => 'Spicy Burger', 'price' => 8.99, 'image' => $image5, 'pain' => $pain, 'oignons' => [$oignon2], 'sauces' => [$sauce1], 'description' => "Un burger épicé qui réchauffe le cœur."],
            ['name' => 'Deluxe Burger', 'price' => 9.99, 'image' => $image6, 'pain' => $pain, 'oignons' => [$oignon1, $oignon2], 'sauces' => [$sauce1, $sauce2], 'description' => "Un burger haut de gamme avec tout le nécessaire."],
        ];

        foreach ($burgers as $index => $burgerData) {
            $burger = new Burger();
            $burger->setName($burgerData['name']);
            $burger->setPrice($burgerData['price']);
            $burger->setImage($burgerData['image']);
            $burger->setDescription($burgerData['description']);
            $burger->setPain($burgerData['pain']);

            foreach ($burgerData['oignons'] as $oignon) {
                $burger->addOignon($oignon);
            }

            foreach ($burgerData['sauces'] as $sauce) {
                $burger->addSauce($sauce);
            }

            $manager->persist($burger);
            $this->addReference('burger_' . $index, $burger);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OignonFixtures::class,
            SauceFixtures::class,
            PainFixtures::class,
            ImageFixtures::class,
        ];
    }
}