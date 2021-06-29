<?php

namespace Database\Factories;

use App\Models\Sensor;
use App\Models\User;
use Faker\Provider\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SensorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sensor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = User::all()->random()->id;

        return [
            'id' => Str::uuid(),
            'city' => $this->faker->city,
            'zip_code' => $this->faker->postcode,
            'above_see' => rand(0, 100),
            'api_key' => Str::random(),
            'created_by' => $userId,
            'updated_by' => $userId
        ];
    }
}
