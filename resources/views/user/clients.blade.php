@extends('layouts/user_base')

@php
  use App\Http\Controllers\ClientController;


  $clientcontroller = new ClientController();

  $all_client = $clientcontroller->GetAll();

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
                  <h3 class="box-title">ASSURES</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nom & Prénoms</th>
                      <th>Contacts</th>
                      <th>Email</th>
                      <th>Assurances</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_client as $all_client)
                      <tr>  
                        <td>{{$all_client->nom_prenoms}}</td>
                         <td>{{$all_client->tel}}</td>
                          <td>{{$all_client->email}}</td>
                          <td>
                              <form action="display_client_contrats" method="post">
                                @csrf
                                <input type="text" value={{$all_client->id}} style="display:none;" name="id_client">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-eye"></i>AFFICHER</button>
                              </form>
                             
                          </td>
                          <td>
                              <form action="edit_client_form" method="post">
                                @csrf
                                <input type="text" value={{$all_client->id}} style="display:none;" name="id_client">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                              </form>
                               <form action="delete_client" method="post">
                                @csrf
                                <input type="text" value={{$all_client->id}} style="display:none;" name="id_client">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                              </form>
                          </td>
                        
                      </tr>
                    @endforeach
                     
                    <tfoot>
                       <th>Nom & Prénoms</th>
                      <th>Contacts</th>
                      <th>Email</th>
                       <th>Assurances</th>
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
                <h3 class="box-title">AJOUTER UN CLIENT</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="add_client" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Titre</label>
                            <select type="email" class="form-control" name="titre"  required>
                              <option>M.</option>
                              <option>Mme</option>
                              <option>Mlle</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nom & Prénom(s)</label>
                            <input type="text" class="form-control"  onkeyup="this.value=this.value.toUpperCase()" placeholder="Nom & Prénoms" name="name" maxlength="60" required>
                        </div>
                        <div class="form-group">
                            <label >Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" maxlength="60" required>
                        </div>
                        <div class="form-group">
                            <label >Téléphone</label>
                            <input type="text" class="form-control" placeholder="ex: 07895462014" name="tel" maxlength="30" required>
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
        @if(isset($id_client))
            <div class="col-md-6">
              @php

                $edit = $clientcontroller->GetClientById($id_client);
              @endphp

              @foreach($edit as $edit)
                <!-- general form elements -->
                  <div class="box box-qualitas">
                      <div class="box-header with-border">
                      <h3 class="box-title">MODIFIER UN CLIENT</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->
                      <form role="form" action="edit_client" method="post">
                          @csrf
                          <input type="text" value={{$edit->id}} style="display:none;" name="id_client">
                          <div class="box-body">
                              <div class="form-group">
                                  <label>Nom & Prénom(s)</label>
                                  <input type="text" class="form-control" value="{{$edit->nom_prenoms}}" onkeyup="this.value=this.value.toUpperCase()" placeholder="Nom & Prénoms" name="name" maxlength="60" required>
                              </div>
                              <div class="form-group">
                                  <label >Email</label>
                                  <input type="email" class="form-control" value="{{$edit->email}}" placeholder="Email" name="email" maxlength="60" required>
                              </div>
                              <div class="form-group">
                                  <label >Téléphone</label>
                                  <input type="text" class="form-control" value="{{$edit->tel}}" placeholder="ex: 07895462014" name="tel" maxlength="30" required>
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
