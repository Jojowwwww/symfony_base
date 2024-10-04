<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Repository\BurgerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burger_index')]
    public function index(BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findAll();
        return $this->render('burgers_index.html.twig', [
            'burgers' => $burgers,
        ]);
    }

    #[Route('/burger/{id}', name: 'burger_show')]
    public function show($id, BurgerRepository $burgerRepository, Burger $burgers): Response
    {
        $burger = $burgerRepository->find($id);
        $commentaire = $burgers->getCommentaire();

        if (!$burger) {
            return $this->render('burgers_notfound.html.twig');
        }

        return $this->render('burgers_show.html.twig', [
            'burger' => $burger,
            'commentaires' => $commentaire
        ]);
    }
}