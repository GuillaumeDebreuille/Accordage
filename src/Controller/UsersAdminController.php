<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class UsersAdminController extends AbstractController
{
    #[Route('/users/admin', name: 'app_users_admin', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        // Security ! If not an admin, return to the home page
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Accès refusé. Zone réservée à l administration');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('admin/users_admin/index.html.twig', [
            'controller_name' => 'UsersAdminController',
            'users' => $userRepository->findAll(),
        ]);
    }





    // ---------- start of button to edit a user's information ----------

    #[Route('/users/admin/edit/{id}', name: 'app_users_admin_edit', methods: ['POST'])]
    public function edit(
        User $user,
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        // 1/7 : Security ! If not an admin, return to the home page
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Accès refusé. Zone réservée à l administration');
            return $this->redirectToRoute('app_home');
        }

        // 2/7 : Retrieval of submitted data
        $user->setName($request->request->get('name'));
        $user->setFirstName($request->request->get('firstName'));
        $user->setEmail($request->request->get('email'));
        $user->setPhone($request->request->get('phone'));
        $user->setVerified($request->request->has('verified'));

        // 3/7 : Update password only if entered
        $plainPassword = $request->request->get('plainPassword');
        if (!empty($plainPassword)) {
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);
        }

        // 4/7 : Update of the modification date
        $user->setUpdatedAt(new \DateTimeImmutable());

        // 5/7 : Executes the SQL UPDATE query
        $em->flush();

        // 6/7 : confirmation message for the administrator
        $this->addFlash('success', 'Utilisateur mis à jour avec succès.');

        // 7/7 : Redirects to the user list to refresh the page
        return $this->redirectToRoute('app_users_admin');
    }

    // ---------- end of button to edit a user's information ----------

}