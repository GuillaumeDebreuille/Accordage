<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrainingDetailsController extends AbstractController
{
    #[Route('/training/details', name: 'app_training_details')]
    public function index(): Response
    {
        return $this->render('shop/training_details/index.html.twig', [
            'controller_name' => 'TrainingDetailsController',
        ]);
    }
}
