<?php

namespace App\Controller;

use App\Form\CategoryType;
use App\Repository\CategorieProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieAdminController extends AbstractController
{
    /**
     * @Route("/categorie/admin", name="app_categorie_admin")
     */
    public function index(CategorieProduitRepository $rep): Response
    {

        $categorie = $rep->findAll();

        $form = $this->createForm(CategoryType::class);

        return $this->render('categorie_admin/index.html.twig', [
            'controller_name' => 'CategorieAdminController',
            'categories' => $categorie,
            'formCategorie' => $form->createView(),
        ]);
    }
}
