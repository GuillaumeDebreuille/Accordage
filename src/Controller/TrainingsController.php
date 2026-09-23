<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\LessonRepository;
use App\Repository\LessonPackRepository;

final class TrainingsController extends AbstractController
{
    #[Route('/trainings', name: 'app_trainings')]
    public function index(LessonRepository $lessonrepository, LessonPackRepository $lessonpackrepository): Response
    {

        $lessons = $lessonrepository->findAll();
        $lessonspacks = $lessonpackrepository->findAll();

        return $this->render('shop/trainings/index.html.twig', [
            'controller_name' => 'TrainingsController',
            'lessons' => $lessons,
            'lessonspacks' => $lessonspacks
        ]);
    }
}
