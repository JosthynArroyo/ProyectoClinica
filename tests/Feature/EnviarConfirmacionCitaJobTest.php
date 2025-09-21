<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Jobs\EnviarConfirmacionCitaJob;
use App\Mail\ConfirmacionCitaMail;
use App\Models\Cita;
use App\Models\User;
use App\Models\Especialidad;

class EnviarConfirmacionCitaJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_envia_correo_de_confirmacion_al_paciente()
    {
        Mail::fake();

        $paciente = User::factory()->create();
        $doctor = User::factory()->create();
        $especialidad = Especialidad::factory()->create();

        $cita = Cita::factory()->create([
            'paciente_id' => $paciente->id,
            'doctor_id' => $doctor->id,
            'especialidad_id' => $especialidad->id,
        ]);

        (new EnviarConfirmacionCitaJob($cita))->handle();

        Mail::assertSent(ConfirmacionCitaMail::class, function ($mail) use ($paciente) {
            return $mail->hasTo($paciente->email);
        });
    }
}
