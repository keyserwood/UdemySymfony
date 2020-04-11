<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use App\Repository\VoitureRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GlobalController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('global/index.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request,ManagerRegistry $managerRegistry)
    {
        $utilisateur =new Utilisateur();
        $form = $this->createForm(InscriptionType::class,$utilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $em = $managerRegistry->getManager();
            $utilisateur->setRoles("ROLE_USER");
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute("accueil");

        }
        return $this->render('global/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
