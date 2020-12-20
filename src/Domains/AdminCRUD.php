<?php 
namespace App\Controller\Domains;

use App\Entity\Card;
use App\Form\AdminCardCrudType;
use App\Repository\CardRepository;
use App\Application\BaseController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdminCRUD extends BaseController{

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

    
    public function CardEdit($id, $form){
        $request = $this->request->getCurrentRequest();
        $card = $this->cardRepo->find($id);
        $data = $form->getData();
        $card->setTitle($data->getTitle())
            ->setImg($data->getImg())
            ->setDescription($data->getDescription());
        $this->em->persist($card);
        $this->em->flush();
    }

    public function CardNew($form){
        $card = new Card();
        $request = $this->request->getCurrentRequest();
        $data = $form->getData();
        $card->setTitle($data->getTitle())
            ->setImg($data->getImg())
            ->setDescription($data->getDescription());
        $this->em->persist($card);
        $this->em->flush();
    }
}