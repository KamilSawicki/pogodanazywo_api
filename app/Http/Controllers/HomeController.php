<?php

namespace App\Http\Controllers;

use App\Services\MeasurementService;
use App\Services\SensorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private SensorService $_ss;
    private MeasurementService $_ms;

    public function __construct(){
        $this->_ss = new SensorService();
        $this->_ms = new MeasurementService();
    }

    public function home(?string $id = null): JsonResponse{
        $history = $this->_ms->getLastDay($id);
        return response()->json([
            'history' => $history
        ]);
    }
}
