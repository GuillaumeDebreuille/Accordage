<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\LessonRepository;
use App\Repository\LessonPackRepository;
use App\Repository\PurchaseLessonRepository;

final class TrainingsController extends AbstractController
{
    #[Route('/trainings', name: 'app_trainings')]
    public function index(LessonRepository $lessonrepository, LessonPackRepository $lessonpackrepository, PurchaseLessonRepository $purchaselessonrepository): Response
    {

        $lessons = $lessonrepository->findAll();
        $lessonspacks = $lessonpackrepository->findAll();
        




        // Retrieves the lessons and packs purchased by the user.
        if ($this->getUser()) {
            $purchasedlessons = $purchaselessonrepository->findBy([
                'user' => $this->getUser(),
                'purchaseType' => 'lesson',
                ]);
            $purchasedpacks = $purchaselessonrepository->findBy([
                'user' => $this->getUser(),
                'purchaseType' => 'pack',
                ]);
        } else {
            $purchasedlessons = [];
            $purchasedpacks = [];
        } 
        // Retrieves the lessons in packs purchased by the user.        
        if ($purchasedpacks) {
            $purchasedPackEntities = array_map(
                fn ($purchase) => $purchase->getLessonPack(),
                $purchasedpacks
        );
        $purchasedlessonsinpacks = $lessonrepository->findBy([
        'lessonPack' => $purchasedPackEntities,
        ]);
        } else {
            $purchasedlessonsinpacks = [];
        }
        // Retrieval of IDs for purchased lessons and packs
        $purchasedLessonIds = array_map(
            fn ($purchase) => $purchase->getLesson()->getId(),
            $purchasedlessons
        );
        $purchasedLessonsInPacksIds = array_map(
            fn ($lesson) => $lesson->getId(),
            $purchasedlessonsinpacks
        );
        $purchasedPackIds = array_map(
            fn ($purchase) => $purchase->getLessonPack()->getId(),
            $purchasedpacks
        );




        return $this->render('shop/trainings/index.html.twig', [
            'controller_name' => 'TrainingsController',
            'lessons' => $lessons,
            'lessonspacks' => $lessonspacks,
            'purchasedlessons' => $purchasedlessons,
            'purchasedpacks' => $purchasedpacks,
            'purchasedlessonsinpacks' => $purchasedlessonsinpacks,
            'purchasedLessonIds' => $purchasedLessonIds,
            'purchasedLessonsInPacksIds' => $purchasedLessonsInPacksIds,
            'purchasedPackIds' => $purchasedPackIds
        ]);
    }
}
