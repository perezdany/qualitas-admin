@extends('layouts/user_base')

@php
    use App\Http\Controllers\ContratController;
    use App\Http\Controllers\ClientController;
    use App\Http\Controllers\PartenaireController;

    $clientcontroller = new ClientController();

    $contratcontroller = new ContratController();

    $partenairecontroller = new PartenaireController();

    $all_partenaire = $partenairecontroller->GetAll();

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
                  <h3 class="box-title">LISTE DES PARTENAIRES</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Adresse</th>
                      <th>Afficher les contrats</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_partenaire as $all_partenaire)
                      <tr>
                          <td>{{$all_partenaire->nom_partenaire}}</td>
                          <td>{{$all_partenaire->nom_adresse}}</td>
                          <td>
                              <form action="go_contrat_partenaire" method="post">
                                @csrf
                                 <input type="text" value={{$all_partenaire->id}} style="display:none;" name="id_partenaire">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-eye"></i></button>
                              </form>
                          </td>
                          <td>
                                <form action="edit_partenaire_form" method="post">
                                    @csrf
                                    <input type="text" value={{$all_partenaire->id}} style="display:none;" name="id_partenaire">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                </form>

                                <form action="delete_partenaire" method="post">
                                    @csrf
                                    <input type="text" value={{$all_partenaire->id}} style="display:none;" name="id_partenaire">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                          </td>

                      </tr>
                    @endforeach

                    <tfoot>
                      <tr>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Afficher les contrats</th>
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
                <h3 class="box-title">AJOUTER UN PARTENAIRE</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="add_partenaire" method="post">
                    @csrf
                    <div class="box-body">
                     
                        <div class="form-group">
                            <label >Nom:</label>
                            <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" placeholder="NOM" 
                            name="nom" maxlength="60" required>
                        </div>
                       
                         <div class="form-group">
                            <label >Adresse:</label>
                            <input type="text" class="form-control"  placeholder="Adresse" 
                            name="adresse" maxlength="30" required>
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
                    
                    $edit = $partenairecontroller->GetPartenaireById($id_partenaire);
                @endphp

                @foreach($edit as $edit)
                <!-- general form elements -->
                  <div class="box box-qualitas">
                      <div class="box-header with-border">
                      <h3 class="box-title">MODIFIER UN CONTRAT</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->
                        <form role="form" action="edit_partenaire" method="post">
                            @csrf

                            <input type="text" value={{$edit->id}} style="display:none;" name="id_partenaire">
                            <div class="box-body">
                                
                                <div class="form-group">
                                    <label >Nom:</label>
                                    <input type="text" class="form-control" value={{$edit->nom_partenaire}} onkeyup="this.value=this.value.toUpperCase()" placeholder="NOM" 
                                    name="nom" maxlength="60" required>
                                </div>
                            
                                <div class="form-group">
                                    <label >Adresse:</label>
                                    <input type="text" class="form-control" value="{{$edit->adresse}}"  placeholder="Adresse" 
                                    name="adresse" maxlength="30">
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
