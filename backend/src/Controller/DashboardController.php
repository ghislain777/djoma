<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use App\Repository\HabilitationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/api/dashboard", name="dashboard")
     */
    public function index(Request $request, EntityManagerInterface $em, UtilisateurRepository $utilisateurRepository): Response
    {
        if ($content = $request->getContent()) {
            $requestParams = \json_decode($content, true);
            $request->request->replace(\is_array($requestParams) ? $requestParams : array());
        }
        $startDate = $request->query->get("startdate");
        $endDate = $request->query->get('enddate');
        return $this->json([],200);
//         $totalArchivesPerDate = [
//             ["date", "Créations d'archives"],
//         ];

//         $utilisateur = $utilisateurRepository->find($request->query->get("id"));
//         $entiteUtilisateur = $utilisateur->getEntite();
//         $habilitationsUtilisateur = $habilitationRepository->findBy([
//             'entite'=>$entiteUtilisateur,
//             'actif' => true
//         ]);
        
        
//         $total = $archiverepository->TotalArchivesParType($utilisateur, $habilitationRepository);
//         $totalArchivesPerType = [];
//         $listeTypesHabilites = [];
//         foreach ($habilitationsUtilisateur as $habilitation) {
//             array_push($listeTypesHabilites,$habilitation->getTypedarchive()->getid());
//         }



// foreach ($total as $archive) {

// if(\in_array($archive["idtype"], $listeTypesHabilites ))
//     array_push($totalArchivesPerType, $archive);
// }


//         if ($startDate && $endDate) {
//             // $sql = "CALL total_sms_per_date('$startDate', '$endDate')";

//             $sql = "(SELECT datedujour as ladate,
//             0 as nombre
//             FROM calendar  where  datedujour not in (select DATE(datedarchive) from archive) and date(datedujour) <= '$endDate'  and date(datedujour) >= '$startDate' )
//             union
//             (SELECT DATE(datedarchive) as ladate, count(id) as nombre  from  archive where date(datedarchive) <= '$endDate'  and date(datedarchive) >= '$startDate' group by DATE(datedarchive))
//             order by ladate asc";
//             $conn = $em->getConnection();
//             $stmt = $conn->prepare($sql);
//             $stmt->execute();
//             $total = $stmt->fetchAll();

//             foreach ($total as $count) {
//                 array_push($totalArchivesPerDate, [date_format(date_create($count['ladate']), "d/m/y"), $count['nombre']]);
//             }
//         }

  //      return $this->json(['totalArchivesPerType' => $totalArchivesPerType, 'totalArchivesPerDate'=> $totalArchivesPerDate], 200, [], ["groups" => "lecture"]);

    }
}
