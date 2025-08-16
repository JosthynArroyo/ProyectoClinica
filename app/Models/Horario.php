<?php
// app/Models/Horario.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = ['doctor_id', 'fecha', 'hora_inicio', 'hora_fin'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
