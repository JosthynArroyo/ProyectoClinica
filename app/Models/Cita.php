<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas_medicas';

    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'especialidad_id',
        'fecha',
        'hora',
        'estado',
        'activo',
    ];

    const ESTADO_PENDIENTE   = 'pendiente';
    const ESTADO_CONFIRMADA  = 'confirmada';
    const ESTADO_CANCELADA   = 'cancelada';
    const ESTADO_REALIZADA   = 'realizada';

   
    public const ESTADOS = [
        self::ESTADO_PENDIENTE,
        self::ESTADO_CONFIRMADA,
        self::ESTADO_CANCELADA,
        self::ESTADO_REALIZADA,
    ];

    
    protected $casts = [
        'fecha' => 'date',
        'hora'  => 'string',
        'activo' => 'boolean',
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
