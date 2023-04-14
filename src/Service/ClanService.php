<?php

namespace App\Service;

use App\Service\ClashAPIService;

class ClanService
{
    private ClashAPIService $clashAPIService;
    
    public function __construct(ClashAPIService $clashAPIService)
    {
        $this->clashAPIService = $clashAPIService;
    }

    public function getClanMembers(string $clanTag, int $limit)
    {
        $clanTag = $this->convertTag($clanTag);
        $endpoint = "/clans/$clanTag/members?limit=$limit";
        $clanMembers = $this->clashAPIService->getClashRoyaleData($endpoint);

        return $clanMembers['items'];
    }

    public function getRandomClans()
    {
        $endpoint = "/clans?minMembers=50&limit=1&minScore=75000";
        $clan = $this->clashAPIService->getClashRoyaleData($endpoint);
        
        return $clan;
    }

    public function getTopClanMembers()
    {
        $clans = $this->getRandomClans();
        $topClanTag = $clans['items'][0]['tag'];

        return $this->getClanMembers($topClanTag, 25);
    }

    private function convertTag(string $tag): string
    {
        if ($tag[0] === '#') {
            $tag = ltrim($tag, $tag[0]);
            $tag = "%23" . $tag;
        }
        
        return $tag;
    }
}
