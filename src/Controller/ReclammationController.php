<?php

namespace App\Controller;

use App\Entity\Reclammation;
use App\Form\ReclammationType;
use App\Repository\ReclammationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/reclammation")
 */
class ReclammationController extends AbstractController
{
  /**
     * @Route("/reclammation", name="recla_create")
     */

    public function create(Request $request, ManagerRegistry $managerRegistry)
    {  
        $recla = new Reclammation();
        $form = $this->createForm(ReclammationType::class,$recla);
        $form->handleRequest($request);
        dump($recla);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $manager=$managerRegistry->getManager();
            $manager->persist($recla);
            $manager->flush();
            return $this->redirectToRoute('recla_create');
        }
        return $this->render('reclammation/create.html.twig', [
            'formRecla' => $form->createView()
        ]);
    }
     /**
     * @Route("/admin/reclammation/mod/{id}", name="uu")
     */
    function update(Request $request,ReclammationRepository $repo,$id)
    {
        $reclas=$repo->find($id);
        $form =$this->createForm(ReclammationType::class,$reclas);
        $form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('app_admin_reclammation');
        }
        return $this->render('admin_reclammation/modifier.html.twig',[
            'formRecla' => $form->createView()
        ]);
    }
        /**
 * @Route("/pdf2", name="pdfrecla")
 */
public function pdf()
{
    // Configure Dompdf according to your needs
    $repository=$this->getDoctrine()->getRepository(Reclammation::class); 
    $pdfOptions = new Options();
    $pdfOptions->set('defaultFont', 'Times New Roman');

    // Instantiate Dompdf with our options
    $dompdf = new Dompdf($pdfOptions);
    $recla=$repository->findAll();
    //l'image est située au niveau du dossier public
    $png = file_get_contents("logo.png");
    $pngbase64 = base64_encode($png);
    // Retrieve the HTML generated in our twig file
    $html = $this->renderView('reclammation/pdf.html.twig', [
         "img64"=>$pngbase64,
         'recla'=>$recla
    ]);
//  $html = $this->renderView('client/pdf.html.twig', [
//      'client'=>$client
// ]);

    // Load HTML to Dompdf
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser (force download)
    $dompdf->stream("reclammation.pdf", [
        "Attachment" => false
    ]);
}
}
