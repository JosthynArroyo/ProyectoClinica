<?php

namespace Tests\Unit;

use App\Jobs\EnviarConfirmacionCitaJob;
use App\Models\Cita;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacionCitaMail;
use Tests\TestCase;

class EnviarConfirmacionCitaJobTest extends TestCase
{
    public function test_envia_correo_de_confirmacion(): void
    {
        Mail::fake();

        $paciente = new User(['name' => 'John Doe', 'email' => 'john@example.com']);
        $doctor   = new User(['name' => 'Dr. Smith']);

        $cita = new Cita([
            'fecha' => now(),
            'hora'  => '10:00:00',
        ]);
        $cita->setRelation('paciente', $paciente);
        $cita->setRelation('doctor', $doctor);

        $job = new EnviarConfirmacionCitaJob($cita);
        $job->handle();

        Mail::assertSent(ConfirmacionCitaMail::class, function ($mail) use ($paciente) {
            return $mail->hasTo($paciente->email);
        });
    }
}
