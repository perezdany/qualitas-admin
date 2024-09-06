<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends  Authenticatable
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'login', 'password', 'nom', 'id_roles', 'updated_at'
    ];
}
