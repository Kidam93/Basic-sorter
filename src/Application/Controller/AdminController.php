<?php

namespace App\Application\Controller;

use App\Entity\Card;
use App\Form\AdminCardCrudType;
use App\Repository\CardRepository;
use App\Application\BaseController;
use App\Controller\Domains\AdminCRUD;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdminController extends BaseController
{
    private $cardRepo;

    private $session;

    private $request;

    private $em;

    public function __construct(CardRepository $cardRepo, 
                                SessionInterface $session,
                                RequestStack $request,
                                EntityManagerInterface $em){
        $this->cardRepo = $cardRepo;
        $this->session = $session;
        $this->request = $request;
        $this->em = $em;
    }
    
    /**
     * @Route("/admin", name="admin.index")
     */
    public function index(): Response{
        $cards = $this->cardRepo->findAll();
        return $this->render('domains/admin/admin.html.twig', [
            'cards' => $cards
        ]);
    }

    /**
     * @Route("/admin-show-{id}", name="admin.show")
     */
    public function show($id): Response{
        $card = $this->cardRepo->find($id);
        return $this->render('domains/admin/admin-show.html.twig', [
            'card' => $card
        ]);
    }

    /**
     * @Route("/admin-edit-{id}", name="admin.edit")
     */
    public function edit($id): Response{
        $card = $this->cardRepo->find($id);
        $form = $this->createForm(AdminCardCrudType::class, $card);
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $adminCrud = new AdminCRUD($this->cardRepo, $this->session, $this->request, $this->em);
            $adminCrud->CardEdit($id, $form);
            return $this->redirectToRoute('admin.index');
        }
        return $this->render('domains/admin/admin-edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin-delete-{id}", name="admin.delete", methods="DELETE")
     */
    public function delete($id): Response{
        $card = $this->cardRepo->find((int)$id);
        $this->em->remove($card);
        $this->em->flush();
        return $this->redirectToRoute('admin.index');
    }

    /**
     * @Route("/admin-new", name="admin.new", methods="POST|GET")
     */
    public function new(): Response{
        $card = new Card();
        $form = $this->createForm(AdminCardCrudType::class, $card);
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $adminCrud = new AdminCRUD($this->cardRepo, $this->session, $this->request, $this->em);
            $adminCrud->CardNew($form);
            return $this->redirectToRoute('admin.index');
        }
        return $this->render('domains/admin/admin-new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}