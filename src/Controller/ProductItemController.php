<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductItemController extends AbstractController
{
    /**
     * @Route("/product/item", name="product_item")
     */
    public function index(): Response
    {
        return $this->render('product_item/index.html.twig', [
            'controller_name' => 'ProductItemController',
        ]);
    }
}
