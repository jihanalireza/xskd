@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Ubah Tugas
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-graduation-cap"></i> Akademik</a></li>
      <li class="active"><a href="#">Ubah Tugas</a></li>
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
               <h2>Update Data Tugas</h2>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">
               <div class="row clearfix">
                     <form action="{{route('update.task',['id_task'=>$data_task->id_tugas])}}" method="post" enctype="multipart/form-data">
                     <div class="container-fluid">
                     @csrf @method('patch')
               <div class="col-md-6">
                   <label for="" class="control-label">Judul Tugas</label>
                   <div class="form-group">
                       <input type="text" name="judul_tugas" value="{{ $data_task->judul_tugas }}" class="form-control" placeholder="Masukan Judul Tugas" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Lampiran</label>
                   <div class="form-group">
                       <input type="file" name="attachment" value="" class="form-control" placeholder="Masukan Lampiran"/>
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Deskripsi</label>
                   <div class="form-group">
                     <textarea class="form-control" name="deskripsi" value="{{ $data_task->deskripsi }}" rows="8" cols="80" required=""></textarea>
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nama Guru</label>
                   <div class="form-group">
                     <select class="form-control" name="id_guru">
                       <option disabled>Guru</option>
                       @foreach($guru as $teacher)
                        @if($data_task->guru->id_guru==$teacher->id_guru)
                          <option value="{{$teacher->id_guru}}" selected>{{$teacher->nama_guru}}</option>
                        @else
                          <option value="{{$teacher->id_guru}}">{{$teacher->nama_guru}}</option>
                        @endif
                       @endforeach
                     </select>
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nama Kelas</label>
                   <div class="form-group">
                       <select class="form-control" name="id_kelas">
                         <option disabled selected>Kelas</option>
                         @foreach($kelas as $class)
                          @if($data_task->kela->id_kelas==$class->id_kelas)
                            <option value="{{$class->id_kelas}}" selected>{{$class->nama_kelas}}</option>
                          @else
                            <option value="{{$class->id_kelas}}">{{$class->nama_kelas}}</option>
                          @endif

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
