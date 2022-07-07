<?php
namespace App\Controller;

use App\Entity\Client;
use App\Entity\Chauffeur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FichierController extends AbstractController
{
    /**
     * @Route("/api/fichier/upload", name="upload_de_fichier")
     */
    public function index(Request $request): Response
    {
        $fichierImage = $request->files->get('file');
        $objet = $request->request->get('objet');
      //  return $this->json($fichierImage, 200);
        if ($fichierImage) {
            $nouveauFichier = \uniqid() . "." . $fichierImage->guessExtension();
            $fichierImage->move(
                $this->getParameter('app.files_directory') . "/{$objet}/",
                $nouveauFichier
            );
            if($objet == "photochauffeur") {

                $idChauffeur = $request->request->get('chauffeur');
        $em = $this->getDoctrine()->getManager();
        $ChauffeurRepository = $em->getRepository('App:Chauffeur');
        $chauffeur = $ChauffeurRepository->find($idChauffeur);
        $chauffeur->setPhoto($nouveauFichier);
        $em->persist($chauffeur);
        $em->flush();

            }
            if($objet == "photoclient") {

        $idClient = $request->request->get('client');
        $em = $this->getDoctrine()->getManager();
        $clientRepository = $em->getRepository('App:Client');
        $client = $clientRepository->find($idClient);
        $client->setPhoto($nouveauFichier);
        $em->persist($client);
        $em->flush();

            }

            return $this->json($nouveauFichier, 200);
            //$nouveauFichier1 = \uniqid() . "." . "mp3";
            // try {

            // switch ($objet) {
            //     case 'utilisateur':
            //         $fichierImage->move(
            //             $this->getParameter('app.files_directory') . "/utilisateurs/",
            //             $nouveauFichier
            //         );

            //         return $this->json($nouveauFichier, 200);
            //         break;

            //     case 'campagne':
            //         $fichierImage->move(
            //             $this->getParameter('app.files_directory') . "/campagnes/",
            //             $nouveauFichier1
            //         );
            //         return $this->json($nouveauFichier1, 200);
            //         break;

            //         case 'contacts':
            //             $fichierImage->move(
            //                 $this->getParameter('app.files_directory') . "/contacts/",
            //                 $nouveauFichier
            //             );
    
            //             break;
            //         case 'photochauffeur':
            //             $fichierImage->move(
            //                 $this->getParameter('app.files_directory') . "/photoschauffeurs/",
            //                 $nouveauFichier
            //             );
    
            //             break;
            //         case 'cnichauffeur':
            //             $fichierImage->move(
            //                 $this->getParameter('app.files_directory') . "/cnischauffeurs/",
            //                 $nouveauFichier
            //             );
    
            //             break;
            //         case 'permischauffeur':
            //             $fichierImage->move(
            //                 $this->getParameter('app.files_directory') . "/permischauffeurs/",
            //                 $nouveauFichier
            //             );
    
            //             break;

            //         case 'vehicule':
            //             $fichierImage->move(
            //                 $this->getParameter('app.files_directory') . "/photosvehicules/",
            //                 $nouveauFichier
            //             );
    
            //             break;
            //             case 'assurance':
            //                 $fichierImage->move(
            //                     $this->getParameter('app.files_directory') . "/photosassurances/",
            //                     $nouveauFichier
            //                 );
        
            //                 break;


            //     default:
                    
            //     $fichierImage->move(
            //         $this->getParameter('app.files_directory') . "/{$objet}/",
            //         $nouveauFichier
            //     );

            //         break;
            // }
       
        }
        else {
            return $this->json('impossible de charger le chichier', 402);
        }
    }

}
