<?php

namespace App\Controller\Domains;

use App\Controller\BaseController;
use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends BaseController
{
    private $cardRepo;

    public $session;

    public function __construct(CardRepository $cardRepo, SessionInterface $session){
        $this->cardRepo = $cardRepo;
        $this->session = $session;
    }
    
    /**
     * @Route("/admin", name="admin.index")
     */
    public function index(): Response{
        $cards = $this->cardRepo->findAll();
        return $this->render('domains/admin.html.twig', [
            'cards' => $cards
        ]);
    }
}