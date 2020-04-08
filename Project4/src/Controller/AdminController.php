<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Entity\Voiture;
use App\Form\RechercheVoitureType;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(VoitureRepository $repo,PaginatorInterface $paginatorInterface, Request $request)
    {
        $rechercheVoiture = new RechercheVoiture();

        $form = $this->createForm(RechercheVoitureType::class,$rechercheVoiture);
        $form->handleRequest($request);

        $voitures = $paginatorInterface->paginate(
            $repo->findAllWithPagination($rechercheVoiture),
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        return $this->render('voiture/afficherVoitures.html.twig',[
            "voitures" => $voitures,
            "form" => $form->createView(),"admin"=>true
        ]);
    }
    /**
     * @Route("/admin/{id}", name="modifVoiture")
     */
    public function modification(Voiture $voiture){
        $form = $this->createForm(VoitureType::class,$voiture);

        return $this->render('admin/modification.html.twig',["voiture"=>$voiture,"form"=>$form->createView()]);

    }

}
