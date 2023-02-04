<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopHomeController extends AbstractController
{
    /**
     * @Route("/", name="app_shop_home")
     */
    public function index(): Response
    {
        return $this->render('shop_home/index.html.twig', [
            'controller_name' => 'ShopHomeController',
        ]);
    }
}
