<?php

namespace App\Http\Controllers;

use App\Plots;
use App\Services\GetInfoService;
use Illuminate\Http\Request;

/**
 * Class PlotsController
 * @package App\Http\Controllers
 */
class PlotsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('plots.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPlots(Request $request)
    {
        $inputPlots = explode(',', $request->get('plots'));
        $plots = Plots::whereIn('cadastral_number', [trim($inputPlots[0]), trim($inputPlots[1])])->get();
        if (!count($plots)) {
            $service = new GetInfoService();
            $requestPlots = $service->getInfo($request->get('plots'));
            $requestPlots = \GuzzleHttp\json_decode($requestPlots);
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

        return view('plots.info', compact('plots'));
    }
}
