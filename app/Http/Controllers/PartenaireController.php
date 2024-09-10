<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Partenaire;
use DB;

class PartenaireController extends Controller
{
    //Handle Partenaire

    public function GetAll()
    {
        return Partenaire::all();
    }

    public function AddPartenaire(Request $request)
    {
        $Insert = Contrat::create([
           'nom_partenaire' => $request->nom, 'adresse' => $request->adresse, 
       ]);

       return redirect('partenaires')->with('success', 'Enregistrement effectué');
    }

    public function EditPartenaireForm(Request $request)
    {
        return view('user/partenaires',
            [
                'id_partenaire' => $request->id_partenaire,
            ]
        );

    }

    public function EditPartenaire(Request $request)
    {
        
        $affected = DB::table('partenaires')
        ->where('id', '=', $request->id_partenaire)
        ->update([
            'nom_partenaire' => $request->nom, 'adresse' => $request->adresse, 
       ]);

       return redirect('partenaires')->with('success', 'Modification effectué');
    }

    public function GetPartenaireById($id)
    {
        $get = DB::table('partenaires')
        ->where('id', $id)
        ->get();

        return $get;
    }

    public function DeletePartenaire($id)
    {
        $deleted = DB::table('partenaires')->where('id', '=', $request->id_partenaire)->delete();

        //var_dump($deleted);
        return redirect('partenaires')->with('success', 'Suppression effectuée');
    }
}
