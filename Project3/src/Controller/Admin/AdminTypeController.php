<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminTypeController extends AbstractController
{
    /**
     * @Route("/admin/admin/type", name="admin_admin_type")
     */
    public function index()
    {
        return $this->render('admin/admin_type/index.html.twig', [
            'controller_name' => 'AdminTypeController',
        ]);
    }
}
