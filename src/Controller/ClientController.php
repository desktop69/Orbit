<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Client;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Forms;
use Doctrine\ORM\EntityManagerInterface;
use PharIo\Manifest\Email;
use Stringable;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ClientController extends AbstractController
{
   

    /**
     * @Route("/client", name="app_cl")
     */
    public function index(): Response
    {
            $cl = $this->getDoctrine()->getRepository(Client::class);

            $client = $cl->findAll();

        return $this->render('client/index.html.twig', [
                'client' => $client
        ]);
    }
    

    /**
     * @Route("/client/new", name="app_cl_new")
     * @Route("/client/{id}/edit", name="app_cl_edit")
     * 
     */
    public function form(Client $client = null,Request $request,EntityManagerInterface $manager)
    {
        //  dump($request);
      
        if (!$client){
              $client = new Client();

        }

        $form = $this->createFormBuilder($client)
                     ->add('email',EmailType::class)
                     ->add('f_name')
                     ->add('l_name')
                     ->add('cin')
                     ->add('isActive')
                     ->add('phone1')
                     ->add('phone2')
                     ->add('birthdate',DateType::class)
                     ->add('adress')
                     ->add('commerce')
                     ->add('imageFile',VichImageType::class)
                     ->getForm();
        $form->handleRequest($request);
            dump($client);
            if ($form->isSubmitted() && $form->isValid())
            {
            $client->setCreatedAt(new \DateTime());
            $expires = new \DateTime();
            $expires->modify('+1 year');
            $expires->format('Y-m-d H:i:s');
            $client->setExpiredAt($expires);

                    $manager->persist($client);
                    $manager->flush();

                    return $this->redirectToRoute('app_cl', [
                        'id' => $client->getId()
                    ]);
            }
            


        return $this->render('client/create.html.twig',[
            'formClient' => $form->createView()
        ]);
    }


     /**
     * @Route("/client/delete/{id}", name="app_cl_delete", methods={"POST"})
     */
    public function delete(Request $request, Client $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cl');
    }


}
