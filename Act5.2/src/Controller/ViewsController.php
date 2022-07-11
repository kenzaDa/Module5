<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\Mapping\Id;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
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


  /**
     * @Route("views3", name="_show_page")
     */
    public function show3(Request $request )
   {  
        
        $users = $this->getDoctrine() 
           ->getRepository(User::class) 
           ->findAll();  
           
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {  
           $jsonData = array();  
           $idx = 0;  
           foreach($users as $user) {  
              $temp = array(
                 'username' => $user->getEmail(),  
                 'id' => $user->getId(),  
               
              );   
              $jsonData[$idx++] = $temp;  
           } 
           return new JsonResponse($jsonData); 
        } else { 
           return $this->render('views/ajax.html.twig',[
            'username' => 'username',
        ]); 
        } 

    }

   
    
 }

