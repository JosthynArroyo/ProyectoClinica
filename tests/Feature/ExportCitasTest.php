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
        // Deshabilitar middleware para enfocarnos en la funcionalidad
        $this->withoutMiddleware();

        // Crear usuarios simples
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

        // Autenticar como admin
        $this->actingAs($admin);

        // Crear especialidad
        $especialidad = Especialidad::factory()->create([
            'nombre' => 'Cardiología',
            'descripcion' => 'Especialidad del corazón',
        ]);

        // Crear cita
        $cita = Cita::factory()->create([
            'paciente_id' => $paciente->id,
            'doctor_id' => $doctor->id,
            'especialidad_id' => $especialidad->id,
            'fecha' => now()->toDateString(),
            'hora' => now()->format('H:i:s'),
            'estado' => 'pendiente',
        ]);

        // Verificar que la cita existe en la base de datos
        $this->assertDatabaseHas('citas_medicas', [
            'id' => $cita->id,
            'paciente_id' => $paciente->id,
            'doctor_id' => $doctor->id,
        ]);

        // Probar la exportación
        $response = $this->get(route('admin.citas.export'));

        // Verificaciones
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        
        // Verificar que tiene el header de descarga
        $contentDisposition = $response->headers->get('content-disposition');
        $this->assertStringContainsString('attachment', $contentDisposition);
    }

    public function test_usuario_no_autenticado_no_puede_exportar()
    {
        // Sin autenticación y sin deshabilitar middleware
        $response = $this->get(route('admin.citas.export'));

        // Debería redirigir o dar error
        $this->assertTrue(
            in_array($response->status(), [302, 401, 403]),
            'Usuario no autenticado no debería acceder a la exportación'
        );
    }

    public function test_exportar_citas_con_datos_minimos()
    {
        // Test con datos mínimos para verificar que el export funciona
        $this->withoutMiddleware();
        
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear solo los datos mínimos necesarios
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
        
        // Verificar que la exportación funciona
        $response->assertStatus(200);
        
        // Verificar que es un archivo Excel
        $this->assertTrue(
            str_contains($response->headers->get('content-type'), 'spreadsheetml') ||
            str_contains($response->headers->get('content-type'), 'excel'),
            'La respuesta debe ser un archivo Excel'
        );
    }
}