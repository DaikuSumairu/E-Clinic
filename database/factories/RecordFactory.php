<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sex = $this->faker->randomElement(['Male', 'Female']);
        $civil = $this->faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed']);
        $mobile = '09'. str_pad($this->faker->randomNumber(9), 9, '0', STR_PAD_LEFT);
        $contact = $this->faker->name;
        $per_mobile = '09'. str_pad($this->faker->randomNumber(9), 9, '0', STR_PAD_LEFT);

        return [
            'sex' => $sex,
            'civil_status' => $civil,
            'mobile_number' => $mobile,
            'contact_person' => $contact,
            'contact_person_number' => $per_mobile
        ];
    }
}
