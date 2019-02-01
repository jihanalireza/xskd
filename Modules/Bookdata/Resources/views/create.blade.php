@extends('app.layouts')
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
<div class="clearfix"></div>
       <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="x_title">
               <h2>Tambah Data Buku</h2>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">
               <div class="row clearfix">
                     <form action="{{route('createBookdata.store')}}" method="post">
                     <div class="container-fluid">
                     @csrf
               <div class="col-md-6">
                   <label for="" class="control-label">Kode Buku</label>
                   <div class="form-group">
                       <input type="text" name="kd_buku" value="" class="form-control" placeholder="Masukan Kode Buku" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nama Buku</label>
                   <div class="form-group">
                       <input type="text" name="nama_buku" value="" class="form-control" placeholder="Masukan Nama Buku" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Jumlah Buku</label>
                   <div class="form-group">
                       <input type="number" min="0" name="stock" value="" class="form-control" placeholder="Masukan Jumlah Buku" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Penerbit Buku</label>
                   <div class="form-group">
                       <input type="text" name="penerbit" value="" class="form-control" placeholder="Masukan Nama Penerbit Buku" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Stock</label>
                   <div class="form-group">
                       <input type="number" min="0" name="stock" value="" class="form-control" placeholder="Masukan Jumblah Buku" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Penulis Buku</label>
                   <div class="form-group">
                       <input type="text" name="penulis" value="" class="form-control" placeholder="Masukan Nama Penerbit Buku" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Tahun Terbit</label>
                   <div class="form-group @if($errors->has('tahun_terbit')) has-error @endif">
                       <input type="text" readonly id="datepicker" name="tahun_terbit" value="" class="form-control" placeholder="Masukan Tahun Terbit Buku" required="" />
                       	@if($errors->has('tahun_terbit')) <span class="help-block">{{ $errors->first('tahun_terbit') }}</span> @endif
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nama Kelas</label>
                   <div class="form-group">
                     <select class="form-control" name="id_kelas" required="">
                       <option disabled selected value="">Kelas</option>
                       @foreach($kelas as $class)
                       <option value="{{$class->id_kelas}}">{{$class->nama_kelas}}</option>
                       @endforeach
                     </select>
               </div>
               </div>
               <div class="box-footer">
                 <div class="col-md-12">
                   <hr>
           			<a href="{{ route('indexBookdata') }}" type="button" class="btn btn-danger">Batal</a>
           			<button type="submit" class="btn btn-success pull-right">Simpan</button>
              </div>
           		</div>
                </div>
               </form>
             </div>
           </div>
         </div>
       </div>
         </div>
       </div>
@stop
@section('jsplus')
<script>
  $("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years"
  });
  </script>
@endsection
