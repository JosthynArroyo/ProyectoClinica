<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialidad;
use Illuminate\Support\Facades\Schema;

class EspecialidadesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Especialidad::truncate();
        Schema::enableForeignKeyConstraints();

        Especialidad::create(['nombre' => 'Cardiología', 'descripcion' => 'Diagnóstico y tratamiento de enfermedades del corazón.']);
        Especialidad::create(['nombre' => 'Pediatría', 'descripcion' => 'Atención médica de niños y adolescentes.']);
        Especialidad::create(['nombre' => 'Dermatología', 'descripcion' => 'Salud de la piel, cabello y uñas.']);
        Especialidad::create(['nombre' => 'Medicina General', 'descripcion' => 'Atención primaria integral para adultos.']);
    }
}
