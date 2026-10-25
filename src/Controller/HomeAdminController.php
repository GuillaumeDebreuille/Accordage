<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeAdminController extends AbstractController
{
    #[Route('/home/admin', name: 'app_home_admin')]
    public function index(): Response
    {
        // Security ! If not an admin, return to the home page
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Accès refusé. Zone réservée à l administration');
            return $this->redirectToRoute('app_home');
        }





        return $this->render('admin/home_admin/index.html.twig', [
            'controller_name' => 'HomeAdminController',
        ]);
    }
}
