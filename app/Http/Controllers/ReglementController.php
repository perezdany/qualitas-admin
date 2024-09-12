<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Models\Reglement;

use App\Models\Prime;

use App\Models\Sinistre;

class ReglementController extends Controller
{
    //Handle Reglement
    /*

     ->join('contrats', 'primes.id_contrat', '=', 'primes.id')
        ->join('partenaires', 'contrats.id_partenaire', '=', 'partenaires.id')
        ->join('clients', 'contrats.id_client', '=', 'clients.id')

    'utilisateurs.nom', 'partenaires.nom_partenaire',  'clients.nom_prenoms', 
     'contrats.numero_police', 'contrats.id_partenaire', 'primes.prime_net',        
       
        
    */
    public function GetAllPourSinistre()
    {
        $get = DB::table('reglements')
        ->join('sinistres', 'reglements.id_sinistre', '=', 'sinistres.numero_sinistre')
        ->join('clients', 'sinistres.id_client', '=', 'clients.id')
        ->join('utilisateurs', 'reglements.id_utilisateur', '=', 'utilisateurs.id')
        ->get(['reglements.*', 'sinistres.montant_sinistre',  'utilisateurs.nom', 'clients.nom_prenoms', 'sinistres.restant'
        ]);

       
        return $get;
    }

    public function GetAllPourPrime()
    {
        $get = DB::table('reglements')
        ->join('primes', 'reglements.id_prime', '=', 'primes.id')
        ->join('contrats', 'primes.id_contrat', '=', 'contrats.id')
        ->join('partenaires', 'contrats.id_partenaire', '=', 'partenaires.id')
        ->join('clients', 'contrats.id_client', '=', 'clients.id')
        ->join('utilisateurs', 'reglements.id_utilisateur', '=', 'utilisateurs.id')
        ->get(['reglements.*', 'primes.prime_net',  'utilisateurs.nom', 
        'partenaires.nom_partenaire',  'clients.nom_prenoms' , 'primes.restant']);

       
        return $get;
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
        //VERIFIER SI C'EST POUR SINISTRE OU POUR PRIME ET FAIRE LES CALCULS POUR DETERMINER LE RESTE ETC ,
        if($request->prime !=null)
        {
            $somme = 0;
           
            $Insert = Reglement::create([
                'montant' => $request->montant, 'date_reglement' => $request->date_reglement, 
                 'id_prime' => $request->prime, 'id_utilisateur' => auth()->user()->id, 
            ]);

            //PRENDRE LES REGELEMENT DE CETTE PRIME 
            $les_reglements = Reglement::where('id_prime', $request->prime)->get();
            
            foreach($les_reglements as $les_reglements)
            {
                $somme =  $somme + $les_reglements->montant;
            }
            
           
            //PRENDRE LA PRIME EN QUESTION
            $prime =Prime::where('id', $request->prime)->get();
            foreach($prime as $prime)
            {
                $rest = $prime->prime_net - $somme;
            }
            
            if($rest == 0) //ON CHANGE L'ETAT EN ETT REGLE
            {
                $affected = DB::table('primes')
                ->where('id', '=', $request->prime)
                ->update([
                    'etat_regle' => 1, 
                ]);
            }

            //MISE A JOUR DE LA TABLE
            $affected = DB::table('primes')
            ->where('id', '=', $request->prime)
            ->update([
                'restant' => $rest, 
            ]);
             

            return redirect('reglements')->with('success', 'Enregistrement effectué');
        }

        if($request->sinistre !=null)
        {
            $Insert = Reglement::create([
                 'montant' => $request->montant, 'date_reglement' => $request->date_reglement, 
                  'id_sinistre' => $request->sinistre, 'id_utilisateur' => auth()->user()->id, 
           ]);

           $les_reglements = Reglement::where('id_prime', $request->prime)->get();
            
            foreach($les_reglements as $les_reglements)
            {
                $somme =  $somme + $les_reglements->montant;
            }
            
            
            //PRENDRE LA PRIME EN QUESTION
            $sinistre =Sinistre::where('id', $request->sinistre)->get();
 
            $rest = $sinistre->montant_sinistre - $somme;

            if($rest == 0) //ON CHANGE L'ETAT EN ETT REGLE
            {
                $affected = DB::table('sinustres')
                ->where('id', '=', $request->sinistre)
                ->update([
                    'etat_regle' => 1, 
                ]);
            }

            //MISE A JOUR DE LA TABLE
            $affected = DB::table('sinustres')
            ->where('id', '=', $request->sinistre)
            ->update([
                'restant' => $rest, 
            ]);

           return redirect('reglemnts')->with('success', 'Enregistrement effectué');
        }
    }
}
