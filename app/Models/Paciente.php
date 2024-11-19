<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'paciente';

    protected $fillable = [
        'name',
        'caretaker',
        'email',
        'date',
        'symptoms'
    ];

    public $timestamps = false;
}
