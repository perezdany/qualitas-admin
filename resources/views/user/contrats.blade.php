@extends('layouts/user_base')

@php
    use App\Http\Controllers\ContratController;
    use App\Http\Controllers\ClientController;
    use App\Http\Controllers\PartenaireController;

    $clientcontroller = new ClientController();

    $contratcontroller = new ContratController();

    $partenairecontroller = new PartenaireController();

    $all_contrat = $contratcontroller->GetAll();

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
                  <h3 class="box-title">LISTE DES CONTRATS</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Numéro de police</th>
                      <th>Durée Mois/Durée Ans</th>
                      <th>Partenaire</th>
                      <th>Numéro Assuré</th>
                      <th>Client</th>
                      <th>Date d'encaissement</th>
                      <th>Début de contrat</th>
                      <th>Date de versement</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_contrat as $all_contrat)
                      <tr>  
                        <td>{{$all_contrat->numero_police}}</td>
                        <td>{{$all_contrat->duree_mois}}/{{$all_contrat->duree_an}}</td>
                        <td>{{$all_contrat->nom_partenaire}}</td>
                        <td>{{$all_contrat->numero_assure}}</td>
                        <td>{{$all_contrat->nom_prenoms}}</td>
                        <td>{{$all_contrat->date_encaissement}}</td>
                        <td>{{$all_contrat->debut_contrat}}</td>
                        <td>{{$all_contrat->date_reversement}}</td>
                          <td>
                              <form action="edit_contrat_form" method="post">
                                @csrf
                                <input type="text" value={{$all_contrat->id}} style="display:none;" name="id_contrat">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                              </form>
                               <form action="delete_contrat" method="post">
                                @csrf
                                <input type="text" value={{$all_contrat->id}} style="display:none;" name="id_contrat">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                              </form>
                          </td>
                      
                      </tr>
                    @endforeach
                     
                    <tfoot>
                       <th>Numéro de police</th>
                      <th>Durée Mois/Durée Ans</th>
                      <th>Partenaire</th>
                      <th>Numéro Assuré</th>
                      <th>Client</th>
                      <th>Date d'encaissement</th>
                      <th>Début de contrat</th>
                      <th>Date de versement</th>
                      <th>Action</th>
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
                <h3 class="box-title">AJOUTER UN CONTRAT</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="add_contrat" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Selectionnez le client</label>
                            <select type="email" class="form-control" name="client"  required>
                                <option value="0">--Selectionnez--</option>
                                @php
                                    $les_clients = $clientcontroller->GetAll();
                                @endphp
                                @foreach($les_clients as $les_clients)
                                    <option value="{{$les_clients->id}}">{{$les_clients->nom_prenoms}}</option>
                                @endforeach
                              
                              
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Numéro de l'Assuré:</label>
                            <input type="text" class="form-control" placeholder="4504856" name="num_assure" maxlength="11" required>
                        </div>
                        <div class="form-group">
                            <label>Entreprise partenaire:</label>
                            <select type="email" class="form-control" name="partenaire"  required>
                                <option value="0">--Selectionnez--</option>
                                @php
                                    $les_partenaires = $partenairecontroller->GetAll();
                                @endphp
                                @foreach($les_partenaires as $les_partenaires)
                                    <option value="{{$les_partenaires->id}}">{{$les_partenaires->nom_partenaire}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Duée (An)</label>
                            <input type="number" class="form-control" name="duree_an" maxlength="11">
                        </div>
                        <div class="form-group">
                            <label>Durée (Mois)</label>
                            <input type="number" class="form-control" name="duree_mois" maxlength="11" required>
                        </div>
                        <div class="form-group">
                            <label>Numéro de police</label>
                            <input type="number" class="form-control" name="num_police" maxlength="11" required>
                        </div>
                        <div class="form-group">
                            <label >Date d'encaissement:</label>
                            <input type="date" class="form-control" name="date_encaissement"  required>
                        </div>
                       <div class="form-group">
                            <label >Début de contrat:</label>
                            <input type="date" class="form-control"  name="debut_contrat" required>
                        </div>
                        <div class="form-group">
                            <label >Date de reversement:</label>
                            <input type="date" class="form-control"  name="date_versement" required>
                        </div>
                        <!--<div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="exampleInputFile">
                        </div>-->
                    
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
        @if(isset($id_contrat))
            <div class="col-md-6">
                @php
                    
                    $edit = $contratcontroller->GetContratById($id_contrat);
                @endphp

                @foreach($edit as $edit)
                <!-- general form elements -->
                  <div class="box box-qualitas">
                      <div class="box-header with-border">
                      <h3 class="box-title">MODIFIER UN CONTRAT</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->
                        <form role="form" action="edit_contrat" method="post">
                            @csrf

                            <input type="text" value={{$edit->id}} style="display:none;" name="id_contrat">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Selectionnez le client</label>
                                    <select type="email" class="form-control" name="client"  required>
                                    
                                        @php
                                            $les_clients = $clientcontroller->GetAll();
                                        @endphp
                                        <option value="{{$edit->id_client}}">{{$edit->nom_prenoms}}</option>
                                        @foreach($les_clients as $les_clients)
                                            <option value="{{$les_clients->id}}">{{$les_clients->nom_prenoms}}</option>
                                        @endforeach
                                    
                                    
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Numéro de l'Assuré:</label>
                                    <input type="text" class="form-control" value={{$edit->numero_assure}} placeholder="4504856" name="num_assure" maxlength="11" required>
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
                                <div class="form-group">
                                <label>Duée (An)</label>
                                <input type="number" class="form-control" value={{$edit->duree_an}} name="duree_an" maxlength="11">
                                </div>
                                <div class="form-group">
                                    <label>Durée (Mois)</label>
                                    <input type="number" class="form-control" value={{$edit->duree_mois}} name="duree_mois" maxlength="11" required>
                                </div>
                                <div class="form-group">
                                    <label>Numéro de police</label>
                                    <input type="number" class="form-control" value={{$edit->numero_police}} name="num_police" maxlength="11" required>
                                </div>
                                <div class="form-group">
                                    <label >Date d'encaissement:</label>
                                    <input type="date" class="form-control" value={{$edit->date_encaissement}} name="date_encaissement"  required>
                                </div>
                            <div class="form-group">
                                    <label >Début de contrat:</label>
                                    <input type="date" class="form-control" value={{$edit->debut_contrat}} name="debut_contrat" required>
                                </div>
                                <div class="form-group">
                                    <label >Date de reversement:</label>
                                    <input type="date" class="form-control" value={{$edit->date_reversement}}  name="date_versement" required>
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <input type="file" id="exampleInputFile">
                                </div>-->
                            
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
