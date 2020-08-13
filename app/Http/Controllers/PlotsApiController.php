<?php

namespace App\Http\Controllers;

use App\Http\Resources\Plots;
use App\Services\GetInfoService;
use Illuminate\Http\Request;

class PlotsApiController extends Controller
{
    public function getPlotsInfo(Request $request)
    {
        $service = new GetInfoService();
        $plots = $service->getInfo($request->get('plots'));

        return Plots::collection($plots);
    }
}
