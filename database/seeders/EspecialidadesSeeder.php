<?php

// database/seeders/EspecialidadesSeeder.php
use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class EspecialidadesSeeder extends Seeder
{
    public function run()
    {
        Especialidad::insert([
            ['nombre' => 'Cardiología'],
            ['nombre' => 'Pediatría'],
            ['nombre' => 'Dermatología'],
            ['nombre' => 'Neurología']
        ]);
    }
}
