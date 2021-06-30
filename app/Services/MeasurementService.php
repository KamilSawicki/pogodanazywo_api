<?php


namespace App\Services;


use App\Models\Measurement;
use App\Models\Sensor;
use App\Repository\MeasurementRepository;
use App\Repository\SensorRepository;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MeasurementService
{
    private MeasurementRepository $_mr;
    private SensorRepository $_sr;

    private array $validationRules =[
        'temperature' => 'required|numeric|min:-50|max:50',
        'humidity' => 'required|numeric|min:0|max:100',
        'pressure' => 'required|numeric|min:980|max:1100',
        'date' => 'required'
    ];

    public function __construct()
    {
        $this->_mr = new MeasurementRepository(new Measurement());
        $this->_sr = new SensorRepository(new Sensor());
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

    /**
     * @throws Exception
     */
    public function getLastDay(string $id) : array {
        $measurements = $this->_mr->getByHour($id, 24);

        return $this->buildArray($measurements);
    }

    /**
     * @throws Exception
     */
    public function getLastWeek(string $id) : array {
        $measurements = $this->_mr->getByDay($id, 7);

        return $this->buildArray($measurements);
    }

    /**
     * @throws Exception
     */
    public function getLastMonth(string $id) : array {
        $measurements = $this->_mr->getByDay($id, 30);

        return $this->buildArray($measurements);
    }

    /**
     * @throws Exception
     */
    public function getLastYear(string $id) : array {
        $measurements = $this->_mr->getByDay($id, 365);

        return $this->buildArray($measurements);
    }

    /**
     * @throws Exception
     */
    public function getLatestMeasurement(string $id) : array {
        $measurements = $this->_mr->getLatest($id);
        if(is_null($measurements)){
            throw new Exception('sensor_not_found');
        }
        else{
            return [
                'temperature' => $measurements->temperature,
                'humidity' => $measurements->humidity,
                'pressure' => $measurements->pressure
            ];
        }
    }

    /**
     * @throws Exception
     */
    private function buildArray($data) : array{
        if($data==null){
            throw new Exception('no_measurements');
        }

        $result = [
            'labels' => [],
            'humidity' => [],
            'pressure' => [],
            'temperature' => [],
            'min_humidity' => [],
            'min_pressure' => [],
            'min_temperature' => [],
            'max_humidity' => [],
            'max_pressure' => [],
            'max_temperature' => [],
        ];

        foreach($data as $m) {
            $result['labels'][] = $m->date;
            $result['humidity'][] = $m->humidity;
            $result['pressure'][] = $m->pressure;
            $result['temperature'][] = $m->temperature;
            $result['min_humidity'][] = $m->min_humidity;
            $result['min_pressure'][] = $m->min_pressure;
            $result['min_temperature'][] = $m->min_temperature;
            $result['max_humidity'][] = $m->max_humidity;
            $result['max_pressure'][] = $m->max_pressure;
            $result['max_temperature'][] = $m->max_temperature;
        }

        return $result;
    }
}
