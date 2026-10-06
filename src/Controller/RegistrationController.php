<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, 
    UserPasswordHasherInterface $userPasswordHasher, 
    EntityManagerInterface $entityManager,
    Security $security,
    MailerInterface $mailer,
    VerifyEmailHelperInterface $verifyEmailHelper): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);



    if ($form->isSubmitted() && $form->isValid()) {
        /** @var string $plainPassword */
        $plainPassword = $form->get('plainPassword')->getData();

        // encode the plain password
        $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

        $now = new \DateTimeImmutable();
        $user->setCreatedAt($now);
        $user->setUpdatedAt($now);
        $user->setVerified(false);

        $isAdmin = (bool) $form->get('isAdmin')->getData();
        $user->setRoles($isAdmin ? ['ROLE_ADMIN'] : ['ROLE_USER']);

        $entityManager->persist($user);
        $entityManager->flush();

        $signature = $verifyEmailHelper->generateSignature(
            'app_verify_email',
            (string) $user->getId(),
            (string) $user->getEmail(),
            ['id' => $user->getId()]
        );

        $email = (new TemplatedEmail())
            ->from(new Address('no-reply@accordage.local', 'Accordage'))
            ->to((string) $user->getEmail())
            ->subject('Confirmez votre adresse e-mail')
            ->htmlTemplate('account/registration/confirmation_email.html.twig')
            ->context(['signedUrl' => $signature->getSignedUrl()]);

        $mailer->send($email);

        $response = $security->login($user, LoginFormAuthenticator::class);

        return $response ?? $this->redirectToRoute('app_home');
    }


    
        return $this->render('account/registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }


    #[Route('/verify/email/{id}', name: 'app_verify_email', methods: ['GET'])]
public function verifyEmail(
    int $id,
    Request $request,
    VerifyEmailHelperInterface $verifyEmailHelper,
    EntityManagerInterface $entityManager
): Response {
    $user = $entityManager->getRepository(User::class)->find($id)
        ?? throw $this->createNotFoundException();

    try {
        $verifyEmailHelper->validateEmailConfirmationFromRequest(
            $request,
            (string) $user->getId(),
            (string) $user->getEmail()
        );
    } catch (VerifyEmailExceptionInterface) {
        $this->addFlash('email_verification', 'Le lien est invalide ou expiré.');

        return $this->redirectToRoute('app_home');
    }

    $user->setVerified(true);
    $entityManager->flush();
    $this->addFlash('email_verification', 'Adresse e-mail confirmée.');

    return $this->redirectToRoute('app_home');
}



}
