@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Tambah Data Siswa
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Tambah Data Siswa</a></li>
    </ol>
  </section>
@endsection
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="clearfix"></div>
       <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="x_title">
               <h2>Tambah Data Siswa</h2>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">
               <div class="row clearfix">
                     <form action="{{route('createstudent.store')}}" method="post" enctype="multipart/form-data">
                     <div class="container-fluid">
                     @csrf
               <div class="col-md-6">
                   <label for="" class="control-label">Nisn Siswa</label>
                   <div class="form-group">
                       <input type="number" min="0" name="nisn" value="" class="form-control" placeholder="Masukan NISN Siswa" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nama Siswa</label>
                   <div class="form-group">
                       <input type="text" name="nama_siswa" value="" class="form-control" placeholder="Masukan Nama Siswa" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nomor Telepon Siswa</label>
                   <div class="form-group">
                       <input type="number" min="0" name="no_telepon_siswa" value="" class="form-control" placeholder="Masukan Nomor Siswa" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nama Ibu</label>
                   <div class="form-group">
                       <input type="text" name="nama_ibu" value="" class="form-control" placeholder="Masukan Nama Ibu Siswa" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nama Ayah</label>
                   <div class="form-group">
                       <input type="text" name="nama_ayah" value="" class="form-control" placeholder="Masukan Nama Ayah Siswa" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nomor Telepon Ibu</label>
                   <div class="form-group">
                       <input type="number" min="0" name="no_telepon_ibu" value="" class="form-control" placeholder="Masukan Nomor Telepon Ibu Siswa" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nomor Telepon Ayah</label>
                   <div class="form-group">
                       <input type="number" min="0" name="no_telepon_ayah" value="" class="form-control" placeholder="Masukan Nomor Telepon Ayah Siswa" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Tempat Lahir</label>
                   <div class="form-group">
                       <input type="text" name="tempat_lahir" value="" class="form-control" placeholder="Masukan Tempat Lahir" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Tanggal Lahir</label>
                   <div class="form-group">
                       <input type="date" name="tanggal_lahir" value="" class="form-control" placeholder="Masukan Tanggal Lahir" required="" />
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">Nama Kelas</label>
                   <div class="form-group">
                       <select name="nama_kelas" class="form-control">
                            @foreach($kelasdata as $item)
                               <option value="{{$item->id_kelas}}">{{$item->nama_kelas}}</option>
                            @endforeach
                       </select>
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" class="control-label">jenis kelamin</label>
                   <div class="form-group">
                       <select name="jenis_kelamin" class="form-control">
                               <option value="laki-laki">Laki-Laki</option>
                               <option value="perempuan">Perempuan</option>
                       </select>
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="image" class="control-label">Foto</label>
                   <div class="form-group">
                    <input class="form-control" type="file" name="image" required="">
                   </div>
               </div>
               <div class="col-md-12">
                 <label for="" class="control-label">Alamat Siswa</label>
                 <div class="form-group">
                   <textarea name="alamat" class="form-control" rows="5" cols="80" required=""></textarea>
                 </div>
               </div>
                <div class="ln_solid"></div>
                     <a href="{{route('indexStudentdata')}}"  class="btn btn-danger pull-left">Batal</a>
                     <input type="submit" value="Simpan"  class="btn btn-success pull-right">
                </div>
               </form>
             </div>
           </div>
         </div>
       </div>
         </div>
       </div>

@stop
