<?php

namespace Tests\Unit;

use App\Jobs\EnviarConfirmacionCitaJob;
use App\Models\Cita;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class EnviarConfirmacionCitaJobTest extends TestCase
{
    public function test_logs_confirmation_message(): void
    {
        Log::shouldReceive('info')
            ->once()
            ->with('Confirmación enviada a: John Doe (john@example.com)');

        $paciente = new User(['name' => 'John Doe', 'email' => 'john@example.com']);

        $cita = new Cita();
        $cita->setRelation('paciente', $paciente);

        $job = new EnviarConfirmacionCitaJob($cita);

        $job->handle();
    }
}
