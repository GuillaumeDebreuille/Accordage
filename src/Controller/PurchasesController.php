<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PurchasesController extends AbstractController
{
    #[Route('/purchases', name: 'app_purchases')]
    public function index(): Response
    {
        return $this->render('account/purchases/index.html.twig', [
            'controller_name' => 'PurchasesController',
        ]);
    }
}
