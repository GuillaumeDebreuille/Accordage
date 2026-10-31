<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\LessonPack;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrainingsAdminController extends AbstractController
{
    #[Route('/trainings/admin', name: 'app_trainings_admin')]
    public function index(EntityManagerInterface $em): Response
    {
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Accès refusé. Zone réservée à l administration');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('admin/trainings_admin/index.html.twig', [
            'lessons' => $em->getRepository(Lesson::class)->findAll(),
            'packs' => $em->getRepository(LessonPack::class)->findAll(),
        ]);
    }

    #[Route('/trainings/admin/lesson/add', name: 'app_lesson_admin_add', methods: ['POST'])]
    public function addLesson(Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_home');
        }

        $lesson = new Lesson();
        $lesson->setTitle($request->request->get('title'));
        $lesson->setContent($request->request->get('content', ''));
        $lesson->setVideoUrl($request->request->get('video_url'));
        $lesson->setDescription($request->request->get('description'));
        $lesson->setPrice((float)$request->request->get('price'));
        $lesson->setImages($request->request->get('images'));
        $lesson->setInstrument($request->request->get('instrument'));
        
        $packId = $request->request->get('lesson_pack_id');
        if ($packId) {
            $pack = $em->getRepository(LessonPack::class)->find($packId);
            $lesson->setLessonPack($pack);
        }

        $lesson->setCreatedAt(new \DateTimeImmutable());
        $lesson->setUpdatedAt(new \DateTimeImmutable());

        $em->persist($lesson);
        $em->flush();

        return $this->redirectToRoute('app_trainings_admin');
    }

    #[Route('/trainings/admin/lesson/edit/{id}', name: 'app_lesson_admin_edit', methods: ['POST'])]
    public function editLesson(int $id, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_home');
        }

        $lesson = $em->getRepository(Lesson::class)->find($id);
        if ($lesson) {
            $lesson->setTitle($request->request->get('title'));
            $lesson->setContent($request->request->get('content', ''));
            $lesson->setVideoUrl($request->request->get('video_url'));
            $lesson->setDescription($request->request->get('description'));
            $lesson->setPrice((float)$request->request->get('price'));
            $lesson->setImages($request->request->get('images'));
            $lesson->setInstrument($request->request->get('instrument'));

            $packId = $request->request->get('lesson_pack_id');
            $pack = $packId ? $em->getRepository(LessonPack::class)->find($packId) : null;
            $lesson->setLessonPack($pack);

            $lesson->setUpdatedAt(new \DateTimeImmutable());
            $em->flush();
        }

        return $this->redirectToRoute('app_trainings_admin');
    }

    #[Route('/trainings/admin/lesson/delete/{id}', name: 'app_lesson_admin_delete', methods: ['POST'])]
    public function deleteLesson(int $id, EntityManagerInterface $em): Response
    {
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_home');
        }

        $lesson = $em->getRepository(Lesson::class)->find($id);
        if ($lesson) {
            $em->remove($lesson);
            $em->flush();
        }

        return $this->redirectToRoute('app_trainings_admin');
    }

    #[Route('/trainings/admin/pack/add', name: 'app_pack_admin_add', methods: ['POST'])]
    public function addPack(Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_home');
        }

        $pack = new LessonPack();
        $pack->setTitle($request->request->get('title'));
        $pack->setDescription($request->request->get('description'));
        $pack->setPrice((float)$request->request->get('price'));
        $pack->setImage($request->request->get('image'));
        $pack->setInstrument($request->request->get('instrument'));
        
        $pack->setCreatedAt(new \DateTimeImmutable());
        $pack->setUpdatedAt(new \DateTimeImmutable());

        $em->persist($pack);
        $em->flush();

        return $this->redirectToRoute('app_trainings_admin');
    }

    #[Route('/trainings/admin/pack/edit/{id}', name: 'app_pack_admin_edit', methods: ['POST'])]
    public function editPack(int $id, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_home');
        }

        $pack = $em->getRepository(LessonPack::class)->find($id);
        if ($pack) {
            $pack->setTitle($request->request->get('title'));
            $pack->setDescription($request->request->get('description'));
            $pack->setPrice((float)$request->request->get('price'));
            $pack->setImage($request->request->get('image'));
            $pack->setInstrument($request->request->get('instrument'));

            $pack->setUpdatedAt(new \DateTimeImmutable());
            $em->flush();
        }

        return $this->redirectToRoute('app_trainings_admin');
    }

    #[Route('/trainings/admin/pack/delete/{id}', name: 'app_pack_admin_delete', methods: ['POST'])]
    public function deletePack(int $id, EntityManagerInterface $em): Response
    {
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_home');
        }

        $pack = $em->getRepository(LessonPack::class)->find($id);
        if ($pack) {
            $em->remove($pack);
            $em->flush();
        }

        return $this->redirectToRoute('app_trainings_admin');
    }
}