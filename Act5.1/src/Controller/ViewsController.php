<?php

namespace App\Controller;

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
    public function show(): Response
    {  $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('views/view1.html.twig');
    }

     /**
     * @Route("views2", name="_anonymos_page")
     */
    public function show2(): Response
    {
        return $this->render('views/view2.html.twig');
    }
}
