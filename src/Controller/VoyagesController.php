<?php
namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VoyagesController extends AbstractController{
    
    private $repository;

    public function __construct(VisiteRepository $repository){
        $this->repository = $repository;
    }

    /**
     * @Route("/voyages", name="voyages")
     * @return Response
     */
    public function index() : Response{
        $visites = $this->repository->findAll();
        return $this->render('pages/voyages.html.twig', [
            'visites' => $visites
        ]);
    }
}
?>