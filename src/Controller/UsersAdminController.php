<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UsersAdminController extends AbstractController
{
    #[Route('/users/admin', name: 'app_users_admin')]
    public function index(): Response
    {
        return $this->render('admin/users_admin/index.html.twig', [
            'controller_name' => 'UsersAdminController',
        ]);
    }
}
