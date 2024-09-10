@extends('layouts/user_base')

@php
    use App\Http\Controllers\ContratController;
    use App\Http\Controllers\ClientController;
    use App\Http\Controllers\PartenaireController;
    use App\Http\Controllers\PrimeController;



    $clientcontroller = new ClientController();

    $contratcontroller = new ContratController();

    $partenairecontroller = new PartenaireController();

    $primecontroller = new PrimeController();

    $all_prime = $primecontroller->GetAll();

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
                  <h3 class="box-title">LISTE DES PRIMES</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Prime Hors Taxe</th>
                      <th>Prime Net</th>
                      <th>Taxe</th>
                      <th>Contrat</th>
                      <th>Client</th>
                      <th>Date/Heure d'encaissement</th>
                      <th>Date/Heure de Reversement</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_prime as $all_prime)
                        <tr>
                            <td>{{$all_prime->prime_ht}}</td>
                            <td>{{$all_prime->prime_net}}</td>
                            <td>{{$all_prime->taxe}}</td>
                            <td>{{$all_prime->commission}}</td>
                            <td>{{$all_prime->nom_prenoms}}</td>
                            <td>{{$all_prime->date_heure_encaiss}}</td>
                            <td>{{$all_prime->date_heurre_reverse}}</td>
                            <td>
                                <form action="edit_prime_form" method="post">
                                    @csrf
                                    <input type="text" value={{$all_prime->id}} style="display:none;" name="id_prime">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                </form>

                                <form action="delete_prime" method="post">
                                    @csrf
                                    <input type="text" value={{$all_prime->id}} style="display:none;" name="id_prime">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach

                    <tfoot>
                      <tr>
                        <th>Prime Hors Taxe</th>
                        <th>Prime Net</th>
                        <th>Taxe</th>
                        <th>Contrat</th>
                        <th>Client</th>
                        <th>Date/Heure d'encaissement</th>
                        <th>Date/Heure de Reversement</th>
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
                <h3 class="box-title">AJOUTER UNE PRIME</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="add_prime" method="post">
                    @csrf
                    <div class="box-body">
                     
                        <div class="form-group">
                            <label >Prime Hors taxte:</label>
                            <input type="number" class="form-control" onkeyup="this.value=this.value.toUpperCase()"
                            name="prime_ht" maxlength="11" required>
                        </div>
                       
                        <div class="form-group">
                            <label >Prime net:</label>
                            <input type="number" class="form-control" 
                            name="prime_net" maxlength="11" required>
                        </div>
                        
                        <div class="form-group">
                            <label >Taxe :</label>
                            <input type="number" class="form-control"  
                            name="taxe" maxlength="11" required>
                        </div>

                        <div class="form-group">
                            <label >Commission :</label>
                            <input type="number" class="form-control" 
                            name="commission" maxlength="11" required>
                        </div>

                         <div class="form-group">
                            <label >Contrat :</label>
                            <select name="contrat"  class="form-control"  >
                                <option value="0">--Sélectionner--</option>
                                    @foreach($contrats as $contrats)
                                        <option value="{{$contrats->id}}">{{$contrats->nom_prenoms}}/numero de police: {{$contrats->numero_police}}</option>
                                    @endforeach
                            </select>
                          
                        </div>

                        <div class="form-group">
                            <label >Date et heure d'encaissement :</label>
                            <input type="datetime-local" class="form-control" name="date_hr_encaiss">
                        </div>

                         <div class="form-group">
                            <label >Date et heure de reversement :</label>
                            <input type="datetime-local" class="form-control" name="date_hr_reverse">
                        </div>

                        <div class="form-group">
                                    <label>Entreprise partenaire:</label>
                                    <select type="email" class="form-control" name="partenaire"  required>
                                    
                                        @php
                                            $les_partenaires = $partenairecontroller->GetAll();
                                        @endphp
                                       
                                        @foreach($les_partenaires as $les_partenaires)
                                            <option value="{{$les_partenaires->id}}">{{$les_partenaires->nom_partenaire}}</option>
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
        @if(isset($id_prime))
            <div class="col-md-6">
                @php
                    
                    $edit = $primecontroller->GetPrimeById($id_prime);
                @endphp

                @foreach($edit as $edit)
                <!-- general form elements -->
                    <div class="box box-qualitas">
                      <div class="box-header with-border">
                      <h3 class="box-title">MODIFIER UNE PRIME</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->
                       <form role="form" action="edit_prime" method="post">
                        @csrf
                        <input type="text" value={{$edit->id}} style="display:none;" name="id_prime">
                        <div class="box-body">
                        
                            <div class="form-group">
                                <label >Prime Hors taxte:</label>
                                <input type="number" value="{{$edit->prime_ht}}" class="form-control" onkeyup="this.value=this.value.toUpperCase()"
                                name="prime_ht" maxlength="11" required>
                            </div>
                        
                            <div class="form-group">
                                <label >Prime net:</label>
                                <input type="number" class="form-control" 
                                name="prime_net" value="{{$edit->prime_net}}" maxlength="11" required>
                            </div>
                            
                            <div class="form-group">
                                <label >Taxe :</label>
                                <input type="number" class="form-control"  
                                name="taxe" value="{{$edit->taxe}}" maxlength="11" required>
                            </div>

                            <div class="form-group">
                                <label >Commission :</label>
                                <input type="number" class="form-control" 
                                name="commission" value="{{$edit->commission}}" maxlength="11" required>
                            </div>

                            <div class="form-group">
                                <label >Contrat :</label>
                                <select name="contrat"  class="form-control"  >
                                    @php
                                        $contrats = $contratcontroller->GetAll();
                                    @endphp
                                   
                                    <option value="{{$edit->id_contrat}}">{{$edit->nom_prenoms}}/numero de police: {{$edit->numero_police}}</option>
                                        @foreach($contrats as $contrats)
                                            <option value="{{$contrats->id}}">{{$contrats->nom_prenoms}}/numero de police: {{$contrats->numero_police}}</option>
                                        @endforeach
                                </select>
                            
                            </div>

                            <div class="form-group">
                                <label >Date et heure d'encaissement :</label>
                                <input type="datetime-local" class="form-control" name="date_hr_encaiss" value="{{$edit->date_heure_encaiss}}">
                            </div>

                            <div class="form-group">
                                <label >Date et heure de reversement :</label>
                                <input type="datetime-local" class="form-control" name="date_hr_reverse" value="{{$edit->date_heurre_reverse}}">
                            </div>

                            <div class="form-group">
                                <label>Entreprise partenaire:</label>
                                <select type="email" class="form-control" name="partenaire"  required>
                                
                                    @php
                                        $les_partenaires = $partenairecontroller->GetAll();
                                    @endphp
                                    <option value="{{$edit->id_partenaire}}">{{$edit->nom_partenaire}}</option>
                                    @foreach($les_partenaires as $les_partenaires)
                                        <option value="{{$les_partenaires->id}}">{{$les_partenaires->nom_partenaire}}</option>
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
