<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/admin/aliments", name="admin_aliments")
     */
    public function index(AlimentRepository $repository)
    {
        $aliments=$repository->findAll();
        return $this->render('admin/admin_aliment/admin.html.twig', [
            'aliments' => $aliments
        ]);
    }
    /**
     * @Route("/admin/aliment/creation", name="admin_aliment_creation")
     * @Route("/admin/aliment/{id}", name="admin_aliment_modification",methods="POST")
     */
    public function ajoutetModif(Aliment $aliment=null, Request $request, ManagerRegistry $managerRegistry)
    {
        if (!$aliment)
        {
            $aliment= new Aliment();
        }
        $form = $this->createForm(AlimentType::class,$aliment);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $modif = $aliment->getId() !== null;
            $em = $managerRegistry->getManager();
            $em->persist($aliment);
            $em->flush();
            $this->addFlash("success", ($modif)? "La modification a été effectuée" : "L'ajout a été effectué");
            return $this->redirectToRoute("admin_aliments");
        }
        return $this->render('admin/admin_aliment/modificationEtAjoutAliment.html.twig', [
            'aliment' => $aliment,
            "form"=>$form->createView(),
            "isModification"=> $aliment->getId() !== null
        ]);
    }
    /**
     * @Route("/admin/aliment/{id}", name="admin_aliment_suppression",methods="delete")
     */
    public function supression(Aliment $aliment=null, Request $request, ManagerRegistry $managerRegistry)


    {
        if($this->isCsrfTokenValid("SUP".$aliment->getId(),$request->get('_token'))){
            $em = $managerRegistry->getManager();
            $em->remove($aliment);
            $em->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("admin_aliments");


        }

    }

}
