<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['user_id', 'telefone', 'data_nascimento'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}
