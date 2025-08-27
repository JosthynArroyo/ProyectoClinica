<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Cita;
use App\Models\Especialidad;

class ExportCitasTest extends TestCase
{
    use RefreshDatabase;

    public function test_exportar_citas_generar_archivo_excel()
    {
        $this->withoutMiddleware();

        $admin = User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
        ]);
        
        $paciente = User::factory()->create([
            'name' => 'Paciente Test',
            'email' => 'paciente@test.com',
        ]);
        
        $doctor = User::factory()->create([
            'name' => 'Doctor Test',
            'email' => 'doctor@test.com',
        ]);

        $this->actingAs($admin);

        $especialidad = Especialidad::factory()->create([
            'nombre' => 'Cardiología',
            'descripcion' => 'Especialidad del corazón',
        ]);

        $cita = Cita::factory()->create([
            'paciente_id' => $paciente->id,
            'doctor_id' => $doctor->id,
            'especialidad_id' => $especialidad->id,
            'fecha' => now()->toDateString(),
            'hora' => now()->format('H:i:s'),
            'estado' => 'pendiente',
        ]);

        $this->assertDatabaseHas('citas_medicas', [
            'id' => $cita->id,
            'paciente_id' => $paciente->id,
            'doctor_id' => $doctor->id,
        ]);

        $response = $this->get(route('admin.citas.export'));

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        
        $contentDisposition = $response->headers->get('content-disposition');
        $this->assertStringContainsString('attachment', $contentDisposition);
    }

    public function test_usuario_no_autenticado_no_puede_exportar()
    {

        $response = $this->get(route('admin.citas.export'));

        $this->assertTrue(
            in_array($response->status(), [302, 401, 403]),
            'Usuario no autenticado no debería acceder a la exportación'
        );
    }

    public function test_exportar_citas_con_datos_minimos()
    {
        $this->withoutMiddleware();
        
        $user = User::factory()->create();
        $this->actingAs($user);

        $paciente = User::factory()->create();
        $doctor = User::factory()->create();
        $especialidad = Especialidad::factory()->create();

        Cita::factory()->create([
            'paciente_id' => $paciente->id,
            'doctor_id' => $doctor->id,
            'especialidad_id' => $especialidad->id,
            'fecha' => '2024-01-15',
            'hora' => '10:00:00',
            'estado' => 'pendiente',
        ]);

        $response = $this->get(route('admin.citas.export'));
        
        $response->assertStatus(200);
        
        $this->assertTrue(
            str_contains($response->headers->get('content-type'), 'spreadsheetml') ||
            str_contains($response->headers->get('content-type'), 'excel'),
            'La respuesta debe ser un archivo Excel'
        );
    }
}