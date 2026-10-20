<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\LessonRepository;
use App\Repository\LessonPackRepository;

final class TrainingDetailsController extends AbstractController
{
    #[Route('/training/details', name: 'app_training_details')]
    public function index(
        Request $request,
        LessonRepository $lessonrepository,
        LessonPackRepository $lessonpackrepository
        ): Response
    {

    $type = $request->query->get('type');
    $id = $request->query->get('id');

    $lesson = null;
    $pack = null;
    $lessons = [];



    if ($type === 'lesson') {
        $lesson = $lessonrepository->find($id);

        if (!$lesson) {
            throw $this->createNotFoundException('Leçon introuvable');
        }

    } elseif ($type === 'pack') {
        $pack = $lessonpackrepository->find($id);

        if (!$pack) {
            throw $this->createNotFoundException('Pack introuvable');
        }

        $lessons = $lessonrepository->findBy(['lessonPack' => $pack]);

    } else {
        throw $this->createNotFoundException('Type invalide');
    }



        return $this->render('shop/training_details/index.html.twig', [
            'controller_name' => 'TrainingDetailsController',
            'type' => $type,
            'lesson' => $lesson,
            'lessons' => $lessons,
            'pack' => $pack
        ]);
    }
}
