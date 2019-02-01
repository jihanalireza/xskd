@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
     Ubah Data Sekolah
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Ubah Data Sekolah</a></li>
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
               <h2>Update Data Sekolah</h2>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">
               <div class="row clearfix">
                     <form action="{{route('school.update',['id_sekolah'=>$school_data->id_sekolah])}}" method="post" enctype="multipart/form-data">
              <div class="container-fluid">
                     @csrf @method('PATCH')
                 <div class="col-md-6">
                     <label for="" class="control-label">Nama Sekolah</label>
                     <div class="form-group">
                         <input type="text" name="school_name" value="{{ $school_data->nama_sekolah }}" class="form-control" placeholder="Masukan NISN Siswa" required="true" />
                     </div>
                 </div>
                 <div class="col-md-6">
                     <label for="" class="control-label">Nomor Telepon Sekolah</label>
                     <div class="form-group">
                         <input type="number" min="0" name="phone_number" value="{{ $school_data->nomor_tlp }}" class="form-control" placeholder="Masukan Nomor Siswa" required="true" />
                     </div>
                 </div>
                 <div class="col-md-6">
                     <label for="" class="control-label">Alamat Sekolah</label>
                     <div class="form-group">
                        <textarea rows="5" name="school_address" class="form-control" required>{{ $school_data->alamat }}</textarea>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <label for="" class="control-label">Logo</label>
                     <div class="form-group">
                         <input type="file" name="logo" class="form-control" />
                     </div>
                 </div>

                  <div class="ln_solid"></div>
                   <div class="form-group">
                     <div class="col-md-12">
                       <a href="{{ route('indexSchooldata') }}" type="button" class="btn btn-danger">Batal</a>
                     <div class="pull-right">
                       <button type="submit" class="btn btn-success pull-right">Simpan</button>
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
