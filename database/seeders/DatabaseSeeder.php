<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ItemOptionSeeder::class,
            //Tea Seeder
            HotTeaSeeder::class,
            ColdTeaSeeder::class,
            // Coffee Seeder
            HotCoffeeSeeder::class,
            ColdCoffeeSeeder::class,
            FrappeCoffeeSeeder::class,

        ]);
    }
}
