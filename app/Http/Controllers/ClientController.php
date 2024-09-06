<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

use DB;

class ClientController extends Controller
{
    //Handel Client

    public function AddClient(Request $request)
    {
        $Insert = Client::create([
            'nom_prenoms' => $request->titre.$request->name,
             'tel' => $request->tel, 
             'email' => $request->email, 
       ]);

       return redirect('clients')->with('success', 'Enregistrement effectué');
    }

    public function GetAll()
    {
        return Client::all();
    }

    public function EditClientForm(Request $request)
    {
        return view('user/clients',
        [
            'id_client' => $request->id_client,
            ]
        );
    }

    public function GetClientById($id)
    {
        $get = Client::where('id', $id)->get();

        return $get;
    }

    public function EditClient(Request $request)
    {   
        $affected = DB::table('clients')
        ->where('id', '=', $request->id_client)
        ->update([
            'nom_prenoms' => $request->name,
            'tel' => $request->tel, 
            'email' => $request->email, ]);

        return redirect('clients')->with('success', 'Modification Effectuée avec succès');
    }
}
