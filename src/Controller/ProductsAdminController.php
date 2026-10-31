<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductsAdminController extends AbstractController
{
    #[Route('/products/admin', name: 'app_products_admin', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        // Check that the current user is an administrator.
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Accès refusé. Zone réservée à l’administration.');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('admin/products_admin/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/products/admin/add', name: 'app_products_admin_add', methods: ['POST'])]
    public function add(
        Request $request,
        EntityManagerInterface $em
    ): Response {
        // Check that the current user is an administrator.
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Accès refusé. Zone réservée à l’administration.');
            return $this->redirectToRoute('app_home');
        }

        // Decode the images field as a JSON array.
        $imagesValue = $request->request->get('images', '[]');
        $images = json_decode($imagesValue, true);

        if (!is_array($images)) {
            $this->addFlash('error', 'Le champ images doit contenir un tableau JSON valide.');
            return $this->redirectToRoute('app_products_admin');
        }

        $product = new Product();
        $product->setName($request->request->get('name', ''));
        $product->setCategory($request->request->get('category', 'other'));
        $product->setDescription($request->request->get('description', ''));
        $product->setPrice((float) $request->request->get('price', 0));
        $product->setStock((int) $request->request->get('stock', 0));
        $product->setIsUsed($request->request->has('isUsed'));
        $product->setImages($images);

        // Set creation and modification dates.
        $now = new \DateTimeImmutable();
        $product->setCreatedAt($now);
        $product->setUpdatedAt($now);

        $em->persist($product);
        $em->flush();

        $this->addFlash('success', 'Produit ajouté avec succès.');

        return $this->redirectToRoute('app_products_admin');
    }

    #[Route('/products/admin/edit/{id}', name: 'app_products_admin_edit', methods: ['POST'])]
    public function edit(
        Product $product,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        // Check that the current user is an administrator.
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Accès refusé. Zone réservée à l’administration.');
            return $this->redirectToRoute('app_home');
        }

        // Decode the images field as a JSON array.
        $imagesValue = $request->request->get('images', '[]');
        $images = json_decode($imagesValue, true);

        if (!is_array($images)) {
            $this->addFlash('error', 'Le champ images doit contenir un tableau JSON valide.');
            return $this->redirectToRoute('app_products_admin');
        }

        $product->setName($request->request->get('name', ''));
        $product->setCategory($request->request->get('category', 'other'));
        $product->setDescription($request->request->get('description', ''));
        $product->setPrice((float) $request->request->get('price', 0));
        $product->setStock((int) $request->request->get('stock', 0));
        $product->setIsUsed($request->request->has('isUsed'));
        $product->setImages($images);

        // Update the modification date.
        $product->setUpdatedAt(new \DateTimeImmutable());

        $em->flush();

        $this->addFlash('success', 'Produit mis à jour avec succès.');

        return $this->redirectToRoute('app_products_admin');
    }
}