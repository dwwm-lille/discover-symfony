<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    #[Route('/welcome', name: 'app_welcome')]
    public function index(): Response
    {
        $firstname = 'Fiorella';

        dump($firstname);

        return $this->render('welcome/index.html.twig', [
            'firstname' => $firstname,
        ]);
    }

    #[Route(
        '/hello/{name}',
        name: 'app_hello',
        requirements: ['name' => '[a-z-]{3,8}']
    )]
    public function show($name = 'Fiorella'): Response
    {
        return $this->render('hello.html.twig', [
            'name' => ucwords($name, '-'),
        ]);
    }
}
