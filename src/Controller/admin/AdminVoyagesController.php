<?php
namespace App\Controller\admin;

use App\Form\VisiteType;
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
    /**
     * @Route("admin/edit/{id}", name="admin.voyage.edit")
     * @param Visite $visite
     * @param Request $request
     * @return Response
     */
    public function edit(Visite $visite, Request $request) : Response{
        $formVisite = $this->createForm(VisiteType::class, $visite);

        $formVisite->handleRequest($request);
        if($formVisite->isSubmitted() && $formVisite->isValid()){
            $this->repository->add($visite, true);
            return $this->redirectToRoute('admin.voyages');
        }
        return $this->render("admin/admin.voyage.edit.html.twig", ['visite' => $visite, 'formVisite' => $formVisite->createView()]);
    }
    /**
     * @Route("admin/ajout", name="admin.voyage.ajout")
     * @param Request $request
     * @return Response
     */
    public function ajout(Request $request) : Response{
        $visite = new Visite();
        $formVisite = $this->createForm(VisiteType::class, $visite);

        $formVisite->handleRequest($request);
        if($formVisite->isSubmitted() && $formVisite->isValid()){
            $this->repository->add($visite, true);
            return $this->redirectToRoute('admin.voyages');
        }
        return $this->render("admin/admin.voyage.ajout.html.twig", ['visite' => $visite, 'formVisite' => $formVisite->createView()]);
    }
}
?>