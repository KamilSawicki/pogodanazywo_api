<?php


namespace App\Http\Middleware;


use App\Services\AuthService;
use App\Services\SensorService;
use Illuminate\Http\Request;
use Closure;

class SensorAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $sensorService = new SensorService();
            $sensor = $sensorService->sensorAuthenticate($request->header('sensor_id'), $request->header('api_key'));
            $request->sensor = $sensor;
            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'unauthorized'], 401);
        }
    }
}
