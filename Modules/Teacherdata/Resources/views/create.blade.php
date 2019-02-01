@extends('app.layouts')
@extends('teacherdata::additional')
@section('contentheader')
<section class="content-header">
    <h1>
      Tambah Data Guru
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Tambah Data Guru</a></li>
    </ol>
  </section>
@endsection
@section('content')

<div class="box box-default">
	<div class="box-header with-border">
		<h2 class="box-title"> Tambah Data Guru</h2>
	</div>
	<form action="{{ route('storeTeacherdata') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group @if($errors->has('nama_guru')) has-error @endif">
						<label>Nama Guru</label>
						<input type="text" class="form-control" name="nama_guru" value="{{ old('nama_guru') }}">
						@if($errors->has('nama_guru')) <span class="help-block">{{ $errors->first('nama_guru') }}</span> @endif
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group @if($errors->has('alamat')) has-error @endif">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat" value="{{ old('alamat') }}"></textarea>
						@if($errors->has('alamat')) <span class="help-block">{{ $errors->first('alamat') }}</span> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group @if($errors->has('email')) has-error @endif">
						<label>Email</label>
						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						@if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span> @endif
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group @if($errors->has('nomor_telepon')) has-error @endif">
						<label>Nomor Telepon</label>
						<input type="number" min="0" class="form-control" name="nomor_telepon" value="{{ old('nomor_telepon') }}">
						@if($errors->has('nomor_telepon')) <span class="help-block">{{ $errors->first('nomor_telepon') }}</span> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group @if($errors->has('foto')) has-error @endif">
						<label>Foto</label>
						<input type="file" class="form-control" name="foto" >
						@if($errors->has('foto')) <span class="help-block">{{ $errors->first('foto') }}</span> @endif
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<div class="box-footer">
			<a href="{{ route('indexTeacherdata') }}" type="button" class="btn btn-danger">Batal</a>
			<button type="submit" class="btn btn-success pull-right">Simpan</button>
		</div>
	</form>
	<!-- /.box-footer -->
</div>
@endsection
