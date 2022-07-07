<?php

namespace App\Controller;

use App\Entity\Privilege;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrivilegeController extends AbstractController
{
    /**
     * @Route("/api/privileges/togle/{id}", name="togle_privilege")
     */
    public function index(Privilege $privilege, EntityManagerInterface $em): Response
    {
        if($privilege) {
            $privilege->setActif(!$privilege->getActif());
            $em->persist($privilege);
            $em->flush();
            return $this->json($privilege,200, [], ["groups"=>"lecture"]);
        }
        return $this->json("Echec de l'operation, privilege inexistant",400, [], ["groups"=>"lecture"]);

    }
    /**
     * @Route("/api/utilisateurs/togle/{id}", name="togle_utilisateurs")
     */
    public function togleUtilisateur(Utilisateur $utilisateur, EntityManagerInterface $manager): Response
    {
        if($utilisateur) {
        $utilisateur->setActif(!$utilisateur->getActif());
        $manager->persist($utilisateur);
        $manager->flush();
            return $this->json($utilisateur,200, [], ["groups"=>"lecture"]);
        }
        return $this->json("Echec de l'operation, utilisateur inexistant",400, [], ["groups"=>"lecture"]);
    }

}
