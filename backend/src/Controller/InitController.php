<?php

namespace App\Controller;

use App\Repository\ConfigurationRepository;
use App\Repository\ParametreRepository;
use App\Repository\ReplayaudioRepository;
use App\Repository\ReplayRepository;
use App\Service\ConfigurationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InitController extends AbstractController
{
    /**
     * @Route("/api/initmobile", name="initmobileApp")
     */
    public function index(ReplayRepository $replayRepository, ReplayaudioRepository $replayaudioRepository,  ParametreRepository $parametreRepository): Response
    {
       // $configurationService = new ConfigurationService($em, $parametreRepository);
        $retour = [];
        $retour["replay"] = $replayRepository->findBy([],["id"=>"desc"],30);
        $retour["replayaudio"] = $replayaudioRepository->findBy([],["id"=>"desc"],30);
        $retour["urltv"] =$parametreRepository->findOneBy(["nom" => "URL_LIVE_TV"])->getValeur();
        $retour["urlradio"] =$parametreRepository->findOneBy(["nom" => "URL_LIVE_RADIO"])->getValeur();
        return $this->json($retour, 200, [], ["groups" => "lecture"]);
    }
}
