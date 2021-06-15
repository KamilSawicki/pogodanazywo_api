<?php

namespace App\Http\Controllers;

use App\Services\MeasurementService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MeasurementController extends Controller
{
    private MeasurementService $_ms;

    public function __construct(){
        $this->_ms = new MeasurementService();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->_ms->store($request->data, $request->sensor);
            return response()->json(true);
        }
        catch (ValidationException|Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
