<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDenied implements AccessDeniedHandlerInterface
{
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
        
    {
        // todo: CUSTOM LOG THIS EVENT!
        /** @var UsernamePasswordToken $token */
        $token = $this->token_storage->getToken();
        $anyAdminRoles = false;
        foreach ($token->getRoles() as $role) {
            /** @var Role $role */
            if (stripos($role->getRole(), 'ROLE_ADMIN') !== false) {
                $anyAdminRoles = true;
                break;
            }
        }
        if ($accessDeniedException->getCode() == 403 && stripos($request->getPathInfo(), '/admin') !== false) {
            if (!$anyAdminRoles) {
                $content = $this->twig->render('admin/exception/error403.html.twig', array('accessDeniedMessage' => 'You are not authorized to access the Fraternity of Light Admin'));
            } else {
                $content = $this->twig->render('admin/adminindex.html.twig', array('accessDeniedMessage' => 'You do not have permission to view the requested resource'));
            }
            $response = new Response();
            $response->setContent($content);
            $response->setStatusCode($accessDeniedException->getCode());
            return $response;
        }
    }
}