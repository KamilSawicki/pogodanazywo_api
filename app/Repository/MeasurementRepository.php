<?php


namespace App\Repository;


use App\Models\Measurement;
use Illuminate\Support\Facades\DB;

class MeasurementRepository extends BaseRepository
{
    public function __construct(Measurement $model) {
        parent::__construct($model);
    }

    public function storeMultiple(array $data) : void {
        DB::table('measurements')->insert($data);
    }
}
