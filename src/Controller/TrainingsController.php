<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrainingsController extends AbstractController
{
    #[Route('/trainings', name: 'app_trainings')]
    public function index(): Response
    {
        return $this->render('shop/trainings/index.html.twig', [
            'controller_name' => 'TrainingsController',
        ]);
    }
}
