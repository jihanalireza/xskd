@extends('authentication::layouts.master')
@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Sistem</b> Akademik</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register Form</p>

    <form action="{{ route('register.store')}}" method="post">
      @csrf
      <div class="form-group has-feedback @if($errors->has('nama_sekolah')) has-error @endif">
          <select name="nama_sekolah" class="js-data-example-ajax form-control" placeholder="Nama Sekolah" >
              <option value="">- pilih sekolah -</option>
          </select>
          @if($errors->has('nama_sekolah')) <span class="help-block">{{ $errors->first('nama_sekolah') }}</span> @endif
      </div>
      <div class="form-group has-feedback @if($errors->has('email')) has-error @endif">
        <input name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
         @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span> @endif
      </div>
      <div class="form-group has-feedback @if($errors->has('password')) has-error @endif">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         @if($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span> @endif
      </div>
      <div class="form-group has-feedback @if($errors->has('level')) has-error @endif">
        <select id="access" name="level" class="form-control">
        <option value="" selected>- pilih akses -</option>
          @foreach($level as $item)
            <option value="{{$item->id_role}}">{{$item->level}}</option>
          @endforeach
        </select>
         @if($errors->has('level')) <span class="help-block">{{ $errors->first('level') }}</span> @endif
      </div>
      <div id="siswa" class="form-group has-feedback @if($errors->has('nama_siswa')) has-error @endif">
        <select  name="nama_siswa" class="js-data-example1-ajax form-control" placeholder="Nama Siswa" >
            <option value="">- pilih siswa -</option>
        </select>
        @if($errors->has('nama_siswa')) <span class="help-block">{{ $errors->first('nama_siswa') }}</span> @endif
      </div>
      <div id="guru" class="form-group has-feedback @if($errors->has('nama_guru')) has-error @endif">
        <select  name="nama_guru" class="js-data-example2-ajax form-control" placeholder="Nama Guru" >
            <option value="">- pilih guru -</option>
        </select>
        @if($errors->has('nama_guru')) <span class="help-block">{{ $errors->first('nama_guru') }}</span> @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="{{ route('login.form') }}" class="text-center">I already have a account</a>
  </div>
  <!-- /.form-box -->
</div>
@endsection
@section('jsplus')
<script>
$('document').ready(function(){
  $('#siswa').hide();
  $('#guru').hide();
  $('#access').change(function(){
    $('.js-data-example1-ajax').hide();
    var access = $('#access').val();
    if(access==1){
      console.log('admin')
    }else if(access == 2){
      console.log('keuangan')
    }else if(access == 3){
      console.log('perpus')
    }else if(access == 4){
      $('#siswa').show();
      $('#guru').hide();
    }else if(access == 5){
      $('#guru').show();
      $('#siswa').hide();
    }else{
      return false;
    }
  })
  //select2 custom value
  $(".js-data-example-ajax").select2({
      minimumInputLength: 2,
      allowClear:true,
      placeholder: 'masukkan nama sekolah',
      tags: [],
      ajax: {
          url: "{{env('API_URL')}}/sekolah",
          dataType: 'json',
          type: "GET",
          quietMillis: 50,
          data: function (term) {
              return {
                  'nama_sekolah[$like]': term.term+'%'
              };
          },
          processResults: function (data, page) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.nama_sekolah,
                        id: item.id_sekolah
                    }
                })
            };
          },
        }
    })
    $(".js-data-example1-ajax").select2({
      minimumInputLength: 2,
      allowClear:true,
      placeholder: 'masukkan nama siswa',
      tags: [],
      ajax: {
          url: "{{env('API_URL')}}/siswa",
          dataType: 'json',
          type: "GET",
          quietMillis: 50,
          data: function (term) {
              return {
                  'nama_siswa[$like]': term.term+'%'
              };
          },
          processResults: function (data, page) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.nama_siswa,
                        id: item.id_siswa
                    }
                })
            };
          },
        }
    })
    $(".js-data-example2-ajax").select2({
      minimumInputLength: 2,
      allowClear:true,
      placeholder: 'masukkan nama guru',
      tags: [],
      ajax: {
          url: "{{env('API_URL')}}/guru",
          dataType: 'json',
          type: "GET",
          quietMillis: 50,
          data: function (term) {
              return {
                  'nama_guru[$like]': term.term+'%'
              };
          },
          processResults: function (data, page) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.nama_guru,
                        id: item.id_guru
                    }
                })
            };
          },
        }
    })
});

</script>
@endsection
