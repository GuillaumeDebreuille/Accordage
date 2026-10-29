<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductRepository;
use App\Repository\LessonRepository;
use App\Repository\LessonPackRepository;
use App\Entity\PurchaseProduct;
use App\Entity\PurchaseLesson;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

final class OrderController extends AbstractController
{
    #[Route('/order/create-session', name: 'app_stripe_checkout', methods: ['POST'])]
    public function checkout(
        RequestStack $requestStack,
        ProductRepository $productRepository,
        LessonRepository $lessonRepository,
        LessonPackRepository $lessonPackRepository
    ): Response {
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);

        if (empty($cart)) {
            return $this->redirectToRoute('app_cart');
        }

        Stripe::setApiKey($this->getParameter('STRIPE_SECRET_KEY'));

        $lineItems = [];

        foreach ($cart as $type => $items) {
            foreach ($items as $id => $quantity) {
                $itemData = null;
                if ($type === 'product_new' || $type === 'product_used') {
                    $itemData = $productRepository->find($id);
                } elseif ($type === 'lesson') {
                    $itemData = $lessonRepository->find($id);
                } elseif ($type === 'pack') {
                    $itemData = $lessonPackRepository->find($id);
                }

                if ($itemData) {
                    $name = method_exists($itemData, 'getTitle') ? $itemData->getTitle() : $itemData->getName();
                    $price = (float) $itemData->getPrice();

                    $lineItems[] = [
                        'price_data' => [
                            'currency'     => 'eur',
                            'product_data' => [
                                'name' => $name,
                            ],
                            'unit_amount'  => round($price * 100),
                        ],
                        'quantity' => $quantity,
                    ];
                }
            }
        }

        $checkoutSession = StripeSession::create([
            'line_items'           => $lineItems,
            'mode'                 => 'payment',
            'success_url'          => $this->generateUrl('app_order_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url'           => $this->generateUrl('app_order_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return $this->redirect($checkoutSession->url, 303);
    }

    #[Route('/order/success', name: 'app_order_success')]
    public function success(
        RequestStack $requestStack,
        EntityManagerInterface $entityManager,
        ProductRepository $productRepository,
        LessonRepository $lessonRepository,
        LessonPackRepository $lessonPackRepository
    ): Response {
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);
        $user = $this->getUser();

        // Enregistrement des achats en base de données si l'utilisateur est connecté
        if ($user && !empty($cart)) {
            foreach ($cart as $type => $items) {
                foreach ($items as $id => $quantity) {
                    if ($type === 'product_new' || $type === 'product_used') {
                        $product = $productRepository->find($id);
                        if ($product) {
                            // Gestion du stock
                            $newStock = max(0, $product->getStock() - $quantity);
                            $product->setStock($newStock);

                            // Insertion dans purchase_product (répété selon la quantité)
                            for ($i = 0; $i < $quantity; $i++) {
                                $purchase = new PurchaseProduct();
                                $purchase->setUser($user);
                                $purchase->setProduct($product);
                                $purchase->setPricePaid($product->getPrice());
                                $purchase->setCategory($product->getCategory());
                                $purchase->setCreatedAt(new \DateTimeImmutable());
                                $entityManager->persist($purchase);
                            }
                        }
                    } elseif ($type === 'lesson') {
                        $lesson = $lessonRepository->find($id);
                        if ($lesson) {
                            for ($i = 0; $i < $quantity; $i++) {
                                $purchase = new PurchaseLesson();
                                $purchase->setUser($user);
                                $purchase->setLesson($lesson);
                                $purchase->setPricePaid($lesson->getPrice());
                                $purchase->setPurchaseType('lesson');
                                $purchase->setCreatedAt(new \DateTimeImmutable());
                                $entityManager->persist($purchase);
                            }
                        }
                    } elseif ($type === 'pack') {
                        $pack = $lessonPackRepository->find($id);
                        if ($pack) {
                            for ($i = 0; $i < $quantity; $i++) {
                                $purchase = new PurchaseLesson();
                                $purchase->setUser($user);
                                $purchase->setLessonPack($pack);
                                $purchase->setPricePaid($pack->getPrice());
                                $purchase->setPurchaseType('pack');
                                $purchase->setCreatedAt(new \DateTimeImmutable());
                                $entityManager->persist($purchase);
                            }
                        }
                    }
                }
            }
            $entityManager->flush();
        }

        // Vider le panier
        $session->remove('cart');

        return $this->render('shop/order/index.html.twig', ['status' => 'success']);
    }

    #[Route('/order/cancel', name: 'app_order_cancel')]
    public function cancel(): Response
    {
        return $this->render('shop/order/index.html.twig', ['status' => 'cancel']);
    }
}