<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Entity\Voiture;
use App\Form\RechercheVoitureType;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
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
     * @Route("/admin/creation",name="creationVoiture")
     * @Route("/admin/{id}", name="modifVoiture",methods="GET")
     */
    public function modification(Voiture $voiture=null,Request $request, ManagerRegistry $managerRegistry ){

        if(!$voiture)
        {
            $voiture=new Voiture();
        }


        $form = $this->createForm(VoitureType::class,$voiture);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $modif=$voiture->getId()!==null;
            $em = $managerRegistry->getManager();
            $em->persist($voiture);
            $em->flush();
            $this->addFlash("success",($modif)?"La modification a été effectuée":"L'ajout a été effectué");
            return $this->redirectToRoute("admin");

        }

        return $this->render('admin/modification.html.twig',
            ["voiture"=>$voiture,"form"=>$form->createView()]);
//        "isModification" => $type->getId() !== null
    }
    /**
     * @Route("/admin/{id}", name="supVoiture",methods="SUP")
     */
    public function suppression(Voiture $voiture,Request $request,ManagerRegistry $managerRegistry){
        if($this->isCsrfTokenValid("SUP".$voiture->getId(),$request->get("_token"))){
            $om =$managerRegistry->getManager();
            $om->remove($voiture);
            $om->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("admin");
        }

    }


}
