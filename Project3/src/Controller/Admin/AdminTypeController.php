<?php

namespace App\Controller\Admin;


use App\Entity\Type;
use App\Form\TypesType;
use App\Repository\TypeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminTypeController extends AbstractController
{
    /**
     * @Route("/admin/type", name="admin_types")
     */
    public function index(TypeRepository $repository)
    {
        $types = $repository->findAll();
        return $this->render('admin/admin_type/admin_type.html.twig', [
            'types' => $types
        ]);
    }

    /**
     * @Route("/admin/types/creation", name="admin_type_creation")
     * @Route("/admin/types/{id}", name="admin_type_modification", methods="POST")
     */
    public function ajoutEtModif(Type $type = null, Request $request,  ManagerRegistry $managerRegistry)
    {
        if(!$type) {
            $type = new Type();
        }

        $form = $this->createForm(TypesType::class,$type);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $modif = $type->getId() !== null;
            $em = $managerRegistry->getManager();
            $em->persist($type);
            $em->flush();
            $this->addFlash("success", ($modif)? "La modification a été effectuée" : "L'ajout a été effectué");
            return $this->redirectToRoute("admin_types");
        }

        return $this->render('admin/admin_type/modifAjoutType.html.twig',[
            "type" => $type,
            "form" => $form->createView(),
            "isModification" => $type->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/types/{id}", name="admin_type_suppression", methods="delete")
     */
    public function suppression(Type $type, Request $request,  ManagerRegistry $managerRegistry){
        if($this->isCsrfTokenValid("SUP".$aliment->getId(),$request->get('_token'))){

            $em = $managerRegistry->getManager();
            $em->remove($aliment);
            $em->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("admin_types");


        }

    }

}
