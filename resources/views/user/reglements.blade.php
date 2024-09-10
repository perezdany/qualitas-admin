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

    $all_reglement = $regelementcontroller->GetAll();

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
                  <h3 class="box-title">LISTE DES REGLEMENTS</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Montant</th>
                      <th>Date de règlement</th>
                      <th>Prime net</th>
                      <th>Montant du sinistre</th>
                    
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_reglement as $all_reglement)
                        <tr>
                            <td>{{$all_reglement->montant}}</td>
                            <td>{{$all_reglement->date_reglement}}</td>
                            <td>{{$all_reglement->prime_net}}</td>
                            <td>{{$all_reglement->montant_sinistre}}</td>
                            
                            <td>
                                <form action="edit_reglement_form" method="post">
                                    @csrf
                                    <input type="text" value={{$all_reglement->id}} style="display:none;" name="id_reglement">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                </form>

                                <form action="delete_regelement" method="post">
                                    @csrf
                                    <input type="text" value={{$all_reglement->id}} style="display:none;" name="id_reglement">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach

                    <tfoot>
                      <tr>
                         <th>Montant</th>
                      <th>Date de règlement</th>
                      <th>Prime net</th>
                      <th>Montant du sinistre</th>
                    
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
                <h3 class="box-title">ENREGISTRER UN REGLEMENT</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="add_reglement" method="post">
                    @csrf
                    <div class="box-body">
                     
                        <div class="form-group">
                            <label >Montant :</label>
                            <input type="number" class="form-control" onkeyup="this.value=this.value.toUpperCase()"
                            name="montant" maxlength="11" required>
                        </div>
                       
                        <div class="form-group">
                            <label >Date de règlement:</label>
                            <input type="date" class="form-control" 
                            name="date_reglement"  required>
                        </div>
                        
                      
                         <div class="form-group">
                            <label >Prime : Selectionner si il s'agit d'une prime</label>
                            <select name="prime"  class="form-control"  >
                                @php
                                    $les_primes = $primecontroller->PrimeNonReglee();
                                @endphp
                                <option value="null">--Sélectionner--</option>
                                    @foreach($les_primes as $les_primes)
                                        <option value="{{$les_primes->id}}">{{$les_primes->nom_prenoms}}/numero de police: {{$les_primes->numero_police}}</option>
                                    @endforeach
                            </select>
                          
                        </div>

                        
                        <div class="form-group">
                            <label>Selectionner s'il s'agit d'un sinistre:</label>
                            <select  class="form-control" name="sinistre"  required>
                            
                                @php
                                    $les_sinistres = $sinistrecontroller->SinistreNonRegle();
                                @endphp
                                <option value="null">--Sélectionner--</option>
                                @foreach($les_sinistres as $les_sinistres)
                                    <option value="{{$les_sinistres->id}}">{{$les_sinistres->nom_prenoms}}</option>
                                @endforeach

                            </select>
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
                                    <label >Date de règlement:</label>
                                    <input type="date" class="form-control" 
                                    name="date_reglement" value="{{$edit->date_reglement}}" required>
                                </div>
                                
                            
                                <div class="form-group">
                                    <label >Prime : Selectionner si il s'agit d'une prime</label>
                                    <select name="contrat"  class="form-control"  >
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
                                    <label>Selectionner s'il s'agit d'un sinistre:</label>
                                    <select type="email" class="form-control" name="partenaire"  required>
                                    
                                        @php
                                            $les_sinistres = $sinistrecontroller->GetAll();
                                        @endphp
                                        <option value="null">--Sélectionner--</option>
                                        @foreach($les_sinistres as $les_sinistres)
                                            <option value="{{$les_sinistres->id}}">{{$les_sinistres->nom_prenoms}}</option>
                                        @endforeach

                                    </select>
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
