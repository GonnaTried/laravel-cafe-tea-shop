<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $adminRole = Role::firstOrCreate(['name' => 'admin']);

            $adminUser = User::where('phone', 'admin')->first();

            if (!$adminUser) {
                $adminUser = User::create([
                    'phone' => 'admin',
                    'password' => Hash::make('password'),
                ]);
            }

            $adminUser->assignRole($adminRole);

            $this->command->info('Admin user processed.');
        });
    }
}
