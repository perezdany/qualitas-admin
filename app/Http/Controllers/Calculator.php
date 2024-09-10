<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client; 
use App\Models\Contrat;
use App\Models\Prime;
use App\Models\Partenaire;

class Calculator extends Controller
{
    //Handle calculator

    public function TotalClient()
    {
        $n = Client::all()->count();

        return $n;
    }

    public function TotalContrat()
    {
        $n = Contrat::all()->count();

        return $n;
    }

    public function TotalPartenaire()
    {
        $n = Partenaire::all()->count();

        return $n;
    }

    public function TotalPrime()
    {
        $n = Prime::all()->count();

        return $n;
    }
}
