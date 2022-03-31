<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Citizen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "citizen";

    protected $fillable = [
        'nome',
        'sobrenome',
        'cpf',
        'email',
        'celular',
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'uf'
    ];
}
