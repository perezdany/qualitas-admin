<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Models\Prime;

class PrimeController extends Controller
{
    //Handle Primes

    public function GetAll()
    {
        $get = DB::table('primes')
        ->join('contrats', 'primes.id_contrat', '=', 'contrats.id')
        ->join('clients', 'contrats.id_client', '=', 'clients.id')

        ->get(['primes.*',  'clients.nom_prenoms', 'contrats.numero_police', 'clients.nom_prenoms']);

        return $get;
    }

    public function PrimeNonReglee()
    {
        $get = DB::table('primes')
        ->join('contrats', 'primes.id_contrat', '=', 'contrats.id')
        ->join('clients', 'contrats.id_client', '=', 'clients.id')
        ->where('primes.etat_regle', 0)
        ->get(['primes.*',  'clients.nom_prenoms', 'contrats.numero_police', 'clients.nom_prenoms']);

        return $get;

    }

    public function AddPrime(Request $request)
    {
        //dd(date('d/m/Y H:i:s',strtotime($request->date_hr_encaiss)));

        if($request->contrat == 0)
        {
            return back()->with('error', 'Chosissez le contrat Svp!');
        }

        $Insert = Prime::create([
            'prime_ht' => $request->prime_ht, 'prime_net' => $request->prime_net, 'acces_partenaire' => $request->partenaire, 
            'taxe' => $request->taxe, 'commission' => $request->commission, 'id_contrat' => $request->contrat, 
            'id_utilisateur' => auth()->user()->id, 
            'date_heure_encaiss' => $request->date_hr_encaiss, 'date_heurre_reverse' => $request->date_hr_reverse, 
       ]);

       return redirect('primes')->with('success', 'Enregistrement effectué');
    }

    public function EditPrimeForm(Request $request)
    {
            return view('user/primes',
            [
                'id_prime' => $request->id_prime,
            ]
        );
    }

    public function GetPrimeById($id)
    {
        return $get = DB::table('primes')
        ->join('contrats', 'primes.id_contrat', '=', 'primes.id')
        ->join('partenaires', 'contrats.id_partenaire', '=', 'partenaires.id')
        ->join('clients', 'contrats.id_client', '=', 'clients.id')
        ->join('utilisateurs', 'contrats.id_utilisateur', '=', 'utilisateurs.id')
        ->where('clients.id', $id)
        ->get(['primes.*', 'utilisateurs.nom', 'partenaires.nom_partenaire',  'clients.nom_prenoms', 
        'contrats.numero_police', 'contrats.id_partenaire']);
    }

    public function EditPrime(Request $request)
    {
       
        $affected = DB::table('primes')
        ->where('id', '=', $request->id_prime)
        ->update([
            'prime_ht' => $request->prime_ht, 'prime_net' => $request->prime_net, 'acces_partenaire' => $request->partenaire, 
            'taxe' => $request->taxe, 'commission' => $request->commission, 'id_contrat' => $request->contrat, 
            'date_heure_encaiss' => $request->date_hr_encaiss, 'date_heurre_reverse' => $request->date_hr_reverse, 
       ]);

       return redirect('primes')->with('success', 'Modification effectué');
    }
}
