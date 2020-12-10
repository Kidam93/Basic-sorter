<?php

namespace App\Controller\Domains;

use App\Controller\BaseController;
use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends BaseController
{
    private $cardRepo;

    public function __construct(CardRepository $cardRepo){
        $this->cardRepo = $cardRepo;
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