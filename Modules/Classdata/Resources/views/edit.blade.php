@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Ubah Data Kelas
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Ubah Data Kelas</a></li>
    </ol>
  </section>
@endsection
@section('content')
  <div class="box box-default">
  	<div class="box-header with-border">
  		<h2 class="box-title">Update Data Kelas</h2>
  	</div>
    <form class="" action="{{route('updateClassdata',$Classdata->id_kelas)}}" method="post">
  	<div class="box-body">
  		<div class="row">
  			<div class="col-md-12">
  				<div class="form-group">
            <label for="nama_mapel">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" value="{{ $Classdata->nama_kelas }}">
  				</div>
  			</div>
  		</div>
  		<div class="box-footer">
        @csrf @method('PATCH')
        <a href="{{route('indexClassdata')}}" class="btn btn-danger btn-3d" style="float:left" title="Batal">Batal</a>
        <button type="submit" class="btn btn-success btn-3d" style="float:right" title="Simpan">Simpan</button>
  		</div>
  	</div>
  </form>
  </div>
@stop
