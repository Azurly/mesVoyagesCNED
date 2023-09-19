<?php
namespace App\Controller\admin;

use App\Repository\VisiteRepository;
use App\Entity\Visite;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class AdminVoyagesController extends AbstractController{

    private $repository;

    public function __construct(VisiteRepository $repository){
        $this->repository = $repository;
    }
    /**
     * @Route("/admin", name="admin.voyages")
     * @return Response
     */
    public function index() : Response{
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render('admin/admin.voyages.html.twig', ['visites' => $visites]);
    }
    /**
     * @Route("/admin/suppr/{id}", name="admin.voyage.suppr")
     * @Entity("Visite", expr="repository.find(id)")
     * @param Visite $visite
     * @return Response
     */
    public function suppr(Visite $visite) : Response{
        $this->repository->remove($visite, true);
        return $this->redirectToRoute('admin.voyages');
    }
}
?>