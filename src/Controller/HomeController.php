<?php

namespace App\Controller;

use App\Entity\Player;
use App\Service\ClanService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\LocationService;
use App\Service\PlayerService;

class HomeController extends AbstractController
{
    private LocationService $locationService;
    private ClanService $clanService;
    private PlayerService $playerService;

    public function __construct(
        LocationService $locationService,
        ClanService $clanService,
        PlayerService $playerService
        ) {
        $this->locationService = $locationService;
        $this->clanService = $clanService;
        $this->playerService = $playerService;
    }
    /**
     * @Route("/")
     */
    public function index()
    {
        $topPlayers = $this->clanService->getTopClanMembers();
  
        return $this->render('home2.html.twig', [
            "page" => "Home",
            "topPlayers" => $topPlayers
        ]); 
    }
}
    