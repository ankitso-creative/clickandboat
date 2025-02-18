<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\Auth\Role\RolesEnum;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'role' => RolesEnum::ADMIN->value,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Admin@123'),
                'created_at' => now(),
                'updated_at' => now(),
            ], 
        ]);
    }
}
