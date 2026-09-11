<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CourseDetailsController extends AbstractController
{
    #[Route('/course/details', name: 'app_course_details')]
    public function index(): Response
    {
        return $this->render('formation/course_details/index.html.twig', [
            'controller_name' => 'CourseDetailsController',
        ]);
    }
}
