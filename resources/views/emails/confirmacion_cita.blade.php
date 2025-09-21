<p>Hola {{ $cita->paciente->name }},</p>

<p>Tu cita con {{ $cita->doctor->name }} para el {{ $cita->fecha->format('d/m/Y') }} a las {{ $cita->hora }} ha sido confirmada.</p>

<p>Gracias por confiar en nuestra clínica.</p>
