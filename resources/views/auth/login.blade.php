<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    @includeIf('layouts.adminlte.styles')
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Selamat datang kembai</p>

    @error('gagal_login')
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            {{ $message }}
        </div>
    @enderror

    <form action="{{ route('login.process') }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group d-flex justify-content-end">
          <label>
            <input type="checkbox" name="remember"> Remember Me
          </label>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
    
@includeIf('layouts.adminlte.scripts')
</body>
</html>