<?php


namespace App\Repository;


use App\Models\Sensor;

class SensorRepository extends BaseRepository
{
    public function __construct(Sensor $model)
    {
        parent::__construct($model);
    }

    public function randomId() : string {
        return Sensor::all()->random()->id;
    }
}
