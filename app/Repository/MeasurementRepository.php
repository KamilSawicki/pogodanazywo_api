<?php


namespace App\Repository;


use App\Models\Measurement;
use Exception;
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

    public function getByHour(string $id, int $limit) : \Illuminate\Support\Collection
    {
        return DB::table('measurements')
            ->select([
                DB::raw('min(humidity) as min_humidity'),
                DB::raw('min(pressure) as min_pressure'),
                DB::raw('min(temperature) as min_temperature'),
                DB::raw('max(humidity) as max_humidity'),
                DB::raw('max(pressure) as max_pressure'),
                DB::raw('max(temperature) as max_temperature'),
                DB::raw('round(avg(humidity), 2) as humidity'),
                DB::raw('round(avg(pressure), 2) as pressure'),
                DB::raw('round(avg(temperature), 2) as temperature'),
                DB::raw('hour(date) as date'),
            ])
            ->where('sensor_id', $id)
            ->groupBy(DB::raw('hour(date)'))
            ->orderBy('date')
            ->limit($limit)
            ->get()
            ->reverse();
    }

    public function getByDay(string $id, int $limit) : \Illuminate\Support\Collection
    {
        return DB::table('measurements')
            ->select([
                DB::raw('min(humidity) as min_humidity'),
                DB::raw('min(pressure) as min_pressure'),
                DB::raw('min(temperature) as min_temperature'),
                DB::raw('max(humidity) as max_humidity'),
                DB::raw('max(pressure) as max_pressure'),
                DB::raw('max(temperature) as max_temperature'),
                DB::raw('round(avg(humidity), 2) as humidity'),
                DB::raw('round(avg(pressure), 2) as pressure'),
                DB::raw('round(avg(temperature), 2) as temperature'),
                DB::raw('concat(date(date)) as date')
            ])
            ->where('sensor_id', $id)
            ->groupBy('date')
            ->orderByDesc('date')
            ->limit($limit)
            ->get()
            ->reverse();
    }

    /**
     * @throws Exception
     */
    public function getLatest(string $id) : null|Measurement {
        $res = Measurement::all()->where('sensor_id', $id)->sortByDesc('date');
        if($res == null){
            throw new Exception('sensor_not_found');
        }else{
            return $res->first();
        }
    }
}
