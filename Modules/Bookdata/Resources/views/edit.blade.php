@extends('app.layouts')
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
<div class="clearfix"></div>
       <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="x_title">
               <h2>Update Data Buku</h2>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">
               <div class="row clearfix">
                     <form action="{{route('update_buku')}}" method="post">
                     <div class="container-fluid">
                     @csrf
                     <input type="hidden" name="id_buku" value="{{ $databuku->id_buku }}" />
               <div class="col-md-6">
                   <label for="" class="control-label">Kode Buku</label>
                   <div class="form-group">
                       <input type="text" name="kd_buku" readonly value="{{ $databuku->kd_buku }}" class="form-control" placeholder="Masukan Kode Buku" required="true" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nama Buku</label>
                   <div class="form-group">
                       <input type="text" name="nama_buku" value="{{ $databuku->nama_buku }}" class="form-control" placeholder="Masukan Nama Buku" required="true" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Penerbit Buku</label>
                   <div class="form-group">
                       <input type="text" name="penerbit" value="{{ $databuku->penerbit }}" class="form-control" placeholder="Masukan Nama Penerbit Buku" required="true" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Penulis Buku</label>
                   <div class="form-group">
                       <input type="text" name="penulis" value="{{ $databuku->penulis }}" class="form-control" placeholder="Masukan Nama Penerbit Buku" required="true" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Tahun Terbit</label>
                   <div class="form-group">
                       <input type="text" readonly id="datepicker" name="tahun_terbit" value="{{ $databuku->tahun_terbit }}" class="form-control" placeholder="Masukan Tahun Terbit Buku" required="true" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nama Kelas</label>
                   <div class="form-group">
                     <select class="form-control" name="id_kelas" required="true">
                       <option selected value="{{ $databuku->id_kelas }}">{{ $databuku->kela->nama_kelas }}</option>
                       @forelse($datakelas as $show)
                       <option value="{{ $show->id_kelas }}">{{ $show->nama_kelas }}</option>
                       @empty
                       <option value="">Data Kelas Kosong</option>
                       @endforelse
                     </select>
                   </div>
               </div>
                <div class="ln_solid"></div>
                 <div class="form-group">
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
