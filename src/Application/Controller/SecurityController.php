<?php

namespace App\Application\Controller;

use App\Application\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter;

class SecurityController extends BaseController
{
    /**
     * @Route("/login", name="login")
     * 
     */
    public function index(AuthenticationUtils $authentificationUtils){
        $lastUsername = $authentificationUtils->getLastUsername();
        $error = $authentificationUtils->getLastAuthenticationError();
        return $this->render('domains/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
}