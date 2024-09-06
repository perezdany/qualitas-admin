<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinistre extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'numero_sinistre', 'date_enregistrement', 'numero_enregistrement', 
        'numero_police', 'id_client', 'id_categorie', 'id_utilisateur', 'date_evenement',
         'victime', 'montant_sinistre', 'updated_at'
    ];
}
