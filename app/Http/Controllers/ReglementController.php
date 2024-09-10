<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ReglementController extends Controller
{
    //Handle Reglement

    public function GetAll()
    {
        return $get = DB::table('reglements')
        ->join('primes', 'reglements.id_prime', '=', 'primes.id')
        ->join('sinistres', 'reglements.id_sinistre', '=', 'sinistres.numero_sinistre')
        ->join('contrats', 'primes.id_contrat', '=', 'primes.id')
        ->join('partenaires', 'contrats.id_partenaire', '=', 'partenaires.id')
        ->join('clients', 'contrats.id_client', '=', 'clients.id')
        ->join('utilisateurs', 'contrats.id_utilisateur', '=', 'utilisateurs.id')
        ->get(['reglements.*', 'utilisateurs.nom', 'partenaires.nom_partenaire',  'clients.nom_prenoms', 
        'contrats.numero_police', 'contrats.id_partenaire', 'primes.prime_net',  'sinistres.montant_sinistre']);
    }

    public function GetReglementById($id)
    {
        return $get = DB::table('reglements')
        ->join('primes', 'reglement.id_prime', '=', 'primes.id')
        ->join('sinistres', 'reglement.id_sinistre', '=', 'sinistres.id')
        ->join('contrats', 'primes.id_contrat', '=', 'primes.id')
        ->join('partenaires', 'contrats.id_partenaire', '=', 'partenaires.id')
        ->join('clients', 'contrats.id_client', '=', 'clients.id')
        ->join('utilisateurs', 'contrats.id_utilisateur', '=', 'utilisateurs.id')
        ->where('id', $id)
        ->get(['reglements.*', 'utilisateurs.nom', 'partenaires.nom_partenaire',  'clients.nom_prenoms', 
        'contrats.numero_police', 'contrats.id_partenaire', 'primes.prime_net',  'sinistres.montant_sinistre']);
    }

    public function EditReglementForm(Request $request)
    {

    }

    public function EditReglement(Request $request)
    {

    }

    public function AddReglement(Request $request)
    {
        //VERIFIER SI C'EST POUR SINISTRE OU POUR PRIME ET FAIRE LES CALCULS POUR DETERMINER LE RESTE ETC
        
    }
}
