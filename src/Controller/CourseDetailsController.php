<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\LessonRepository;
use App\Repository\PurchaseLessonRepository;
use App\Entity\Progress;
use App\Repository\ProgressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class CourseDetailsController extends AbstractController
{
    #[Route('/course/details/{id}', name: 'app_course_details')]
    public function index(int $id, 
    LessonRepository $lessonrepository, 
    PurchaseLessonRepository $purchaselessonrepository,
    ProgressRepository $progressrepository
    ): Response
    {




// ----------------------------------------------------
// (1) retrieval, search, and display of the lesson.
// fr : récupération, recherche et affichage de la leçon.
// ----------------------------------------------------

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




// ----------------------------------------------------
// (2) Security. Displays only if the user owns the lesson.
// fr : Sécurité. Affiche uniquement si l'user possède la leçon
// ----------------------------------------------------

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




// ----------------------------------------------------
// (3 bis) button display.
// fr : Affichage du bouton.
// ----------------------------------------------------
$isCompleted = (bool) $progressrepository->findOneBy(['user' => $this->getUser(), 'lesson' => $lesson]);




        return $this->render('formation/course_details/index.html.twig', [
            'controller_name' => 'CourseDetailsController',
            'lesson' => $lesson,
            'isCompleted' => $isCompleted,
        ]);
    }




// ----------------------------------------------------
// (3) Lesson complete button.
// fr : Bouton leçon terminée
// ----------------------------------------------------

        #[Route('/course/complete/{id}', name: 'app_course_complete', methods: ['POST'])]
        public function complete(
            int $id,
            Request $request,
            LessonRepository $lessonrepository,
            ProgressRepository $progressrepository,
            EntityManagerInterface $em,
            PurchaseLessonRepository $purchaselessonrepository,
        ): Response {
            if (!$this->isCsrfTokenValid('complete_lesson_' . $id, $request->request->get('_token'))) {
                throw $this->createAccessDeniedException();
            }
    
            $lesson = $lessonrepository->find($id) ?? throw $this->createNotFoundException();
            $user = $this->getUser();
    
            // Security: only an owner of the lesson or of its pack can mark it as completed.
            $owned = $user && (
                $purchaselessonrepository->findOneBy(['user' => $user, 'lesson' => $lesson])
                || $purchaselessonrepository->findOneBy(['user' => $user, 'lessonPack' => $lesson->getLessonPack()])
            );
            if (!$owned) {
                throw $this->createAccessDeniedException('You do not own this lesson.');
            }

            // Saves and avoids duplicates
            if (!$progressrepository->findOneBy(['user' => $user, 'lesson' => $lesson])) {
                $progress = (new Progress())
                    ->setUser($user)
                    ->setLesson($lesson)
                    ->setCreatedAt(new \DateTimeImmutable());
                $em->persist($progress);
                $em->flush();
            }
    
            return $this->redirectToRoute('app_progress');
        }


}

