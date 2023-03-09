<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    protected $products = [];

    public function __construct()
    {
        $this->products = [
            ['name' => 'iPhone X', 'slug' => 'iphone-x', 'description' => 'Un iPhone de 2017', 'price' => 999],
            ['name' => 'iPhone XR', 'slug' => 'iphone-xr', 'description' => 'Un iPhone de 2018', 'price' => 1099],
            ['name' => 'iPhone XS', 'slug' => 'iphone-xs', 'description' => 'Un iPhone de 2018', 'price' => 1199],
        ];
    }

    #[Route('/product', name: 'app_product')]
    public function index(Request $request): Response
    {
        $products = array_filter($this->products, function ($product) use ($request) {
            $price = $request->get('price', INF) ?: INF; // Si pas de price, INF. Si price est vide, INF.

            return $product['price'] <= $price;
        });

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/random', name: 'app_product_random')]
    public function random(): Response
    {
        $product = $this->products[array_rand($this->products)];

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
