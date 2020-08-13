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
        $service = new GetInfoService();
        $plots = $service->getInfo($request->get('plots'));

        return view('plots.info', compact('plots'));
    }
}
