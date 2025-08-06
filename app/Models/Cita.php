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
        'estado'
    ];

    public function paciente() {
        return $this->belongsTo(User::class, 'paciente_id');
    }

    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function especialidad() {
        return $this->belongsTo(Especialidad::class);
    }
}
