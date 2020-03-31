<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/admin/aliment", name="admin_aliment")
     */
    public function index(AlimentRepository $respository)
    {
        $aliments = $respository->findAll();
        return $this->render('admin/admin_aliment/adminAliment.html.twig',[
            "aliments" => $aliments
        ]);
    }

    /**
     * @Route("/admin/aliment/creation", name="admin_aliment_creation")
     * @Route("/admin/aliment/{id}", name="admin_aliment_modification", methods="POST")
     */
    public function ajoutEtModif(Aliment $aliment = null, Request $request,  ManagerRegistry $managerRegistry)
    {
        if(!$aliment) {
            $aliment = new Aliment();
        }

        $form = $this->createForm(AlimentType::class,$aliment);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $modif = $aliment->getId() !== null;
            $em = $managerRegistry->getManager();
            $em->persist($aliment);
            $em->flush();
            $this->addFlash("success", ($modif)? "La modification a été effectuée" : "L'ajout a été effectué");
            return $this->redirectToRoute("admin_aliment");
        }

        return $this->render('admin/admin_aliment/modifEtAjout.html.twig',[
            "aliment" => $aliment,
            "form" => $form->createView(),
            "isModification" => $aliment->getId() !== null
        ]);
    }

     /**
     * @Route("/admin/aliment/{id}", name="admin_aliment_suppression", methods="delete")
     */
    public function suppression(Aliment $aliment, Request $request,ManagerRegistry $managerRegistry){
        if($this->isCsrfTokenValid("SUP".$aliment->getId(),$request->get('_token'))){

            $em = $managerRegistry->getManager();
            $em->remove($aliment);
            $em->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("admin_aliments");


        }

    }
}
