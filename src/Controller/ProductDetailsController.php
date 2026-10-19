<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

final class ProductDetailsController extends AbstractController
{
    #[Route('/product/details/{id}', name: 'app_product_details')]
    public function index(
        int $id, 
        ProductRepository $productrepository
    ): Response {


    $product = $productrepository->find($id);

    if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé');
        }



        return $this->render('shop/product_details/index.html.twig', [
            'controller_name' => 'ProductDetailsController',
            'product' => $product,
        ]);
    }
}
