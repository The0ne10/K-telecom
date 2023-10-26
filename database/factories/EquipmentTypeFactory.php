<?php

namespace Database\Factories;

use App\Actions\StoreEquipmentTypeActions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentType>
 */
class EquipmentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => fake()->linuxProcessor,
            'mask' => StoreEquipmentTypeActions::getMask()
        ];
    }
}
