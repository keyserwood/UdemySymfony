<?php

namespace App\Controller;

use App\Entity\Armes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArmesController extends AbstractController
{
    /**
     * @Route("/armes", name="armes")
     */
    public function armes() // Function index qui est lancé quand on appelle la route
    {
        // Transmettre un pseudos
        Armes::creerArmes();
        return $this->render('armes/armes.html.twig', [
            "weapons"=> Armes::$armes
        ]); //renvoie l'affichage d'un fichier twig
    }
    /**
     * @Route("/armes/{nom}", name="afficher_armes")
     */
    public function afficher_armes($nom) // Function index qui est lancé quand on appelle la route
    {
        Armes::creerArmes();
        $arme =Armes::getArmesParNom($nom);
        return $this->render('armes/arme.html.twig', [
            "arme"=> $arme
        ]); //renvoie l'affichage d'un fichier twig
    }
}
