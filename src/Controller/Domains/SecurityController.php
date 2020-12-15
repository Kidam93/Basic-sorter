<?php

namespace App\Controller\Domains;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends BaseController
{
    /**
     * @Route("/login", name="login")
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