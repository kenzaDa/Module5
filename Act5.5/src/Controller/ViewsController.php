<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewsController extends AbstractController
{
    /**
     * @Route("profile/views", name="_profiler_home")
     */
    public function index(): Response
   
        {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            return $this->render('views/index.html.twig', [
            'controller_name' => 'ViewsController',
        ]);
    }



     /**
     * @Route("/admin/views1", name="_admin_home")
     */
    public function showAction(Request $request, DataTableFactory $dataTableFactory):Response
    { 
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
      
        
        $table = $dataTableFactory->create()
            ->add('id', TextColumn::class,['label' => 'Identifiant'])
            ->add('email', TextColumn::class,['label' => 'Adresse mail'])
            ->add('Action', TextColumn::class,['label' => 'Action'])
            ->createAdapter(ORMAdapter::class, [
                'entity' => User::class,
            ])
            ->handleRequest($request);
        if ($table->isCallback()) {
            return $table->getResponse();
        }
      
        return $this->render('views/view1.html.twig', ['datatable' => $table]);

            // public function show(): Response
    // {  $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    //     return $this->render('views/view1.html.twig');
    // }
    }




     /**
     * @Route("views2", name="_anonymos_page")
     */
    public function show2(): Response
    {
        return $this->render('views/view2.html.twig');
    }
}
