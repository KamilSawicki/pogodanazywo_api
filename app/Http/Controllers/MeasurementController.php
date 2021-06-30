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

    public function lastDay($id): JsonResponse {
        try {
            $res = $this->_ms->getLastDay($id);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
        return response()->json($res);
    }

    public function lastWeek($id): JsonResponse {
        try {
            $res = $this->_ms->getLastWeek($id);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
        return response()->json($res);
    }

    public function lastMonth($id): JsonResponse {
        try {
            $res = $this->_ms->getLastMonth($id);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
        return response()->json($res);
    }

    public function lastYear($id): JsonResponse {
        try {
            $res = $this->_ms->getLastYear($id);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
        return response()->json($res);
    }
}
