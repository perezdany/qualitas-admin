<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contrat;

use DB;

class ContratController extends Controller
{
    //Handle Contrat

    public function GetAll()
    {
        $get = DB::table('contrats')
        ->join('clients', 'contrats.id_client', '=', 'clients.id')
        ->join('partenaires', 'contrats.id_partenaire', '=', 'partenaires.id')
        ->join('utilisateurs', 'contrats.id_utilisateur', '=', 'utilisateurs.id')
        
        ->get(['contrats.*', 'utilisateurs.nom', 'partenaires.nom_partenaire', 'clients.nom_prenoms',]);


        return $get;
    }

    public function EditContratForm(Request $request)
    {
        return view('user/contrats',
            [
                'id_contrat' => $request->id_contrat,
            ]
        );

    }


    public function AddContrat(Request $request)
    {
        if($request->partenaire == 0)
        {
            return back()->with('error', 'Vous n\'avez pas choisi l\'entreprise');
        }

        if($request->client == 0)
        {
            return back()->with('error', 'Vous n\'avez pas choisi l\'entreprise');
        }

        $Insert = Contrat::create([
            'id_client' => $request->client, 'id_partenaire' => $request->partenaire, 'id_utilisateur' => auth()->user()->id, 
            'duree_an' => $request->duree_an, 'duree_mois' => $request->duree_mois, 'numero_assure' => $request->num_assure,
        'numero_police' => $request->num_police, 'date_encaissement' => $request->date_encaissement, 'debut_contrat' => $request->debut_contrat, 
        'date_reversement' =>  $request->date_versement, 
       ]);

       return redirect('contrats')->with('success', 'Enregistrement effectué');
    }

    public function EditContrat(Request $request)
    {

        $affected = DB::table('contrats')
        ->where('id', '=', $request->id_contrat)
        ->update([
            'id_client' => $request->client, 'id_partenaire' => $request->partenaire,
            'duree_an' => $request->duree_an, 'duree_mois' => $request->duree_mois, 'numero_assure' => $request->num_assure,
            'numero_police' => $request->num_police, 'date_encaissement' => $request->date_encaissement,
             'debut_contrat' => $request->debut_contrat, 
            'date_reversement' =>  $request->date_versement, 
       ]);

       return redirect('contrats')->with('success', 'Modification effectué');
    }

    public function GetContratById($id)
    {
        $get = DB::table('contrats')
        ->join('clients', 'contrats.id_client', '=', 'clients.id')
        ->join('partenaires', 'contrats.id_partenaire', '=', 'partenaires.id')
        ->join('utilisateurs', 'contrats.id_utilisateur', '=', 'utilisateurs.id')
        ->where('contrats.id', $id)
        ->get(['contrats.*', 'utilisateurs.nom', 'partenaires.nom_partenaire', 'clients.nom_prenoms',]);

        return $get;
    }

    public function DeleteContrat(Request $request)
    {
        
    }
}
