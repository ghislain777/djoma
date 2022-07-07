<?php

namespace App\DataFixtures;

use App\Entity\Activite;
use App\Entity\Menu;
use App\Entity\Privilege;
use App\Entity\Role;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $administrateur = new Role();
        $administrateur->setNom("Administrateur")->setDescription("Administrateur de la plateforme");
        $manager->persist($administrateur);

        $admin = new Utilisateur();
        $admin->setActif(true)->setCivilite("M.")->setDatecreation(new \DateTime())->setNom('Admin')->setPrenom("Administrateur")->setMotdepasse("123")->setEmail('admin@zentechnologies.net')->setLogin('admin')->setRole($administrateur);
        $manager->persist($admin);

        $administration = new Menu();
        $administration->setNom('Administration')->setDescription('Administration')->setIcone("people");
        $manager->persist($administration);
        $manager->flush();



        $parametres = new Menu();
        $parametres->setNom('Paramètres')->setDescription('Paramètres')->setIcone("settings");
        $manager->persist($parametres);
        $manager->flush();

        // les activités

        $activites = new Activite();
        $activites->setNom('Activités')->setDescription('Activités des utilisateurs')->setChemain("/administration/activites");
        $activites->setMenu($administration);
        $manager->persist($activites);
        $manager->flush();

        $utilisateurs = new Activite();
        $utilisateurs->setNom('Utilisateurs')->setDescription('Utilisateurs')->setChemain("/administration/utilisateurs")->setMenu($administration);
        $manager->persist($utilisateurs);
        $manager->flush();

        $roles = new Activite();
        $roles->setNom('Roles')->setDescription('Rôles')->setChemain("/administration/roles")->setMenu($administration);
        $manager->persist($roles);
        $manager->flush();


        $amenu = new Activite();
        $amenu->setNom('Menu')->setDescription('Menus')->setChemain("/administration/menus")->setMenu($administration);
        $manager->persist($amenu);
        $manager->flush();

       
        // Tabe des privileges. (enregistrer manuellement la table des privilèges)

        $pactivite = new Privilege();
        $pactivite->setActivite($activites)
        ->setRole($administrateur)
        ->setDescription("")
        ->setActif(true)
        ;
        $putilisateur = new Privilege();
        $putilisateur->setActivite($utilisateurs)
        ->setRole($administrateur)
        ->setDescription("")
        ->setActif(true)
        ;

        $prole = new Privilege();
        $prole->setActivite($roles)
        ->setRole($administrateur)
        ->setDescription("")
        ->setActif(true)
        ;

        $pmenu = new Privilege();
        $pmenu->setActivite($amenu)
        ->setRole($administrateur)
        ->setDescription("")
        ->setActif(true)
        ;

        $manager->persist($pactivite);
        $manager->persist($putilisateur);
        $manager->persist($prole);
        $manager->persist($pmenu);
        $manager->flush();
    }
}