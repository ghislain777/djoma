<?php declare (strict_types = 1);
namespace App\Service;


use App\Entity\Parametre;
use App\Repository\ParametreRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class ConfigurationService
{

    private $parametre;
    private  $em;
    private  $parametreRepository;

    public function __construct(EntityManagerInterface $em, ParametreRepository $parametreRepository)
    {
        $this->em = $em;
        $this->parametreRepository = $parametreRepository;
        $this->parametre = new Parametre();
    }

    public function setParametre(String $nom, String $valeur)
    {
        
        $this->parametre = $this->parametreRepository->findOneBy([
            'nom'=> $nom
        ]);
        $this->parametre->setValeur($valeur);
        $this->em->persist($this->parametre);
        $this->em->flush();
    }
public function getParametre(String $nom) {

    $this->parametre = $this->parametreRepository->findOneBy([
        'nom'=> $nom
    ]);
    return $this->parametre->getValeur();
}

}