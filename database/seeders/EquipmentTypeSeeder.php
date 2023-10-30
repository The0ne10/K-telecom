<?php

namespace Database\Seeders;

use App\Models\EquipmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $title = ['D-Link Dir-300', 'D-Link DIR-300 E', 'TP-Link TL-WR74'];
        $mask = ['NXXAAXZXaa', 'NAAAAXZXXX', 'XXAAAAAXAA'];

        foreach ($title as $key => $item) {
            EquipmentType::query()->create([
               'title' => $item,
               'mask' => $mask[$key]
            ]);
        }
    }
}
