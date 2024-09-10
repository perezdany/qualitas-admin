@extends('layouts/user_base')

@php
    use App\Http\Controllers\ContratController;
    use App\Http\Controllers\ClientController;
    use App\Http\Controllers\PartenaireController;
    use App\Http\Controllers\Calculator;

    $clientcontroller = new ClientController();

    $contratcontroller = new ContratController();

    $partenairecontroller = new PartenaireController();

    $calculator = new Calculator();

    $all_partenaire = $partenairecontroller->GetAll();

@endphp

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              @php
                $total_c = $calculator->TotalContrat();
              @endphp

              <h3>{{$total_c}}</h3>

              <p>Contrats</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
           
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              @php
                $total_c = $calculator->TotalClient();
              @endphp

              <h3>{{$total_c}}</h3>

              <p>Clients</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
           
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
                @php
                $total_p = $calculator->TotalPartenaire();
              @endphp

              <h3>{{$total_p}}</h3>

              <p>Partenaires</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              @php
                $total_p = $calculator->TotalPrime();
              @endphp

              <h3>{{$total_p}}</h3>

              <p>Primes</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
  
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">PARTENAIRES</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Adresse</th>
                      <th>Afficher les contrats</th>
                      
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

                      </tr>
                    @endforeach

                    <tfoot>
                      <tr>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Afficher les contrats</th>
                     
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
@endsection
