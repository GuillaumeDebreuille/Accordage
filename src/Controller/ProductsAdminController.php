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
        // Sécurité admin
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Accès refusé. Zone réservée à l administration');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('admin/products_admin/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    // product update button
    #[Route('/products/admin/edit/{id}', name: 'app_products_admin_edit', methods: ['POST'])]
    public function edit(
        Product $product,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        // Sécurité admin
        if (!$this->getUser() || !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Accès refusé. Zone réservée à l administration');
            return $this->redirectToRoute('app_home');
        }

        // Retrieving and updating form data
        $product->setName($request->request->get('name'));
        $product->setCategory($request->request->get('category'));
        $product->setDescription($request->request->get('description'));
        $product->setPrice((float) $request->request->get('price'));
        $product->setStock((int) $request->request->get('stock'));
        $product->setIsUsed($request->request->has('isUsed'));
        
        // Retrieves the text value and converts it into an array (via json_decode), or keeps an empty array.
        $imagesValue = $request->request->get('images');
        $product->setImages(is_string($imagesValue) ? json_decode($imagesValue, true) : $imagesValue);

        // Automatic update of the modification date
        $product->setUpdatedAt(new \DateTimeImmutable());

        $em->flush();

        $this->addFlash('success', 'Produit mis à jour avec succès.');

        return $this->redirectToRoute('app_products_admin');
    }
}
