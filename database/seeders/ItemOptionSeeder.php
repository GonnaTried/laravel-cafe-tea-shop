<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemOption;

class ItemOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['name' => 'Hot'],
            ['name' => 'Cold'],
            ['name' => 'Frappe'],
            ['name' => 'Small'],
            ['name' => 'Medium'],
            ['name' => 'Large'],
        ];

        foreach ($options as $optionData) {
            ItemOption::create($optionData);
        }
    }
}
