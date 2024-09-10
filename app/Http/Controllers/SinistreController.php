<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SinistreController extends Controller
{
    //Handle Sinistre

    public function GetAll()
    {
        return $get = DB::table('sinistres')
        ->join('clients', 'sinistres.id_client', '=', 'clients.id')
       
        ->get(['sinistres.*',  'clients.nom_prenoms', ]);
    }


    public function SinistreNonRegle()
    {
        return $get = DB::table('sinistres')
        ->join('clients', 'sinistres.id_client', '=', 'clients.id')
        ->where('etat_regle', 0)
        ->get(['sinistres.*',  'clients.nom_prenoms', ]);
    }
}
