<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends  Authenticatable
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'nom_prenoms', 'login', 'password', 'email', 'code_login'
    ]
}
