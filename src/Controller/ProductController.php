<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    #[Route('/product/{id}/add-to-basket', name: 'add_to_basket')]
    public function addToBasket(Request $request, $id): Response
    {
        $quantity = $request->request->getInt('quantity', 1);

        // Get the basket from session
        $session = $request->getSession();
        $basket = $session->get('basket', []);

         // Add or update quantity in the basket           
         //Array will look like this [$id(key) => quantity]
         if (isset($basket[$id])) {
            $basket[$id] += $quantity;
        } else {
            $basket[$id] = $quantity;
        }

        // Save the updated basket to session
        $session->set('basket', $basket);
        
       
        // Redirect back to the product page or any other page as needed
        return $this->redirectToRoute('cars', ['id' => $id]);
    }

    //Clear checkout
    #[Route('/checkout', name: 'checkout')]
    public function checkout(Request $request): Response
    {
        // Clear the basket session
        $request->getSession()->remove('basket');

        // Redirect to the home page or any other page as needed
        return $this->redirectToRoute('cars');
    }
}
