<?php

namespace App\Http\Controllers;

use App\Services\SensorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SensorController extends Controller
{
    private SensorService $_ss;

    public function __construct() {
        $this->_ss = new SensorService();
    }

    public function index() : JsonResponse {
        $sensors = $this->_ss->getAll();
        return response()->json(['data' => $sensors]);
    }

    public function get(string $id) : JsonResponse {
        try {
            $sensor = $this->_ss->get($id);
            return response()->json(['data' => $sensor]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(Request $request) : JsonResponse
    {
        try {
            $result = $this->_ss->store($request->all());
            return response()->json([
                'sensor' => $result['sensor'],
                'api_token' => $result['api_key']
            ]);
        }
        catch (ValidationException | \Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(string $id, Request $request) : JsonResponse {
        try {
            $result = $this->_ss->update($request->all(), $id);
            return response()->json(['data' => $result]);
        }
        catch (ValidationException | \Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(string $id) : JsonResponse {
        try {
            $this->_ss->delete($id);
            return response()->json(true);
        }
        catch (\Exception $e) {
            return response()->json(true, 404);
        }
    }
}
