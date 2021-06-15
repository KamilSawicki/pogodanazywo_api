<?php


namespace App\Services;


use App\Models\Sensor;
use App\Repository\SensorRepository;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SensorService
{
    private SensorRepository $_sr;
    private array $validatorRules=[
        'above_see' => 'required|integer|min:0|max:1000',
        'city' => 'required|string|min:3',
        'zip_code' => 'required|regex:/\b\d{5}\b/'
    ];

    public function __construct() {
        $this->_sr = new SensorRepository(new Sensor());
    }

    public function getAll() : array {
        return $this->_sr->all()->toArray();
    }

    /**
     * @throws Exception
     */
    public function get(string $id) : Sensor {
        return $this->_sr->find($id);
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function store(array $attributes) : array {
        $api_key = Str::random(32);
        $validator = Validator::make(
            $attributes,
            $this->validatorRules
        );

        if (!$validator->fails()) {
            $sensor = $this->_sr->store(array_merge($validator->validated(), ['api_key' => Hash::make($api_key)]));
            return [
                'sensor' => $sensor,
                'api_key' => $api_key
            ];
        }
        else {
            throw new Exception(__('sensor_exception.validator_error'));
        }
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function update(array $attributes, string $id) : Sensor {
        $validator = Validator::make(
            $attributes,
            $this->validatorRules
        );

        if (!$validator->fails()) {
            return $this->_sr->update($validator->validated(), $id);
        }
        else {
            throw new Exception(__('sensor_exception.validator_error'));
        }
    }

    /**
     * @throws Exception
     */
    public function delete(string $id) : void {
        $this->_sr->delete($id);
    }

    /**
     * @throws Exception
     */
    public function sensorAuthenticate(?string $id, ?string $api_key) {
        if (is_null($id) || is_null($api_key)) {
            throw new Exception(__('entity_exception.not_found'));
        }
        else {
            $sensor = $this->_sr->find($id);
            if (Hash::check($api_key, $sensor->api_key)) {
                return $sensor;
            }
        }
    }
}
