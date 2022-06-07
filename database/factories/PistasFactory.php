<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PistasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            '09:00' => $this->faker->boolean(true),
            '10:30' => $this->faker->boolean(false),
            '12:00' => $this->faker->boolean(false),
            '13:30' => $this->faker->boolean(false),
            '15:00' => $this->faker->boolean(false),
            '16:30' => $this->faker->boolean(false),
            '18:00' => $this->faker->boolean(false),
            '19:30' => $this->faker->boolean(false),
            '21:00' => $this->faker->boolean(false),
            '22:30' => $this->faker->boolean(false),
        ];
    }
}
