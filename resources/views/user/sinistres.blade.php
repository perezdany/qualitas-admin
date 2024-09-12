@extends('layouts/user_base')

@php
    use App\Http\Controllers\ContratController;
    use App\Http\Controllers\ClientController;
    use App\Http\Controllers\PartenaireController;
    use App\Http\Controllers\PrimeController;
    use App\Http\Controllers\ReglementController;
    use App\Http\Controllers\SinistreController;


    $clientcontroller = new ClientController();

    $contratcontroller = new ContratController();

    $partenairecontroller = new PartenaireController();

    $primecontroller = new PrimeController();

    $regelementcontroller = new ReglementController();

    $sinistrecontroller = new SinistreController();

    $all_sinistre = $sinistrecontroller->GetAll();

    $contrats = $contratcontroller->GetAll();


@endphp

@section('content')
   
    <!-- /.row -->

    <div class="row">
         @if(session('success'))
            <div class="col-md-12 box-header">
              <p class="bg-success" style="font-size:13px;">{{session('success')}}</p>
            </div>
          @endif

            @if(session('error'))
            <div class="col-md-12 box-header" style="font-size:13px;">
              <p class="bg-danger" >{{session('error')}}</p>
            </div>
        @endif
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">LES SINISTRES</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Date d'enregistrement</th>
                      <th>Numéro de l'enregistrement</th>
                      <th>Numéro de police</th>
                      <th>Client</th>
                      <th>Catégorie</th>
                      <th>Date d'évènement</th>
                      <th>Victime</th>
                      <th>Montant</th>
                       <th>Etat</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_sinistre as $all_sinistre)
                        <tr>
                            <td>{{$all_sinistre->date_enregistrement}}</td>
                            <td>{{$all_sinistre->numero_enregistrement}}</td>
                            <td>{{$all_sinistre->numero_police}}</td>
                            <td>{{$all_sinistre->nom_prenoms}}</td>
                            <td>{{$all_sinistre->designation}}</td>
                            <td>{{$all_sinistre->date_evenement}}</td>
                            <td>{{$all_sinistre->victime}}</td>
                            <td>{{$all_sinistre->montant_sinistre}}</td>
                             <td></td>
                            <td>
                                <form action="edit_reglement_form" method="post">
                                    @csrf
                                    <input type="text" value={{$all_sinistre->id}} style="display:none;" name="id_reglement">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                </form>

                                <form action="delete_regelement" method="post">
                                    @csrf
                                    <input type="text" value={{$all_sinistre->id}} style="display:none;" name="id_reglement">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach

                    <tfoot>
                      <tr>
                         <th>Date d'enregistrement</th>
                        <th>Numéro de l'enregistrement</th>
                        <th>Numéro de police</th>
                        <th>Client</th>
                        <th>Catégorie</th>
                        <th>Date d'évènement</th>
                        <th>Victime</th>
                        <th>Montant</th>
                    
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

   <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-qualitas">
                <div class="box-header with-border">
                <h3 class="box-title">ENREGISTRER UN SINISTRE</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="add_reglement" method="post">
                    @csrf
                    <div class="box-body">
                     
                        
                        <div class="form-group">
                            <label >Montant :</label>
                            <input type="number" class="form-control" 
                            name="montant" maxlength="11" required>
                        </div>
                
                    
                        <div class="form-group">
                            <label >Catégorie :</label>
                            <select name="categorie"  class="form-control"  >
                                @php
                                    $les_primes = $primecontroller->GetAll();
                                @endphp
                                
                                    @foreach($les_primes as $les_primes)
                                        <option value="{{$les_primes->id}}">{{$les_primes->nom_prenoms}}/numero de police: {{$les_primes->numero_police}}</option>
                                    @endforeach
                            </select>
                        
                        </div>

                        <div class="form-group">
                            <label >Date de l'évènement:</label>
                            <input type="date" class="form-control" 
                            name="date_evenement" required>
                        </div>
                        
                        <div class="form-group">
                            <label >Nom de la victime:</label>
                            <input type="date" class="form-control" 
                            name="victime"  required>
                        </div>

                        <div class="form-group">
                            <label >Montant :</label>
                            <input type="date" class="form-control" 
                            name="montant" required>
                        </div>
                                
                            
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">VALIDER</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (left) -->
        @if(isset($id_partenaire))
            <div class="col-md-6">
                @php
                    $edit = $reglementcontroller->GetReglementById($id_reglement);
                @endphp

                @foreach($edit as $edit)
                <!-- general form elements -->
                    <div class="box box-qualitas">
                        <div class="box-header with-border">
                        <h3 class="box-title">MODIFICATION</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <form role="form" action="edit_reglement" method="post">
                            @csrf
                            <div class="box-body">
                            
                                <div class="form-group">
                                    <label >Montant :</label>
                                    <input type="number" class="form-control" value="{{$edit->montant}}"
                                    name="montant" maxlength="11" required>
                                </div>
                        
                            
                                <div class="form-group">
                                    <label >Catégorie :</label>
                                    <select name="categorie"  class="form-control"  >
                                        @php
                                            $les_primes = $primecontroller->GetAll();
                                        @endphp
                                        <option value="{{$edit->id_prime}}">{{$edit->nom_prenoms}}/numero de police: {{$edit->numero_police}}</option>
                                            @foreach($les_primes as $les_primes)
                                                <option value="{{$les_primes->id}}">{{$les_primes->nom_prenoms}}/numero de police: {{$les_primes->numero_police}}</option>
                                            @endforeach
                                    </select>
                                
                                </div>

                                <div class="form-group">
                                    <label >Date de l'évènement:</label>
                                    <input type="date" class="form-control" 
                                    name="date_evenement" value="{{$edit->date_reglement}}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label >Nom de la victime:</label>
                                    <input type="date" class="form-control" 
                                    name="victime" value="{{$edit->date_reglement}}" required>
                                </div>

                                <div class="form-group">
                                    <label >Montant :</label>
                                    <input type="date" class="form-control" 
                                    name="montant" value="{{$edit->date_reglement}}" required>
                                </div>
                                
                            
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">VALIDER</button>
                            </div>
                        </form>
                    
                    </div>
                <!-- /.box -->
              @endforeach
              
          </div>
        @endif
      
       
      </div>
@endsection
