<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burger_list')]
    public function list(): Response
    {
        $burgers = [
            ['id' => 1, 'name' => 'Classic Burger'],
            ['id' => 2, 'name' => 'Cheese Burger'],
            ['id' => 3, 'name' => 'Bacon Burger'],
            ['id' => 4, 'name' => 'Vegan Burger'],
        ];

        return $this->render('burgers_list.html.twig', [
            'burgers' => $burgers,
        ]);
    }

    #[Route('/burger/{id}', name: 'burger')]
    public function show($id): Response
    {
        $burgers = [
            ['id' => 1, 'name' => 'Classic Burger', 'description' => 'Un burger classique avec du fromage et des légumes.'],
            ['id' => 2, 'name' => 'Cheese Burger', 'description' => 'Un burger au fromage avec double ration de cheddar.'],
            ['id' => 3, 'name' => 'Bacon Burger', 'description' => 'Un burger savoureux avec du bacon croustillant.'],
            ['id' => 4, 'name' => 'Vegan Burger', 'description' => 'Un burger entièrement végétalien avec galette de pois chiche.'],
        ];

        if (!array_key_exists($id, $burgers)) {
            return $this->render('burgers_notfound.html.twig');
        }

        return $this->render('burgers_show.html.twig', [
            'burger' => $burgers[$id],
        ]);
    }
}