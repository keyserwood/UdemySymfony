<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    /**
     * @Route("/aliment", name="aliment")
     */
    public function index()
    {
        return $this->render('aliment/index.html.twig', [
            'controller_name' => 'AlimentController',
        ]);
    }
}
