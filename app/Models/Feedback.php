<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['nome', 'cpf', 'nivel_satisfacao', 'visita_id'];

    protected $table = 'feedbacks';

    public function visita()
    {
        return $this->belongsTo(Visita::class);
    }
}
