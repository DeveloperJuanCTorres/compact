<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_escala',
        'first_name',
        'last_name',
        'address',
        'phone',
        'email'
    ];
}
