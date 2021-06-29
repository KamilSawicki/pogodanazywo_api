<?php


namespace App\Repository;


use App\Models\Measurement;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class MeasurementRepository extends BaseRepository
{
    public function __construct(Measurement $model) {
        parent::__construct($model);
    }

    public function storeMultiple(array $data) : void {
        DB::table('measurements')->insert($data);
    }

    public function getByHour(string $id, int $limit) : Collection {
        return Measurement::all()
            ->where('sensor_id', $id)
            ->sortByDesc('date')
            ->take(24)
            ->reverse();
    }
}
