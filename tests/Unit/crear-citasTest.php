<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Especialidad;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgendarCitaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_paciente_puede_agendar_una_cita()
    {
        $user = User::factory()->create();
        $doctor = Doctor::factory()->create();
        $especialidad = Especialidad::factory()->create();

        $response = $this->actingAs($user)->post(route('paciente.citas.store'), [
            'doctor_id' => $doctor->id,
            'especialidad_id' => $especialidad->id,
            'fecha' => now()->addDay()->format('Y-m-d'),
            'hora' => '10:00',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('citas', [
            'doctor_id' => $doctor->id,
            'especialidad_id' => $especialidad->id,
        ]);
    }
}
