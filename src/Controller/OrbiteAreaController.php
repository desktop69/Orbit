<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Orbit;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OrbitRepository;
use App\Repository\ClientRepository;
use App\Repository\UsersRepository;

class OrbiteAreaController extends AbstractController
{
    /**
     * @Route("/orbitearea", name="app_orbite")
     */
    public function index(OrbitRepository $orbitRepository,ClientRepository $clientRepository): Response
    {
        $orb = $this->getDoctrine()->getRepository(Orbit::class);

        $qb = $orbitRepository->findBypernat();
        
        $orbit = $orbitRepository->findAll();

        return $this->render('orbite_area/index.html.twig',[
            'orbit' => $orbit
    ]);
    }

      /**
     * @Route("/orbitearea/show/{id}", name="app_orbite_show", methods={"GET"})
     */
    public function show(OrbitRepository $orbitRepository,Request $request,UsersRepository $usersRepository): Response
    {   
        $id = $request->get('id');
        $qb = $usersRepository->findBy(array('id'=>$id));
        $re = $orbitRepository->findby(array('parent'=> $qb));
        $user = $this->getUser();
        
        if($id)
        {
            return $this->redirectToRoute('app_orbite');   
        }
        
        return $this->render('orbite/show.html.twig', [
            'orbits' => $re,
            'orbitt' => $qb,  
        ]);
        
    }


  


}
