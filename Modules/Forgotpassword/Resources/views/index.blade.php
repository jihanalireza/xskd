@extends('authentication::layouts.master')
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>Sistem</b> Akademik</a>
  </div>
  <!-- /.login-logo -->
  @if (Session('failed'))
   <div class="alert alert-danger" role="alert">
       <strong>Failed!</strong> Mohon maaf Email Anda Belum terdaftar sebelumnya.
   </div>
   <?php Session('failed');?>
  @endif
  <div class="login-box-body">
    <p class="login-box-msg">Reset Password</p>

    <form action="{{ route('forgotpassword.sendmail') }}" method="post">
      @csrf

      <div class="form-group has-feedback @if($errors->has('email')) has-error @endif">
        <input type="email" class="form-control" placeholder="Your Email" name="email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span> @endif
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <a href="{{ route('login.form') }}" class="btn btn-default">Batal</a>
          <button type="submit" class="btn btn-primary pull-right">send Password reset link</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
@endsection
