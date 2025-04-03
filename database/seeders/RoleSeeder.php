<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'SuperAdministrador',
                'description' => 'Tiene acceso completo a todas las funcionalidades del sistema.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Administrador',
                'description' => 'Puede operar procesos asignados y gestionar tareas específicas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Capturista',
                'description' => 'Encargado de capturar información y realizar registros básicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
