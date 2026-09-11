<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrainingsAdminController extends AbstractController
{
    #[Route('/trainings/admin', name: 'app_trainings_admin')]
    public function index(): Response
    {
        return $this->render('admin/trainings_admin/index.html.twig', [
            'controller_name' => 'TrainingsAdminController',
        ]);
    }
}
