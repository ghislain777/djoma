<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\MenuRepository;
use App\Repository\PrivilegeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/api/utilisateur/passwordreset/{id}", name="passwordreset")
     */
    public function index(Utilisateur $utilisateur, EntityManagerInterface $em): Response
    {
        if ($utilisateur) {
            $utilisateur->setMotdepasse($utilisateur->getNom() . $this->chaine_unique(3));
            $em->persist($utilisateur);
            $em->flush();
            return $this->json($utilisateur, 200, [], ["Group" => "lecture"]);
        }
        return $this->json("Echec de l'operation", 400);
    }

    /**
     * @Route("/api/utilisateur/passwordchange/{id}", name="passwordchange")
     */
    public function changementMotdepasse(Utilisateur $utilisateur, EntityManagerInterface $em, Request $request): Response
    {
        if ($content = $request->getContent()) {
            $requestParams = \json_decode($content, true);
            $request->request->replace(\is_array($requestParams) ? $requestParams : array());
        }
        if ($utilisateur) {
            $utilisateur->setMotdepasse($request->request->get('motdepasse'));
            $em->persist($utilisateur);
            $em->flush();
            return $this->json($utilisateur, 200, [], ["Group" => "lecture"]);
        }
        return $this->json("Echec de l'operation", 400);
    }

    /**
     * @Route("/api/utilisateurs/login", name="loginUtilisateur")
     */
    public function loginUtilisateur(Request $request, UtilisateurRepository $utilisateurRepository, PrivilegeRepository $privilegeRepository, MenuRepository $menuRepository): Response
    {
        if ($content = $request->getContent()) {
            $requestParams = \json_decode($content, true);
            $request->request->replace(\is_array($requestParams) ? $requestParams : array());
        }
        $email = $request->request->get("email");
        $pass = $request->request->get('motdepasse');

        $utilisateur = $utilisateurRepository->findOneBy([
            "email" => $email,
            "motdepasse" => $pass,
        ]);
        $listePrivileges = [];

        if ($utilisateur) { // Si on a trouvé l'utilisateur, on recupere toutes ses privileges
            $listePrivileges = $privilegeRepository->findBy([
                "role" => $utilisateur->getRole(),
                "actif" => true,
            ]);

            $navigation = array();
            $listeMenus = $menuRepository->findAll();
            foreach ($listeMenus as $menu) {

                $lemenu = array();
                $lemenu["id"] = $menu->getId();
                $lemenu["name"] = $menu->getNom();
                $lemenu["description"] = $menu->getDescription();
                $lemenu["icon"] = $menu->getIcone();
                $lemenu["children"] = [];

                $listeActivitesDuMenu = array();
                foreach ($listePrivileges as $privilege) {
                    if ($privilege->getActivite()->getMenu()->getId() == $lemenu["id"]) {
                        array_push($lemenu["children"], [
                            "id" => $privilege->getActivite()->getId(),
                            "name" => $privilege->getActivite()->getNom(),
                            "description" => $privilege->getActivite()->getDescription(),
                            "path" => $privilege->getActivite()->getChemain(),
                            "icon" => $privilege->getActivite()->getIcone(),
                        ]);
                    }
                }
                array_push($navigation, $lemenu);
            }

           

            return $this->json(["utilisateur" => $utilisateur, "privileges" => $listePrivileges, "navigation" => $navigation], 200, [], ["groups" => "lecture"]);

        } else {

            return $this->json("Adresse Email ou mot de passe incorrect.", 202, [], []);
        }

    }

    /**
     * @Route("/api/utilisateurs/passwordchange", name="passwordChange")
     */
    public function changementMotdepasseAction(Request $request, UtilisateurRepository $utilisateurRepository, EntityManagerInterface $em)
    {
        if ($content = $request->getContent()) {
            $requestParams = \json_decode($content, true);
            $request->request->replace(\is_array($requestParams) ? $requestParams : array());
        }
        $email = $request->request->get("email_utilisateur");
        $pass = $request->request->get('mot_de_passe_utilisateur');
        $newpass = $request->request->get('nouveau_mot_de_passe_utilisateur');

        $utilisateur = $utilisateurRepository->findOneBy([
            "email" => $email,
            "motdepasse" => $pass,
        ]);

        if (!$utilisateur) { // utilisateur pas trouvé dans la base

            return $this->json("Mot de passe incorrecte. veuillez re-éssayer", 202);
        }

        $utilisateur->setMotdepasse($newpass);
        $em->merge($utilisateur);
        $em->flush();
        return $this->json("Mot de passe changé avec succès", 200);
    }



/**
     * @Route("/api/utilisateurs/statut/togle/{id}", name="togle_statut_utilisateur")
     */
    public function togle_statut(Utilisateur $utilisateur, EntityManagerInterface $em): Response
    {
        if($utilisateur) {
            $utilisateur->setActif(!$utilisateur->getActif());
            $em->persist($utilisateur);
            $em->flush();
            return $this->json($utilisateur,200, [], ["groups"=>"lecture"]);
        }
        return $this->json("Echec de l'operation, utilisateur inexistant",400, [], ["groups"=>"lecture"]);

    }



    public function chaine_unique($car)
    {
        $string = "";
        $chaine = "0123456789abcdefghijklmnopqrstuvwxyz}]@^[{#";
        srand((double) microtime() * 1000000);
        for ($i = 0; $i < $car; $i++) {
            $string .= $chaine[rand() % strlen($chaine)];
        }
        return $string;
    }
}
