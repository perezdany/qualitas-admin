<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Partenaire;

class PartenaireController extends Controller
{
    //Handle Partenaire

    public function GetAll()
    {
        return Partenaire::all();
    }
}
