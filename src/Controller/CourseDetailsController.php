<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\LessonRepository;
use App\Repository\PurchaseLessonRepository;

final class CourseDetailsController extends AbstractController
{
    #[Route('/course/details/{id}', name: 'app_course_details')]
    public function index(int $id, LessonRepository $lessonrepository, PurchaseLessonRepository $purchaselessonrepository): Response
    {




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
        $purchasedLessonIds = array_values(array_unique(array_merge(
        $purchasedLessonIds,
        $purchasedLessonsInPacksIds
        )));




        // Deny access if the user has not purchased this lesson.
        if (!in_array($id, $purchasedLessonIds, true)) {
            throw $this->createAccessDeniedException(
                'You do not own this lesson.'
            );
        }
        // Retrieve the requested lesson.
        $lesson = $lessonrepository->find($id);
        // Return a 404 error if the lesson does not exist.
        if (!$lesson) {
            throw $this->createNotFoundException(
                'Lesson not found.'
            );
        }




        return $this->render('formation/course_details/index.html.twig', [
            'controller_name' => 'CourseDetailsController',
            'lesson' => $lesson,
        ]);
    }
}
