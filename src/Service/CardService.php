<?php

namespace App\Service;

use App\Service\ClashAPIService;

class CardService
{
    protected ClashAPIService $clashAPIService;

    public function __construct(ClashAPIService $clashAPIService)
    {
        $this->clashAPIService = $clashAPIService;
    }

    public function getCards(): array
    {
        $endpoint = "/cards";
        $cards = $this->clashAPIService->getClashRoyaleData($endpoint);

        return $cards;
    }

    public function getCardByName($name): array
    {
        $cards = $this->getCards();
        $cards = $cards['items'];
        foreach ($cards as $card) {
            if ($card['name'] == $name) {
                $selectedCard = $card;
            }
        }
        return $selectedCard ?? null;
    }
}
