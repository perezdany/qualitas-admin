<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_client', 'id_partenaire', 'id_utilisateur', 'duree_an', 'duree_mois', 
        'numero_police', 'date_encaissement', 'debut_contrat', 
        'date_reversement', 'updated_at', 'numero_assure'
    ];
}
