@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Tambah Tugas
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-graduation-cap"></i> Akademik</a></li>
      <li class="active"><a href="#">Tambah Tugas</a></li>
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
               <h2>Tambah Data Tugas</h2>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">
               <div class="row clearfix">
                     <form action="{{route('createtask.store')}}" method="post" enctype="multipart/form-data">
                     <div class="container-fluid">
                     @csrf
               <div class="col-md-6">
                   <label for="" class="control-label">Judul Tugas</label>
                   <div class="form-group">
                       <input type="text" name="judul_tugas" value="" class="form-control" placeholder="Masukan Judul Tugas" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Lampiran</label>
                   <div class="form-group">
                       <input type="file" name="attachment" value="" class="form-control" placeholder="Masukan Lampiran" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Deskripsi</label>
                   <div class="form-group">
                     <textarea class="form-control" name="deskripsi" rows="8" cols="80" required=""></textarea>
                   </div>
               </div>
                     <input type="hidden" name="guru" value="{{$guru[0]->id_guru}}" class="form-control" required="" />
               <div class="col-md-6">
                   <label for="" class="control-label">Nama Kelas</label>
                   <div class="form-group">
                       <select class="form-control" name="id_kelas" required>
                         <option value="" disabled selected>Pilih Nama Kelas</option>
                         @foreach($kelas as $class)
                         <option value="{{$class->id_kelas}}">{{$class->nama_kelas}}</option>
                         @endforeach
                       </select>
                   </div>
               </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-12">
                    <a href="{{ route('task.index') }}" class="btn btn-danger"> Batal</a>
                  <div class="pull-right">
                    <button type="submit" class="btn btn-success"> Simpan</button>
                  </div>
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
