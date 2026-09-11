<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProgressController extends AbstractController
{
    #[Route('/progress', name: 'app_progress')]
    public function index(): Response
    {
        return $this->render('formation/progress/index.html.twig', [
            'controller_name' => 'ProgressController',
        ]);
    }
}
