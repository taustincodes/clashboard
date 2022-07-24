<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\CardService;
use App\Service\PlayerService;
use Symfony\Component\HttpFoundation\Request;

class PlayerController extends AbstractController
{
    protected CardService $cardService;
    protected PlayerService $playerService;

    public function __construct(CardService $cardService, PlayerService $playerService)
    {
        $this->cardService = $cardService;
        $this->playerService = $playerService;
    }

    /**
     * @Route("/player", name="player", methods="GET")
     */
    public function index(Request $request)
    {
        $id = $request->query->get("playerId");
        $playerId = "%23" . $id;
        $player = $this->playerService->getPlayer($playerId);
        if (!$player) {
            throw $this->createNotFoundException('Player not found.');
        }

        $accountProgress = $this->playerService->getPlayerProgress($player);
        $battleLog = $this->playerService->getBattleLog($playerId);
        $trophyProgressionGraph = $this->playerService->generateTrophyProgressionGraph($battleLog);
        $crownLog = $this->playerService->generateCrownLog($battleLog);
        $mostLostCards = $this->playerService->getMostLostCards($playerId);
        
        return $this->render('player2.html.twig', [
            "page" => "Player profile",
            'player' => $player,
            'mostLostCards' => $mostLostCards,
            'accountProgress' => $accountProgress,
            'graph' => $trophyProgressionGraph,
            'crownLog' => $crownLog
        ]);
    }
}