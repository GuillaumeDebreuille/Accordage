<?php

namespace App\Controller;

use App\Repository\ProgressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Progress;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class ProgressController extends AbstractController
{
    #[Route('/progress', name: 'app_progress')]
    public function index(ProgressRepository $progressrepository): Response
    {




// ----------------------------------------------------
// (1) Display completed lessons by date..
// fr : Afficher les leçons terminées par date.
// ----------------------------------------------------
        $progresses = $this->getUser()
            ? $progressrepository->findBy(['user' => $this->getUser()], ['createdAt' => 'DESC'])
            : [];




        return $this->render('formation/progress/index.html.twig', [
            'controller_name' => 'ProgressController',
            'progresses' => $progresses,
        ]);
    }




// ----------------------------------------------------
// (2) button to delete the achievement.
// fr : bouton pour supprimer le succès
// ----------------------------------------------------

    #[Route('/progress/delete/{id}', name: 'app_progress_delete', methods: ['POST'])]
    public function delete(Progress $progress, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('delete_progress_' . $progress->getId(), $request->request->get('_token'))) {
            throw $this->createAccessDeniedException();
            }

        // Prevents deleting another user's progress.
        if ($progress->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
    }

    $em->remove($progress);
    $em->flush();

    return $this->redirectToRoute('app_progress');
}
}
