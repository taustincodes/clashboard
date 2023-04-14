<?php

namespace App\Service;

class ClashAPIService
{
    private string $token;

    public function __construct(string $token) 
    {
        $this->token = $token;
    }

    public function getClashRoyaleData(string $endpoint): ?array
    {    
        $baseUrl = "https://api.clashroyale.com/v1";
        $header = array();
        $header[] = "Accept: application/json";
        $header[] = "Authorization: Bearer ". $this->token;
        $url = $baseUrl . $endpoint;
        header('Content-Type: text/html; charset=UTF-8');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $data = json_decode($response, true);
        curl_close($ch);

        return $data;
    }
}
