<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
         'montant', 'date_reglement', 'id_prime', 'id_sinistre', 'id_utilisateur', 'updated_at'
    ];
}
