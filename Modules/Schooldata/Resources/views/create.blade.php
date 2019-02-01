@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Tambah Data Sekolah
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Tambah Data Sekolah</a></li>
    </ol>
  </section>
@endsection
@section('content')

<div class="box box-default">
	<div class="box-header with-border">
		<h2 class="box-title">Tambah Data Sekolah</h2>
	</div>
	<form action="{{route('school.save')}}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group @if($errors->has('nama_sekolah')) has-error @endif">
						<label>Nama Sekolah</label>
						<input type="text" class="form-control" name="nama_sekolah" value="{{ old('nama_sekolah') }}">
						@if($errors->has('nama_sekolah')) <span class="help-block">{{ $errors->first('nama_sekolah') }}</span> @endif
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
					<div class="form-group @if($errors->has('nomor_tlp')) has-error @endif">
						<label>Nomor Telepon</label>
						<input type="number" class="form-control" name="nomor_tlp" value="{{ old('nomor_tlp') }}">
						@if($errors->has('nomor_tlp')) <span class="help-block">{{ $errors->first('nomor_tlp') }}</span> @endif
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group @if($errors->has('logo')) has-error @endif">
						<label>Logo</label>
						<input type="file" class="form-control" name="logo" >
						@if($errors->has('logo')) <span class="help-block">{{ $errors->first('logo') }}</span> @endif
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<div class="box-footer">
			<a href="{{ route('indexSchooldata') }}" type="button" class="btn btn-danger">Batal</a>
			<button type="submit" class="btn btn-success pull-right">Simpan</button>
		</div>
	</form>
	<!-- /.box-footer -->
</div>
@endsection
