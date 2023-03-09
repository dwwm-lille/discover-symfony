<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NinjaTurtleController extends AbstractController
{
    protected $turtles = [
        ['name' => 'Raphaël', 'color' => 'red', 'size' => 2],
        ['name' => 'Léonardo', 'color' => 'blue', 'size' => 2],
        ['name' => 'Donatello', 'color' => 'purple', 'size' => 3],
        ['name' => 'Michelangelo', 'color' => 'orange', 'size' => 4],
    ];

    #[Route('/ninja-turtle', name: 'app_ninja_turtle')]
    public function index(Request $request): Response
    {
        // /ninja-turtle?size=3 => $_GET['size'] c'est NON !
        dump($request->get('size'));

        if (is_numeric($request->get('size'))) {
            // On va filtrer les tortues par rapport à la valeur de size dans l'URL
            $this->turtles = array_filter($this->turtles, function ($turtle) use ($request) {
                return $turtle['size'] === (int) $request->get('size');
            });
        }

        return $this->render('ninja_turtle/index.html.twig', [
            'turtles' => $this->turtles,
        ]);
    }

    #[Route('/ninja-turtle/{color}', name: 'app_ninja_turtle_show')]
    public function show($color): Response
    {
        foreach ($this->turtles as $turtle) {
            if ($turtle['color'] === $color) {
                return $this->render('ninja_turtle/show.html.twig', [
                    'turtle' => $turtle,
                ]);
            }
        }

        // Renvoie une 404
        throw $this->createNotFoundException();
    }
}
