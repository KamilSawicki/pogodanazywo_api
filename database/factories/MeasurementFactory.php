<?php

namespace Database\Factories;

use App\Models\Measurement;
use App\Models\Model;
use App\Models\Sensor;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeasurementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Measurement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'temperature' => $this->faker->numberBetween(-30, 30),
            'humidity' => $this->faker->numberBetween(0, 100),
            'pressure' => $this->faker->numberBetween(980, 1050),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'sensor_id' => Sensor::all()->random()->id
        ];
    }
}
