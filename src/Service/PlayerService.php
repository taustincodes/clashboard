<?php

namespace App\Service;

use App\Service\ClashAPIService;

class PlayerService
{
    protected ClashAPIService $clashAPIService;
    protected CardService $cardService;

    public function __construct(ClashAPIService $clashAPIService, CardService $cardService)
    {
        $this->clashAPIService = $clashAPIService;
        $this->cardService = $cardService;
    }

    public function getPlayer(string $playerTag): ?array
    {
        $endpoint = "/players/$playerTag";
        $player = $this->clashAPIService->getClashRoyaleData($endpoint);
        if (array_key_exists('reason', $player)) {
            $player = null;
        }
        return $player;
    }

    public function getPlayerProgress($player): array
    {
        $cards = $player['cards'];
        $totalCards = 106;
        $percent = 1/$totalCards*100;
        $maxLevel = 14;
        $accountProgress = [];

        foreach ($cards as $card) {
            $level = $maxLevel - ($card['maxLevel'] - $card['level']);

            if (!isset($accountProgress[$level])) {
                $accountProgress[$level] = $percent;
            } else {
                $accountProgress[$level] += $percent;
            }
        }
        krsort($accountProgress);

        return $accountProgress;
    }

    public function getUpcomingChests(string $playerTag): array
    {
        $endpoint = "/players/$playerTag/upcomingchests";
        $chests = $this->clashAPIService->getClashRoyaleData($endpoint);

        return $chests;

    }

    public function getBattleLog(string $playerTag): array
    {
        $endpoint = "/players/$playerTag/battlelog";
        $battleLog = $this->clashAPIService->getClashRoyaleData($endpoint);

        return $battleLog;
    }

    public function getMostLostCards(string $playerTag): array
    {
        $battles = $this->getBattleLog($playerTag);
        $cardLog = [];
        foreach ($battles as $battle) {
            $cards = $battle['opponent']['0']['cards'];
            foreach ($cards as $card) {
                $cardName = $card['name'];
                if (!array_key_exists($cardName, $cardLog)) {
                    $cardLog[$cardName] = 1;
                } else {
                    $cardLog[$cardName]++;
                }
            }
        }
        arsort($cardLog);
        $cardLog = array_slice($cardLog, 0, 3);
        $top3 = [];
        foreach ($cardLog as $name => $value) {
            $entry = [
                'name' => $name,
                'value' => $value,
                'details' => $this->cardService->getCardByName($name)
            ];
            array_push($top3, $entry);
        }
        return $top3;
    }

    public function generateCrownLog($battleLog): string
    {
        $crownLog = [
            "1" => 0,
            "2" => 0,
            "3" => 0
        ];
        foreach ($battleLog as $battle) {
            if ($battle['type'] == 'PvP') {
                if ($battle['team'][0]['crowns'] > $battle['opponent'][0]['crowns']) {
                    $crownLog[$battle['team'][0]['crowns']]++;
                }
            }
        }
        $crownLog = implode(', ', array_values($crownLog));
        return $crownLog;
    }

    public function generateTrophyProgressionGraph($battleLog): array
    {
        $trophyLog = [];
        foreach ($battleLog as $battle) {
            if ($battle['type'] == 'PvP') {
                array_push($trophyLog, ($battle['team'][0]['startingTrophies'] + $battle['team'][0]['trophyChange']));
            }
        }
        $graph = [];
        $graph['y'] = implode(', ', array_values($trophyLog));
        $graph['x'] = implode(', ', array_keys($trophyLog));
        return $graph;
    }
}