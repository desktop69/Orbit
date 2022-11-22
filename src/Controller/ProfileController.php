<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig');
    }

    /**
     * @Route("/profile/list", name="app_profile_list")
     */
    public function list(): Response
    {
        $usr = $this->getDoctrine()->getRepository(Users::class);

        $users = $usr->findAll();
        return $this->render('profile/listProfile.html.twig',[
            'users' => $users
        ]);
    }


    /**
     * @Route("/profile/{id}/Edit", name="app_profile_Edit")
     */
    public function Edit(Users $users, Request $request, EntityManagerInterface $manager): Response
    {
        
        $form = $this->createFormBuilder($users)
        ->add('email')
        ->add('fullname')
        ->add('phone')
        ->getForm()
        ;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
            {
  
                    $manager->persist($users);
                    $manager->flush();

                    return $this->redirectToRoute('app_profile', [
                        'id' => $users->getId()
                    ]);
            }

        return $this->render('profile/EditProfile.html.twig',[
            'formProfile' => $form->createView()
        ]);
    }

    
    // /**
    //  * @Route("/profile/list/add", name="app_profile_add")
    //  */
    // public function add(Users $users, Request $request, EntityManagerInterface $manager): Response
    // {
        
    //         $users = new Users();
        
    //     $form = $this->createFormBuilder($users)
    //     ->add('email')
    //     ->add('fullname')
    //     ->add('phone')
    //     ->add('password')
    //     ->add('img')
    //     ->getForm()
    //     ;
    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid())
    //         {
  
    //                 $manager->persist($users);
    //                 $manager->flush();

    //                 return $this->redirectToRoute('app_profile_list', [
    //                     'id' => $users->getId()
    //                 ]);
    //         }

    //     return $this->render('profile/addProfile.html.twig',[
    //         'formaddProfile' => $form->createView()
    //     ]);
    // }

    



}

