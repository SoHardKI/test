<?php

namespace App\Services;

use GuzzleHttp\Client;

/**
 * Class GetInfoService
 * @package App\Services
 */
class GetInfoService extends \App\AbstractGetPlotsInfo
{
    /**
     * @param string $plots
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInfo(string $plots): string
    {
        $requestPlots = explode(',', $plots);
        $client = new Client([]);
        $res = $client->request('GET', $this->getUrl(), [
            'body' => json_encode([
                'collection' => [
                    'plots' => [
                        trim($requestPlots[0]),
                        trim($requestPlots[1])
                    ]
                ],
            ]),
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);

        return $res->getBody()->getContents();
    }
}
