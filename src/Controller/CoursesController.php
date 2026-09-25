<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\LessonRepository;
use App\Repository\PurchaseLessonRepository;


final class CoursesController extends AbstractController
{
    #[Route('/courses', name: 'app_courses')]
    public function index(LessonRepository $lessonrepository, PurchaseLessonRepository $purchaselessonrepository): Response
    {




        if ($this->getUser()) {

            // Retrieve purchased packs and lessons
            // Récupérer les packs et les leçons achetés
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

        // Retrieve the IDs of the purchased lessons
        // Récupérer les identifiants des leçons achetées
        $purchasedLessonIds = array_map(
            fn ($purchase) => $purchase->getLesson()->getId(),
            $purchasedlessons
        );

        // (1/3) Retrieve the purchased pack entities
        // Récupérer les packs
        $purchasedPackEntities = array_map(
            fn ($purchase) => $purchase->getLessonPack(),
            $purchasedpacks
        );
        // (2/3) Retrieve all lessons included in the purchased packs
        // Récupérer toutes les leçons incluses dans les packs achetés
        $purchasedLessonsInPacks = $purchasedPackEntities
            ? $lessonrepository->findBy(['lessonPack' => $purchasedPackEntities])
            : [];
        // (3/3) Extract the IDs of these lessons
        // Extrait les identifiants de ces leçons
        $purchasedLessonsInPacksIds = array_map(
            fn ($lesson) => $lesson->getId(),
            $purchasedLessonsInPacks
        );

        // Combine all purchased lesson IDs into a single variable
        // Regroupez tous les identifiants de cours achetés dans une seule variable
        $purchasedLessonIds = array_values(array_unique(array_merge(
            $purchasedLessonIds,
            $purchasedLessonsInPacksIds
        )));

        // Retrieve the lessons using these IDs
        // Récupérez les leçons à l'aide de ces identifiants
        $lessons = $purchasedLessonIds
            ? $lessonrepository->findBy(['id' => $purchasedLessonIds])
            : [];




        return $this->render('formation/courses/index.html.twig', [
            'controller_name' => 'CoursesController',
            'lessons' => $lessons,
        ]);
    }
}
