<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CarsRepository;


class BasketController extends AbstractController
{
    


    #[Route('/basket', name: 'basket')]
    public function index(Request $request, CarsRepository $CarsRepository): Response
    {
        // Retrieve the basket from the session
        $session = $request->getSession();
        $basket = $session->get('basket', []);

        // Fetch product details from the database based on product IDs in the basket
        $productIds = array_keys($basket);
        $products = $CarsRepository->findCarsByIds($productIds);

         // Calculate total
         $total = 0;
         foreach ($products as $product) {
             $productId = $product->getId();
             $quantity = $basket[$productId];
             $total += $product->getPrice() * $quantity;
         }

         return $this->render('basket/index.html.twig', [
            'products' => $products,
            'basket' => $basket,
            'total' => $total,
        ]);
        
    }

    #[Route('/update-quantity/{productId}', name: 'update_quantity', methods: ['POST'])]
    public function updateQuantity(Request $request, int $productId): Response
    {
        $quantity = $request->request->getInt('quantity', 0);
        
        // Update the quantity in the basket session
        $session = $request->getSession();
        $basket = $session->get('basket', []);
        $basket[$productId] = $quantity;
        $session->set('basket', $basket);

        // Redirect back to the basket page
        return $this->redirectToRoute('basket');
    }

    #[Route('/remove-from-basket/{productId}', name: 'remove_from_basket', methods: ['POST'])]
    public function removeFromBasket(Request $request, int $productId): Response
    {
        // Remove the item from the basket session
        $session = $request->getSession();
        $basket = $session->get('basket', []);
        unset($basket[$productId]);
        $session->set('basket', $basket);

        // Redirect back to the basket page
        return $this->redirectToRoute('basket');
    }

}
