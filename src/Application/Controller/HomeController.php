<?php

namespace App\Application\Controller;

use App\Repository\CardRepository;
use App\Application\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends BaseController
{
    private $cardRepo;

    private $session;

    public function __construct(CardRepository $cardRepo, SessionInterface $session){
        $this->cardRepo = $cardRepo;
        $this->session = $session;
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