@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Ubah Data Mata Pelajaran
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Ubah Data Mata Pelajaran</a></li>
    </ol>
  </section>
@endsection
@section('content')
  <div class="box box-default">
  	<div class="box-header with-border">
  		<h3 class="box-title">Update Data Mata Pelajaran</h3>
  	</div>
    <form class="" action="{{route('updatelesson',$datalesson->id_mapel)}}" method="post">
  	<div class="box-body">
  		<div class="row">
  			<div class="col-md-12">
  				<div class="form-group">
            <label for="nama_mapel">Nama Mata Pelajaran</label>
            <input type="text" name="nama_mapel" class="form-control" value="{{ $datalesson->nama_mapel }}">
  				</div>
  			</div>
  		</div>
  		<div class="box-footer">
        @csrf @method('PATCH')
        <a href="{{route('index.lesson')}}" class="btn btn-danger btn-3d" style="float:left" title="Batal">Batal</a>
        <button type="submit" class="btn btn-success btn-3d" style="float:right" title="Simpan" name="button">Simpan</button>
  		</div>
  	</div>
  </form>
  </div>
@stop
