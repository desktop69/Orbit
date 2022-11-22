<?php

namespace App\Controller;

use App\Entity\Historique;
use App\Entity\Performance;
use App\Form\HistoriqueType;
use App\Repository\HistoriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/historique")
 */
class HistoriqueController extends AbstractController
{
    /**
     * @Route("/{id}", name="historique_index", methods={"GET"})
     */
    public function index(HistoriqueRepository $historiqueRepository,Performance $performance ,Request $request): Response
    {
        $id = $request->get('id');
        $historique = $historiqueRepository->findby(array('performance'=>$id));
        return $this->render('historique/index.html.twig', [
            'historiques' => $historique,
            'perfrmanceShow'=> $id,
            'performance'=>$performance,
        ]);
    }


    /**
     * @Route("/{id}/new", name="historique", methods={"GET","POST"})
     */
    public function new(Request $request, Performance $performance): Response
    {
        $id = $request->get('id');
        $historique = new Historique();
        $form = $this->createForm(HistoriqueType::class, $historique);
        $form->handleRequest($request);

        $CurrentBalance = $performance->getSoldBiens();
        if ($form->isSubmitted() && $form->isValid()) {

            $total = $performance->getRemTotal();
            
            $Earnedearnings = $historique->getRemAcquis();
            $RemunerationConsumed = $historique->getRemConsommees ();
            $soldesolvable = $performance->getSoldSolvable();
            $solde = $CurrentBalance - $RemunerationConsumed;
        if($RemunerationConsumed)
        {
            if( $solde >= 0 )
            {
                $soldesolvable = $soldesolvable + $RemunerationConsumed;
                $performance->setSoldSolvable($soldesolvable);
                $performance->setSoldBiens($solde);
                $historique->setPerformance($performance);
                $historique->setDate(new \DateTime());
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($historique);
                $entityManager->flush();
                return $this->redirectToRoute('performance_show',array('id'=>$id));
    
                
            }
            else
            {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Insufficient balance ! You have '
                );
                
            }

        }

        if($Earnedearnings)
        {
            $total = $total + $Earnedearnings;
            $CurrentBalance = $CurrentBalance + $Earnedearnings;
            $performance->setSoldBiens($CurrentBalance);
            $performance->setRemTotal($total);
            $historique->setPerformance($performance);
            $historique->setDate(new \DateTime());
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($historique);
            $entityManager->persist($performance);
            $entityManager->flush();
            return $this->redirectToRoute('performance_show',array('id'=>$id));
    
        }
        
    }
    


        return $this->render('historique/new.html.twig', [
            'historique' => $historique,
            'form' => $form->createView(),
            'perfrmanceShow'=> $id,
            'solde'=>$CurrentBalance,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="historique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Historique $historique): Response
    {
        $aa=$historique->getRemAcquis();
        $bb=$historique->getRemConsommees();
        $performance = $historique->getPerformance();
        $total = $performance->getRemTotal();
        $SoldBiens= $performance->getSoldBiens();
        $SoldSolvable= $performance->getSoldSolvable();
        $solde = $SoldBiens;
        $id = $performance->getId();
        
        $form = $this->createForm(HistoriqueType::class, $historique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cc=$historique->getRemAcquis();
            $dd=$historique->getRemConsommees();
            $somAcquis = $cc-$aa;
            $somConsommees = $bb-$dd;

            if($somAcquis != 0)
            {
                $total= $total + $somAcquis;
                $SoldBiens = $SoldBiens + $somAcquis;    
            }

            if($somConsommees != 0)
            {
                $SoldSolvable = $SoldSolvable - $somConsommees;
                $SoldBiens = $SoldBiens + $somConsommees;

            }

            $performance->setSoldSolvable($SoldSolvable);
            $performance->setRemTotal($total);
            $performance->setSoldBiens($SoldBiens); 
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($performance);
            
            
            if($SoldBiens < 0)
            {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Insufficient balance ! You have '
                );
            } 
            else
            {
                $entityManager->flush();
                return $this->redirectToRoute('historique_index',array('id'=>$id));
            }

            
        }

        return $this->render('historique/edit.html.twig', [
            'historique' => $historique,
            'form' => $form->createView(),
            'performance'=>$id,
            'solde'=>$solde,
        ]);
    }

    /**
     * @Route("/{id}", name="historique_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Historique $historique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$historique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($historique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('historique_index');
    }
}