<?php


namespace App\Repository;


use App\Models\Sensor;

class SensorRepository extends BaseRepository
{
    public function __construct(Sensor $model)
    {
        parent::__construct($model);
    }

    public function firstId() : string {
        return Sensor::all()->first()->id;
    }

    /**
     * @param $id
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function getByUser($id): array|\Illuminate\Database\Eloquent\Collection
    {
        return Sensor::all()->where('created_by', $id);
    }

    public function getOtherByUser($id): array|\Illuminate\Database\Eloquent\Collection
    {
        return Sensor::all()->where('created_by', '<>', $id);
    }
}
