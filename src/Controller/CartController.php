<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\ProductRepository;
use App\Repository\LessonRepository;
use App\Repository\LessonPackRepository;

final class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        RequestStack $requestStack,
        ProductRepository $productRepository,
        LessonRepository $lessonRepository,
        LessonPackRepository $lessonPackRepository
    ): Response {

        // 1 : Retrieving settings
        $type = $request->query->get('type');
        $id = $request->query->get('id');
        $action = $request->query->get('action');
        $quantity = (int) $request->request->get('quantity', 1);

        // 2 : Session recovery
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);

        // 3 : Processing actions (POST)
        if ($request->isMethod('POST') && $type && $id) {

            // 4 : Actions (remove, update_quantity, or add)
            // requested action : the deletion of an element
            if ($action === 'remove') { 
                if (isset($cart[$type][$id])) {
                    unset($cart[$type][$id]);
                    
                    if (empty($cart[$type])) {
                        unset($cart[$type]);
                    }
                }
            // requested action : modify the quantity of a product (new or used)
            } elseif ($action === 'update_quantity' && ($type === 'product_new' || $type === 'product_used')) {
                $product = $productRepository->find($id);
                $stockMax = $product ? $product->getStock() : 0;
                $newQty = max(1, $quantity);

                if ($newQty > $stockMax) {
                    $cart[$type][$id] = $stockMax;
                } else {
                    $cart[$type][$id] = $newQty;
                }
            } else {

                // 5 : Product(s) processing
                if ($type === 'product_new' || $type === 'product_used') {
                    $product = $productRepository->find($id);
                    $stockMax = $product ? $product->getStock() : 0;

                    if (isset($cart[$type][$id])) {
                        $total = $cart[$type][$id] + $quantity;

                        if ($total > $stockMax) {
                            $cart[$type][$id] = $stockMax;
                        } else {
                            $cart[$type][$id] = $total;
                        }
                    } else {
                        if ($quantity > $stockMax) {
                            $cart[$type][$id] = $stockMax;
                        } else {
                            $cart[$type][$id] = $quantity;
                        }
                    }
                } else {
                    // Leçon(s) and pack(s) processing (max 1)
                    $cart[$type][$id] = 1;
                }

                // 6 : Cleanup / Reconciliation – Pack & Lessons
                if (isset($cart['pack'])) {
                    foreach ($cart['pack'] as $packId => $packQty) {
                        $lessonsInPack = $lessonRepository->findBy(['lessonPack' => $packId]);

                        foreach ($lessonsInPack as $lesson) {
                            $lessonId = $lesson->getId();

                            if (isset($cart['lesson'][$lessonId])) {
                                unset($cart['lesson'][$lessonId]);
                            }
                        }
                    }
                }
            }

            // 7 : Sauvegarde en session
            $session->set('cart', $cart);

            // 8 : Redirection SECURITY
            $referer = $request->headers->get('referer');

            if ($referer && !str_contains($referer, '/cart')) {
                return $this->redirect($referer);
            }
            return $this->redirectToRoute('app_cart');
        }

        // 9 : Preparing the final array for the Twig view
        $cartData = [];

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
                    $cartData[] = [
                        'type'     => $type,
                        'element'  => $itemData,
                        'quantity' => $quantity
                    ];
                }
            }
        }

        return $this->render('shop/cart/index.html.twig', [
            'controller_name' => 'CartController',
            'cartData' => $cartData
        ]);
    }
}