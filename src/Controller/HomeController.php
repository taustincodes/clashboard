<?php

namespace App\Controller;

use App\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\LocationService;

class HomeController extends AbstractController
{
    protected LocationService $clanService;

    public function __construct(LocationService $locationService) {
        $this->locationService = $locationService;
    }
    /**
     * @Route("/")
     */
    public function index()
    {
        $locations = $this->locationService->getLocations();
        $topPlayers = $this->locationService->getLocationTopClanMembers($locations['items'][0]['id']);
        return $this->render('home2.html.twig', [
            "page" => "Home",
            "topPlayers" => $topPlayers
        ]); 
    }
}
    