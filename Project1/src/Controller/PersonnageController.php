<?php

namespace App\Controller; // Le fichier est bien présent dans Controller

use App\Entity\Personnage;// importer la classe personnage
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Les packages qui sont utilisés
use Symfony\Component\Routing\Annotation\Route;

class PersonnageController extends AbstractController // Personnage controller est dans la classe AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index() // Function index qui est lancé quand on appelle la route
    {
        return $this->render('personnage/index.html.twig', [
            'controller_name' => 'PersonnageController',
        ]); //renvoie l'affichage d'un fichier twig
    }
    // Distinction Routage Controller vue
    /**
     * @Route("/personnages", name="personnages")
     */
    public function persos() // Function index qui est lancé quand on appelle la route
    {
        // Transmettre un pseudos
        Personnage::creerPersonnages();
        return $this->render('personnage/persos.html.twig', [
            "players"=> Personnage::$personnages
        ]); //renvoie l'affichage d'un fichier twig
    }
    /**
     * @Route("/personnages/{nom}", name="afficher_personnage")
     */
    public function afficher_personnage($nom) // Function index qui est lancé quand on appelle la route
    {
        Personnage::creerPersonnages();
        $perso =Personnage::getPersonnageParNom($nom);
        return $this->render('personnage/perso.html.twig', [
            "perso"=> $perso
        ]); //renvoie l'affichage d'un fichier twig
    }
}
