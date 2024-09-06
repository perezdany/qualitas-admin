<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prime extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'prime_ht', 'prime_net', 'acces_partenaire', 'access_courtier', 
        'taxe', 'commission', 'id_contrat', 'id_utilisateur', 
        'date_heure_encaiss', 'date_heurre_reverse', 'updated_at'
    ];
}
