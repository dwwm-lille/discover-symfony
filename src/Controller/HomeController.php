<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route(
        '/demo/{page}',
        name: 'app_demo',
        requirements: ['page' => '[0-9]+']
    )]
    public function demo($page = 1): Response
    {
        return $this->render('demo/index.html.twig', [
            'page' => $page,
            'games' => ['Monopoly', 'Puissance 4', '6 qui prend'],
            'test' => '<h1>aaaa</h1>',
        ]);
    }

    #[Route('/demo/{game}', name: 'app_show')]
    public function show($game): Response
    {
        return $this->render('demo/show.html.twig', [
            'game' => $game,
        ]);
    }
}
