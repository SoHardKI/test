<?php

namespace App\Services;

use App\AbstractGetPlotsInfo;
use App\Plots;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class GetInfoService
 * @package App\Services
 */
class GetInfoService extends AbstractGetPlotsInfo
{
    /**
     * @param string $plots
     * @return Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInfo(string $plots): Collection
    {
        $inputPlots = explode(',', $plots);
        $plots = Plots::whereIn('cadastral_number', [trim($inputPlots[0]), trim($inputPlots[1])])->get();
        if (!count($plots)) {
            $client = new Client();
            $res = $client->request('GET', $this->getUrl(), [
                'body' => json_encode([
                    'collection' => [
                        'plots' => [
                            trim($inputPlots[0]),
                            trim($inputPlots[1])
                        ]
                    ],
                ]),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);

            $requestPlots = \GuzzleHttp\json_decode($res->getBody()->getContents());
            $plots = collect();

            foreach ($requestPlots as $plot) {
                $plots->push(Plots::create([
                    'cadastral_number' => $plot->number,
                    'address' => $plot->data->attrs->address,
                    'price' => $plot->data->attrs->cad_cost,
                    'area' => $plot->data->attrs->area_value
                ]));
            }
        }

        return $plots;
    }
}
