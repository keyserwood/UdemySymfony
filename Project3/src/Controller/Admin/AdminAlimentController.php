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
     * @Route("/admin/aliment/{id}", name="admin_aliment_modification")
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
            $em = $managerRegistry->getManager();
            $em->persist($aliment);
            $em->flush();
            return $this->redirectToRoute("admin_aliments");
        }
        return $this->render('admin/admin_aliment/modificationEtAjoutAliment.html.twig', [
            'aliment' => $aliment,
            "form"=>$form->createView(),
            "isModification"=> $aliment->getId() !== null
        ]);
    }
}
