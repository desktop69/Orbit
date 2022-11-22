<?php

namespace App\Controller;

use App\Entity\PriceGn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class GeneratePricesController extends AbstractController
{
    /**
     * @Route("/generateprices", name="app_generateprices")
     */
    public function index(): Response
    {
        $gn = $this->getDoctrine()->getRepository(PriceGn::class);

        $pricegn = $gn->findAll();
        return $this->render('generate_prices/index.html.twig', [
            'pricegn' => $pricegn
    ]);
    }

    /**
     * @Route("/generateprices/new", name="app_generateprices_new")
     * @Route("/generateprices/{id}/edit", name="app_generateprices_edit")
     * 
     */
    public function form(PriceGn $pricegn = null,Request $request,EntityManagerInterface $manager)
    {
        // dump($request);
      
        if (!$pricegn){
              $pricegn = new PriceGn();

        }

        $form = $this->createFormBuilder($pricegn)
                     ->add('generation')
                     ->add('price')
                    
                     
                     
                     ->getForm();
        $form->handleRequest($request);
            dump($pricegn);
            if ($form->isSubmitted() && $form->isValid())
            {
                    $manager->persist($pricegn);
                    $manager->flush();

                    return $this->redirectToRoute('app_generateprices', [
                        'id' => $pricegn->getId()
                    ]);
            }
            


        return $this->render('generate_prices/new.html.twig',[
            'formpng' => $form->createView()
        ]);
    }


     /**
     * @Route("/generateprices/delete/{id}", name="app_generateprices_delete")
     */
    public function delete(Request $request, PriceGn $pricegn): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pricegn->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pricegn);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_generateprices');
    }





}
