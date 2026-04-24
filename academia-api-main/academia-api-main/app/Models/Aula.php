<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $fillable = ['matricula_id', 'instrutor_id', 'nome', 'horario', 'vagas'];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function instrutor()
    {
        return $this->belongsTo(Instrutor::class);
    }
}
