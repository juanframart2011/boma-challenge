<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@istrategy.ai',
                'role_id' => 1,
                'password' => Hash::make('12345'), // Encripta la contraseña
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Eduardo Araujo',
                'email' => 'eduardo.araujo@istrategy.ai',
                'role_id' => 1,
                'password' => Hash::make('12345'), // Encripta la contraseña
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Julieta Sanchez',
                'email' => 'julieta.sanchez@innerassiste.com',
                'role_id' => 2,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}