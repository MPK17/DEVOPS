<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Client::class);
        $client = $repo->findAll();
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
            'client' => $client
        ]);
    }
   /**
   * @Route("/client/new",name="client_create")
   */
   public function create(Request $request, ManagerRegistry $managerRegistry)
   {
    
       $client = new Client();
 $form = $this->createForm(ClientType::class,$client);
 $form->handleRequest($request);
 dump($client);
if ($form->isSubmitted()&& $form->isValid()) {
   $manager=$managerRegistry->getManager();
   $manager->persist($client);
   $manager->flush();
   return $this->redirectToRoute('client_create');
} 
 return $this->render('client/create.html.twig',[
     'formClient' => $form->createView()
 ]);
 
   }

   /**
     * @Route("/admin/client/mod/{id}", name="u")
     */
    function update(Request $request,ClientRepository $repo,$id)
    {
        $clients=$repo->find($id);
        $form =$this->createForm(ClientType::class,$clients);
        $form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('app_admin_client');
        }
        return $this->render('admin_client/modifier.html.twig',[
            'formClient' => $form->createView()
        ]);
    }
}
