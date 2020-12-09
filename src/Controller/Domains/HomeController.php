<?php

namespace App\Controller\Domains;

use App\Controller\BaseController;
use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{
    private $cardRepo;

    public function __construct(CardRepository $cardRepo){
        $this->cardRepo = $cardRepo;
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