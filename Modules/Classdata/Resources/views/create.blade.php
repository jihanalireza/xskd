@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
     Tambah Data Kelas
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Tambah Data Kelas</a></li>
    </ol>
  </section>
@endsection
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
<div class="clearfix"></div>
       <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="x_title">
               <h2>Tambah Data Kelas</h2>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">
               <div class="row clearfix">
                     <form action="{{route('createclass.store')}}" method="post">
                     <div class="container-fluid">
                     @csrf
               <div class="col-md-12">
                   <label for="" class="control-label">Nama Kelas</label>
                   <div class="form-group">
                       <input type="text" name="nama_kelas" value="" class="form-control" placeholder="Masukan Nama Kelas" required="" />
                   </div>
               </div>
                <div class="ln_solid"></div>
                 <div class="form-group">
                   <div class="col-md-12">
                     <a href="{{route('indexClassdata')}}" class="btn btn-danger btn-3d" style="float:left" title="Batal">Batal</a>
                     <button type="submit" class="btn btn-success btn-3d" style="float:right" title="Simpan">Simpan</button>
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
