<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContratController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');


/*---------------*/
//ESPACE UTILISATEUR

Route::middleware(['auth:user'])->group(function(){

    //ACCUEIL
    Route::get('welcome', function () {
        return view('welcome');
    })->name('welcome');

    //CLIENTS
    Route::get('clients', function () {
        return view('user/clients');
    });

    //LES CONTRATS
    Route::get('contrats', function () {
        return view('user/contrats');
    });

    //AJOUTER UN CONTRAT
    Route::post('add_contrat', [ContratController::class, 'AddContrat']);
    
    //MODIDIER UN CONTRAT
    Route::post('edit_contrat_form', [ContratController::class, 'EditContratForm']);
    Route::post('edit_contrat', [ContratController::class, 'EditContrat']);
    
    //DECONNEXION
    Route::get('logoutuser', [AuthController::class, 'logoutUser']);

    //AJOUTER UN CLIENT
    Route::post('add_client', [ClientController::class, 'AddClient']);

    //MODIFIER UN CLIEN
    Route::post('edit_client_form', [ClientController::class, 'EditClientForm']);
    Route::post('edit_client', [ClientController::class, 'EditClient']);



});


Route::middleware(['guest:user'])->group(function(){

   Route::get('/', function () {
         return view('login');
    })->name('login');


   //CONNEXION
    Route::post('go_login', [AuthController::class, 'LoginUser']);

    Route::post('login_code', [AuthController::class, 'LoginCodeUser']);

    
});




/*----------------*/

//ESPACE ADMIN

Route::middleware(['auth:admin'])->group(function(){

   Route::get('dash', function () {
         return view('admin/admin_dashboard');
    })->name('dash');
});


Route::middleware(['guest:admin'])->group(function(){

   Route::get('admin', function () {
         return view('admin/login_admin');
    })->name('loginAdmin');

    Route::get('logoutadmin', [AuthController::class, 'logoutAdmin']);

});




