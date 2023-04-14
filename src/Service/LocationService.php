<?php

namespace App\Service;

use App\Service\ClashAPIService;
use App\Service\ClanService;

class LocationService
{
    private ClashAPIService $clashAPIService;
    private ClanService $clanService;
    public function __construct(ClashAPIService $clashAPIService, ClanService $clanService)
    {
        $this->clashAPIService = $clashAPIService;
        $this->clanService = $clanService;
    }

    public function getLocations() 
    {
        $endpoint = "/locations";
        $locations = $this->clashAPIService->getClashRoyaleData($endpoint);

        return $locations;
    }

    public function getLocationClanRankings(string $locationId) 
    {
        $endpoint = "/locations/$locationId/rankings/clans";
        $clans = $this->clashAPIService->getClashRoyaleData($endpoint);

        return $clans;
    }

    public function getLocationTopClanMembers(string $locationId) {
        $clans = $this->getLocationClanRankings($locationId);
        $topClanTag = $clans['items'][0]['tag'];

        return $this->clanService->getClanMembers($topClanTag, 10);
    }
}
