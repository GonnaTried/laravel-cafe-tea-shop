<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class StuffUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $staffRole = Role::firstOrCreate(['name' => 'staff']);

            $staffUser = User::where('phone', 'staff')->first();

            if (!$staffUser) {
                $staffUser = User::create([
                    'phone' => 'staff',
                    'password' => Hash::make('password'),
                ]);
            }

            $staffUser->assignRole($staffRole);

            $this->command->info('Staff user processed.');
        });
    }
}
