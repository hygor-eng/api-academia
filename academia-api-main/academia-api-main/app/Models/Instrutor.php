<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instrutor extends Model
{
    protected $fillable = ['user_id', 'especialidade'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class);
    }
}
