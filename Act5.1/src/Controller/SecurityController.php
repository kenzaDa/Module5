<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {return $this->render('views/view2.html.twig');
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        
    }


    /**
 * @Route("/access-denied", name="app_access_denied")
 */
public function accessDenied()
{
    if ( $this->getUser() ) {
        return $this->redirectToRoute('_profiler_home');
    }

    return $this->redirectToRoute('app_login');
}



   /**
 * @Route("/access-onlyadmin", name="app_denied")
 */
public function accessonlyadmin()
{
    if ( $this->getUser() ) {
        return $this->redirectToRoute('_profiler_home');
    }

    return $this->redirectToRoute('_admin_home');
}
}



