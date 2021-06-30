<?php


namespace App\Repository;


use App\Models\Sensor;
use Illuminate\Database\Eloquent\Collection;

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
    public function getByUser($id): array|Collection
    {
        return Sensor::all()->where('created_by', $id)->sortBy('city');
    }

    public function getOtherByUser($id): array|Collection
    {
        return Sensor::all()->where('created_by', '<>', $id)->sortBy('city');
    }

    public function all() : Collection{
        return parent::all()->sortBy('city');
    }
}
