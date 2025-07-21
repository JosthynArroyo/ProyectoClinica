<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Desactivar chequeos de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vaciar tabla roles
        Role::truncate();

        // Reactivar chequeos de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insertar roles
        Role::create(['name' => 'administrador']);
        Role::create(['name' => 'paciente']);
        Role::create(['name' => 'doctor']);
    }
}
