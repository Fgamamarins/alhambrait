<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'step',
        'identifier',
        'full_name',
        'birth_date',
        'cep',
        'state',
        'city',
        'street',
        'number',
        'phone',
        'cellphone',
    ];
}
