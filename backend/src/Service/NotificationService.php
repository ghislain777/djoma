<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Client;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class NotificationService {

    private $fichier;
    private $parameterBag;

public function __construct(ParameterBagInterface $parameterBag)
{
 $this->parameterBag = $parameterBag;
$this->fichier = $this->parameterBag->get('kernel.project_dir') . '/config/taxxibabi-firebase-adminsdk-bsb1m-5330ae9563.json';
    
}


function envoiNoticationCommandeClient($client, $commande)
{
try {
    
    $messaging = (new Factory())
        ->withServiceAccount($this->fichier)
        ->createMessaging();

    $message = CloudMessage::fromArray([
        'token' => $client->getToken(),
        'notification' => [
            'title' => $this->getMessageCommandeClientFromStatut($commande)['title'],
            'body' => $this->getMessageCommandeClientFromStatut($commande)["body"],
        ],
        "data" => [
            "id" => $commande->getId(),
            "raison" => "misajour",
            "objet" => "commande",
            "statut" => $commande->getStatut(),
        ],
    ]);
    $messaging->send($message);
       
} 
catch (\Throwable $th) {
    //throw $th;
}
}

function envoiNoticationDemandeClient($client, $demande)
{
    try {
       
    $messaging = (new Factory())
    ->withServiceAccount($this->fichier)
    ->createMessaging();

$message = CloudMessage::fromArray([
    'token' => $client->getToken(),
    'notification' => [
        'title' => $this->getMessageDemandeClientFromStatut($demande)['title'],
        'body' => $this->getMessageDemandeClientFromStatut($demande)["body"],
    ],
    "data" => [
        "id" => $demande->getId(),
        "raison" => "misajour",
        "objet" => "demande",
        "statut" => $demande->getStatut(),
    ],
]);
$messaging->send($message); 
        

    } catch (\Throwable $th) {
        throw $th;
    }

}

function envoiNoticationCommandeChauffeur($chauffeur, $commande)
{
try {
   
    $messaging = (new Factory())
        ->withServiceAccount($this->fichier)
        ->createMessaging();

    $message = CloudMessage::fromArray([
        'token' => $chauffeur->getToken(),
        'notification' => [
            'title' => $this->getMessageCommandeChauffeurFromStatut($commande)['title'],
            'body' => $this->getMessageCommandeChauffeurFromStatut($commande)["body"],
        ],
        "data" => [
            "id" => $commande->getId(),
            "raison" => "misajour",
            "objet" => "commande",
            "statut" => $commande->getStatut(),
        ],
    ]);
    $messaging->send($message);
     
} catch (\Throwable $th) {


    //throw $th;
}
}





private function getMessageCommandeClientFromStatut($commande)
{

    switch ($commande->getStatut()) {
        case 'Nouveau':
            return [
                "title" => "Nouvelle commande",
                "body" => "Votre commande enregistrée, recherche de taxi à proximité en cours..."
            ];
        case 'Annulée':
            return [
                "title" => "Commande annulée",
                "body" => "Votre commande a été annulée"
            ];
        case 'Cloturée':
            return [
                "title" => "Commande cloturée",
                "body" => "la commande #: " . $commande->getId() . " est cloturée"
            ];
            break;
        case 'Voyage en cours':
            return [
                "title" => "Commande en cours d'exécution",
                "body" => "Commande #: " . $commande->getId() . " est en cours d'exécution (voyage en cours)"
            ];
            break;
        case 'Pris en charge':
            return [
                "title" => "Commande prise en charge",
                "body" => "Commande #: " . $commande->getId() . " est prise en charge, le chauffeur est en route vers le point de ramassage"
            ];
            break;

        case 'Chauffeur en attente':
            return [
                "title" => "Chauffeur arrivé",
                "body" => "Commande #: " . $commande->getId() . " Le chauffeur est arrivé au point de ramassage"
            ];
            break;


        default:
            return [
                "title" => "",
                "body" => ""  //"Commande #: " . $commande->getId() . " Vous êtes au point de ramassage du client."
            ];
            break;
    }
}


private function getMessageCommandeChauffeurFromStatut($commande)
{

    switch ($commande->getStatut()) {
        case 'Nouveau':
            return [
                "title" => "Nouvelle commande",
                "body" => "Une nouvelle commande course pour vous. Merci de prendre en charge dès que possible"
            ];
        case 'Cloturée':
            return [
                "title" => "Commande cloturée",
                "body" => "la commande #: " . $commande->getId() . " est cloturée"
            ];
            break;
        case 'Voyage en cours':
            return [
                "title" => "Commande en cours d'exécution",
                "body" => "Commande #: " . $commande->getId() . " est en cours d'exécution (voyage en cours)"
            ];
            break;
        case 'Pris en charge':
            return [
                "title" => "Commande prise en charge",
                "body" => "Commande #: " . $commande->getId() . " est prise en charge, le client est en attente au point de ramassage"
            ];
            break;

        case 'Chauffeur en attente':
            return [
                "title" => "Vous êtes arrivé au point de ramassage",
                "body" => "Commande #: " . $commande->getId() . " Vous êtes au point de ramassage du client."
            ];
            break;


        default:
            return [
                "title" => "",
                "body" => ""  //"Commande #: " . $commande->getId() . " Vous êtes au point de ramassage du client."
            ];
            break;
    }
}




private function getMessageDemandeClientFromStatut($demande)
{

    switch ($demande->getStatut()) {
        case 'Nouveau':
            return [
                "title" => "Nouvelle demande",
                "body" => "Votre demande est enregistrée, elle est en cours de traitement, vous serez contacté au plus tôt."
            ];
            break;
        case 'Annulée':
            return [
                "title" => "Demande annulée",
                "body" => "Votre demande de location #: " . $demande->getId() . " a été annulée"
            ];
            break;
        case 'Cloturée':
            return [
                "title" => "Demande de location cloturée",
                "body" => "la demande #: " . $demande->getId() . " est cloturée"
            ];
            break;
        case 'Payée':
            return [
                "title" => "Demande payée avec succès",
                "body" => "Demande #: " . $demande->getId() . " a été payée avec succès"
            ];
            break;
        case 'Confirmée':
            return [
                "title" => "Demande de loation confirmée",
                "body" => "Demande #: " . $demande->getId() . " est confirmée"
            ];
            break;

        case "En cours d'exécution":
            return [
                "title" => "Demande en cours d'exécution",
                "body" => "Demande #: " . $demande->getId() . " est en cours d'exéction"
            ];
            break;


        default:
            return [
                "title" => "",
                "body" => ""  //"Commande #: " . $commande->getId() . " Vous êtes au point de ramassage du client."
            ];
            break;
    }
}


}