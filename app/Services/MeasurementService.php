<?php


namespace App\Services;


use App\Models\Measurement;
use App\Models\Sensor;
use App\Repository\MeasurementRepository;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MeasurementService
{
    private MeasurementRepository $_mr;
    private array $validationRules =[
        'temperature' => 'required|numeric|min:-50|max:50',
        'humidity' => 'required|numeric|min:0|max:100',
        'pressure' => 'required|numeric|min:980|max:1100',
        'date' => 'required'
    ];

    public function __construct()
    {
        $this->_mr = new MeasurementRepository(new Measurement());
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function store(?array $data, Sensor $sensor) {
        $validatedData = [];

        if (is_null($data)) {
            throw new Exception(__('entity_exception.data_is_required'));
        }

        foreach ($data as $r) {
            $validator = Validator::make($r, $this->validationRules);
            if (!$validator->fails()) {
                $validatedData[] = array_merge($validator->validated(), ['sensor_id' => $sensor->id]);
            }
        }

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        $this->_mr->storeMultiple($validatedData);
    }
}
