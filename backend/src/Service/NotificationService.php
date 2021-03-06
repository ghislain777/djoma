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
                "body" => "Votre commande enregistr??e, recherche de taxi ?? proximit?? en cours..."
            ];
        case 'Annul??e':
            return [
                "title" => "Commande annul??e",
                "body" => "Votre commande a ??t?? annul??e"
            ];
        case 'Clotur??e':
            return [
                "title" => "Commande clotur??e",
                "body" => "la commande #: " . $commande->getId() . " est clotur??e"
            ];
            break;
        case 'Voyage en cours':
            return [
                "title" => "Commande en cours d'ex??cution",
                "body" => "Commande #: " . $commande->getId() . " est en cours d'ex??cution (voyage en cours)"
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
                "title" => "Chauffeur arriv??",
                "body" => "Commande #: " . $commande->getId() . " Le chauffeur est arriv?? au point de ramassage"
            ];
            break;


        default:
            return [
                "title" => "",
                "body" => ""  //"Commande #: " . $commande->getId() . " Vous ??tes au point de ramassage du client."
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
                "body" => "Une nouvelle commande course pour vous. Merci de prendre en charge d??s que possible"
            ];
        case 'Clotur??e':
            return [
                "title" => "Commande clotur??e",
                "body" => "la commande #: " . $commande->getId() . " est clotur??e"
            ];
            break;
        case 'Voyage en cours':
            return [
                "title" => "Commande en cours d'ex??cution",
                "body" => "Commande #: " . $commande->getId() . " est en cours d'ex??cution (voyage en cours)"
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
                "title" => "Vous ??tes arriv?? au point de ramassage",
                "body" => "Commande #: " . $commande->getId() . " Vous ??tes au point de ramassage du client."
            ];
            break;


        default:
            return [
                "title" => "",
                "body" => ""  //"Commande #: " . $commande->getId() . " Vous ??tes au point de ramassage du client."
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
                "body" => "Votre demande est enregistr??e, elle est en cours de traitement, vous serez contact?? au plus t??t."
            ];
            break;
        case 'Annul??e':
            return [
                "title" => "Demande annul??e",
                "body" => "Votre demande de location #: " . $demande->getId() . " a ??t?? annul??e"
            ];
            break;
        case 'Clotur??e':
            return [
                "title" => "Demande de location clotur??e",
                "body" => "la demande #: " . $demande->getId() . " est clotur??e"
            ];
            break;
        case 'Pay??e':
            return [
                "title" => "Demande pay??e avec succ??s",
                "body" => "Demande #: " . $demande->getId() . " a ??t?? pay??e avec succ??s"
            ];
            break;
        case 'Confirm??e':
            return [
                "title" => "Demande de loation confirm??e",
                "body" => "Demande #: " . $demande->getId() . " est confirm??e"
            ];
            break;

        case "En cours d'ex??cution":
            return [
                "title" => "Demande en cours d'ex??cution",
                "body" => "Demande #: " . $demande->getId() . " est en cours d'ex??ction"
            ];
            break;


        default:
            return [
                "title" => "",
                "body" => ""  //"Commande #: " . $commande->getId() . " Vous ??tes au point de ramassage du client."
            ];
            break;
    }
}


}