<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;



class FormController extends AbstractController
{
     /**
     * @Route("/", name="home")
     */
    public function home( ): Response
    {
                  
        return $this->render('home.html.twig');
    }
    /**
     * @Route("/add", name="add_produit")
     */
    public function add(Request $request, ManagerRegistry $doctrine ): Response
    {
        $produit= new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();  
            $this->addFlash('success', 'Created! ');
          

            return $this->redirectToRoute('home');
        }
       
        
        return $this->render('view.html.twig', [
            'Form' => $form->createView(),
        ]);
    }}