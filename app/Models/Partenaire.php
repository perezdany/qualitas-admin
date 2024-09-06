<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nom_partenaire', 'adresse', 'updated_at'
    ];
}
