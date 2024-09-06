@extends('layouts/auth')

@section('content')

  <div class="login-box">
    <div class="login-logo">
      <a href=""><b>QUALITAS</b>ASSURANCE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Espace Admin - Veuillez vous connecter</p>

      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Login" name="login" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
         
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-qualitas btn-block btn-flat">Connexion</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    <br>
    <hr>
      
      <a href="#">J'ai oublié mon mot de passe</a><br>
      

    </div>
    <!-- /.login-box-body -->
  </div>
<!-- /.login-box -->
@endsection
