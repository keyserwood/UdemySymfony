<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminSecuController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, ManagerRegistry $managerRegistry,UserPasswordEncoderInterface $encoder)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class,$utilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $passwordCrypte = $encoder->encodePassword($utilisateur,$utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
            $em = $managerRegistry->getManager();
            $em->persist($utilisateur);
            $em->flush();
//            $this->addFlash("success", "L'inscription a été effectuée");
            return $this->redirectToRoute("aliments");
        }

        return $this->render('admin_secu/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route ("/login",name="connexion")
     */
    public function login(){
        return $this->render("admin_secu/login.html.twig");
    }
}

