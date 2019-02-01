@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Ubah Data Guru
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Ubah Data Guru</a></li>
    </ol>
  </section>
@endsection
@section('content')
<div class="box">
      <div class="box-header with-border">
        <h2 class="box-title">Update Data Guru</h2>
      </div>
      <div class="box-body">
        <form action="{{ route('updateTeacherdata',['id'=>$dataTheacher->id_guru]) }}" method="post" enctype="multipart/form-data">
          @csrf @method('patch')
          <div class="col-md-6">
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <img src="{{ env('API_URL') }}/{{ $dataTheacher->foto }}" alt="" style="width:200px; height:207px;">
                <input type="hidden" name="imagedefault" value="{{ $dataTheacher->foto }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Ganti Foto</label>
                <input type="file" class="" name="image" >
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group @if($errors->has('name')) has-error @endif">
            <label>Nama</label>
            <input type="text" class="form-control" name="name" value="{{ $dataTheacher->nama_guru }}">
            @if($errors->has('name')) <span class="help-block">{{ $errors->first('name') }}</span> @endif
          </div>
          <div class="form-group @if($errors->has('email')) has-error @endif">
            <label for="">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $dataTheacher->email }}">
                @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span> @endif
          </div>
          <div class="form-group @if($errors->has('phonenumber')) has-error @endif">
            <label>No Telepon</label>
            <input type="number" min="0" class="form-control" name="phonenumber" value="{{ $dataTheacher->nomor_tlp }}">
            @if($errors->has('phonenumber')) <span class="help-block">{{ $errors->first('phonenumber') }}</span> @endif
          </div>
          <div class="form-group @if($errors->has('address')) has-error @endif">
            <label>Alamat</label>
            <textarea type="text" name="address" class="form-control" >{{ $dataTheacher->alamat }}</textarea>
            @if($errors->has('address')) <span class="help-block">{{ $errors->first('address') }}</span> @endif
          </div>
        </div><hr>
      </div>
      <div class="box-footer">
        <a href="{{ route('indexTeacherdata') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success pull-right">Simpan</button>
      </div>
    </form>
    </div>
@stop
