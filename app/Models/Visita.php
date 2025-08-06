<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
      protected $fillable = ['nome', 'cpf', 'rg', 'instituicao', 'foto', 'status', 'telefone', 'motivo'];

      public function feedbacks()
      {
            return $this->hasMany(Feedback::class);
      }

}
