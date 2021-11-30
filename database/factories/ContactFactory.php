<?php

namespace Database\Factories;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = \App\Repositories\Models\Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => StringHelper::formatNumbers($this->faker->phoneNumber),
            'zip' => rand(00000001, 99999999),
            'city' => $this->faker->city,
            'state' => 'SP',
            'neighborhood' => $this->faker->city,
            'address' => $this->faker->address,
            'number' => rand(0, 30000),
            'complement' => (rand(0, 1) ? $this->faker->firstName : null)
        ];
    }
}
