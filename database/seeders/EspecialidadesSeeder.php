<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class EspecialidadesSeeder extends Seeder
{
    public function run(): void
    {
        Especialidad::truncate();

        Especialidad::create(['nombre' => 'Cardiología']);
        Especialidad::create(['nombre' => 'Pediatría']);
        Especialidad::create(['nombre' => 'Dermatología']);
        Especialidad::create(['nombre' => 'Medicina General']);
    }
}
