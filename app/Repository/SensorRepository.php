<?php


namespace App\Repository;


use App\Models\Sensor;

class SensorRepository extends BaseRepository
{
//    public static function all() : Collection {
//        return Sensor::all();
//    }
//
//    /**
//     * @throws Exception
//     */
//    public static function find(?string $id) : Sensor {
//        $sensorList = Sensor::all()->find($id);
//        if ($sensorList->isEmpty()) {
//            throw new Exception(__('sensor_exception.not_found'));
//        }
//        else {
//            return $sensorList->first();
//        }
//    }
//
//    /**
//     * @throws Exception
//     */
//    public static function findMany(array $keys) : Collection {
//        $sensorList = Sensor::all()->find($keys);
//        if ($sensorList->isEmpty()) {
//            throw new Exception(__('sensor_exception.not_found'));
//        }
//        else {
//            return $sensorList;
//        }
//    }

    public function __construct(Sensor $model)
    {
        parent::__construct($model);
    }
}
