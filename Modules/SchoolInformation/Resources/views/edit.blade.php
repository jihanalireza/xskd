@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Ubah Informasi Sekolah
    </h1>
    <ol class="breadcrumb">
      <li  class="active"><a href="#"><i class="fa fa-university"></i> Ubah Informasi Sekolah</a></li>
    </ol>
  </section>
@endsection
@section('content')
  <div class="box box-default">
  	<div class="box-header with-border">
  		<h3 class="box-title">Update Data Informasi Sekolah</h3>
  	</div>
    <form class="" action="{{route('SchoolInformation.update' , ['id' => $informasisekolah->id_informasi])}}" method="post">
    @csrf @method('PATCH')
  	<div class="box-body">
  		<div class="row">
  			<div class="col-md-12">
  				<div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{$informasisekolah->judul }}" required>
  				</div>
  			</div>
  			<div class="col-md-12">
  				<div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="5" required>{{$informasisekolah->deskripsi }}</textarea>
        </div>
  			</div>
  		</div>
  		<div class="box-footer">
        <a href="{{route('SchoolInformation.index')}}" class="btn btn-danger btn-3d" style="float:left" title="Batal">Batal</a>
        <button type="submit" class="btn btn-success btn-3d" style="float:right" title="Simpan">Simpan</button>
  		</div>
  	</div>
  </form>
  </div>
@stop
@section('jsplus')
<script>
  $(document).ready(function(){
		$('.timepicker').timepicker({
      showInputs: false
    })
	})
  function converthours(Hours){
   let hasil = moment(Hours, "h:mm A").format("HH:mm");
   return hasil;
  }
</script>
@endsection
