<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Desactiva claves foráneas de forma compatible con cualquier motor
        Schema::disableForeignKeyConstraints();

        // Vacía la tabla de roles
        Role::truncate();

        // Vuelve a activar las claves foráneas
        Schema::enableForeignKeyConstraints();

        // Insertar roles
        Role::create(['name' => 'administrador']);
        Role::create(['name' => 'paciente']);
        Role::create(['name' => 'doctor']);
    }
}
