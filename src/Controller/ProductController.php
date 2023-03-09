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
            ['name' => 'iPhone 1', 'slug' => 'iphone-1', 'description' => 'Un iPhone de 20181', 'price' => 11991],
            ['name' => 'iPhone 2', 'slug' => 'iphone-2', 'description' => 'Un iPhone de 20182', 'price' => 11992],
            ['name' => 'iPhone 3', 'slug' => 'iphone-3', 'description' => 'Un iPhone de 20183', 'price' => 11993],
            ['name' => 'iPhone 4', 'slug' => 'iphone-4', 'description' => 'Un iPhone de 20184', 'price' => 11994],
        ];
    }

    #[Route('/product/{page}', name: 'app_product', requirements: ['page' => '[0-9]+'])]
    public function index(Request $request, $page = 1): Response
    {
        $products = array_filter($this->products, function ($product) use ($request) {
            $price = $request->get('price', INF) ?: INF; // Si pas de price, INF. Si price est vide, INF.

            return $product['price'] <= $price;
        });

        // Pagination tableau (array_chunk)
        $chunk = array_chunk($products, 2);
        $products = $chunk[$page - 1] ?? null;

        if (! $products) {
            throw $this->createNotFoundException();
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'page' => $page,
            'totalPage' => count($chunk),
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

    #[Route('/product/create', name: 'app_product_create', priority: 1)]
    public function create(): Response
    {
        return $this->render('product/create.html.twig');
    }

    #[Route('/product/{slug}', name: 'app_product_show')]
    public function show($slug): Response
    {
        $product = array_values(array_filter($this->products, function ($product) use ($slug) {
            return $product['slug'] === $slug;
        }))[0] ?? null;

        if (! $product) {
            throw $this->createNotFoundException();
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/product.json', name: 'app_product_api')]
    public function api(): Response
    {
        return $this->json($this->products);
    }
}
