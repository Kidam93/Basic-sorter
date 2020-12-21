<?php

namespace App\Application\Controller;

use App\Repository\CardRepository;
use App\Application\BaseController;
use App\Repository\AdminRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends BaseController
{
    private $cardRepo;

    private $session;

    private $adminRepo;

    public function __construct(CardRepository $cardRepo, 
                                SessionInterface $session,
                                AdminRepository $adminRepo
    ){
        $this->cardRepo = $cardRepo;
        $this->session = $session;
        $this->adminRepo = $adminRepo;
    }
    
    /**
     * @Route("/", name="home")
     */
    public function index(): Response{
        $cards = $this->cardRepo->findAll();
        return $this->render('domains/home.html.twig', [
            'cards' => $cards
        ]);
    }
}