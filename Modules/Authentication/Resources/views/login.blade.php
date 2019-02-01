@extends('authentication::layouts.master')
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>Sistem</b> Akademik</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    @if (Session('sendSuccess'))
     <div class="alert alert-success" role="alert">
         <strong>Suksess!</strong> Cek Email Anda untuk lanjut reset password.
     </div>
     <?php Session('sendSuccess');?>
    @endif
    @if (Session('resetSuccess'))
     <div class="alert alert-success" role="alert">
         <strong>Suksess!</strong> Password telah Diubah.
     </div>
     <?php Session('resetSuccess');?>
    @endif
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('login.store') }}" method="post">
      @csrf

      <div class="form-group has-feedback @if($errors->has('email')) has-error @endif">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span> @endif
      </div>
      <div class="form-group has-feedback @if($errors->has('password')) has-error @endif">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span> @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="{{ route('forgotpassword.form') }}" class="text-center">I forgot my password</a><br>
    <a href="{{ route('register.form') }}" class="text-center">Register a new account</a>

  </div>
  <!-- /.login-box-body -->
</div>
@endsection
