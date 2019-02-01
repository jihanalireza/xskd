@extends('app.layouts')
@extends('studentdata::additional')
@section('contentheader')
<section class="content-header">
    <h1>
      Ubah Data Siswa
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Ubah Data Siswa</a></li>
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
         <h2>Update Data Siswa</h2>
         <div class="clearfix"></div>
       </div>
       <div class="x_content">
         <div class="clearfix">
               <form action="{{route('update_siswa')}}" method="post" enctype="multipart/form-data">
               <div class="container-fluid">
               @csrf
               <input type="hidden" name="id_siswa" value="{{ $datasiswa->id_siswa }}"/>
      <center>
         <hr style="border: 0.5px solid black;">
          <b>Data Siswa</b>
         <hr style="border: 0.5px solid black;">
       </center>

       <div class="row">
         <div class="col-md-2">
             <label for="" class="control-label">Nama Lengkap</label>
         </div>
         <div class="col-md-6">
             <div class="form-group">
                 <input type="text" name="nama_siswa" value="{{ $datasiswa->nama_siswa }}" class="form-control" placeholder="Masukan Nama Siswa" required="true" />
             </div>
         </div>
       </div>

         <div class="row">
           <div class="form-group">
             <div class="col-md-2">
               <label>
                 Jenis Kelamin
               </label>
             </div>
             <center>
             <div class="col-md-3">
               <input type="radio" name="r3" class="flat-red" checked>
                <label> Laki-laki </label>
            </div>
            <div class="col-md-3">
              <input type="radio" name="r3" class="flat-red">
                <label> Perempuan </label>
            </div>
          </center>
            </div>
          </div>
          <br>

       <div class="row">
         <div class="col-md-2">
             <label for="" class="control-label">Nisn Siswa</label>
         </div>
         <div class="col-md-6">
             <div class="form-group">
     			       <input type="number" name="nisn" value="{{ $datasiswa->nisn }}" class="form-control" placeholder="Masukan NISN Siswa" required="true" />
               </div>
         </div>
       </div>

       <div class="row">
         <div class="col-md-2">
             <label for="" class="control-label">Tempat Lahir</label>
         </div>
         <div class="col-md-4">
             <div class="form-group">
                 <input type="text" name="tempat_lahir" value="{{ $datasiswa->tempat_lahir }}" class="form-control" placeholder="Masukan Tempat Lahir" required="true" />
               </div>
          </div>
          <div class="col-md-2">
            <label for="" class="control-label">Tanggal Lahir</label>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <input type="date" name="tgl_lahir" value="{{ old($datasiswa->tgl_lahir, date('Y-m-d')) }}" class="form-control" placeholder="Masukan Tanggal Lahir" required="true" />
            </div>
          </div>

       </div>

       <div class="row">
         <div class="col-md-2">
             <label for="" class="control-label">Nomor Telepon</label>
         </div>
         <div class="col-md-4">
             <div class="form-group">
                 <input type="number" min="0" name="nomor_tlp" value="{{ $datasiswa->nomor_tlp }}" class="form-control" placeholder="Masukan Nomor Siswa" required="true" />
           </div>
         </div>
      </div>

       <center>
          <hr style="border: 0.5px solid black;">
           <b>Data Ayah Kandung</b>
          <hr style="border: 0.5px solid black;">
        </center>

      <div class="row">
       <div class="col-md-2">
           <label for="" class="control-label">Nama Lengkap</label>
       </div>
       <div class="col-md-6">
           <div class="form-group">
               <input type="text" name="nama_ayah" value="{{ $datasiswa->nama_ayah }}" class="form-control" placeholder="Masukan Nama Ayah Siswa" required="true" />
         </div>
       </div>
     </div>


     <div class="row">
       <div class="col-md-2">
           <label for="" class="control-label">Nomor Telepon</label>
         </div>
       <div class="col-md-4">
           <div class="form-group">
               <input type="number" min="0" name="tlp_ayah" value="{{ $datasiswa->tlp_ayah }}" class="form-control" placeholder="Masukan Nomor Telepon Ayah Siswa" required="true" />
         </div>
       </div>
    </div>

     <center>
        <hr style="border: 0.5px solid black;">
         <b>Data Ibu Kandung</b>
        <hr style="border: 0.5px solid black;">
      </center>

      <div class="row">
       <div class="col-md-2">
           <label for="" class="control-label">Nama Lengkap</label>
       </div>
       <div class="col-md-6">
           <div class="form-group">
               <input type="text" name="nama_ibu" value="{{ $datasiswa->nama_ibu }}" class="form-control" placeholder="Masukan Nama Ibu Siswa" required="true" />
           </div>
        </div>
     </div>

     <div class="row">
     <div class="col-md-2">
         <label for="" class="control-label">Nomor Telepon</label>
     </div>
     <div class="col-md-4">
         <div class="form-group">
             <input type="number" min="0" name="tlp_ibu" value="{{ $datasiswa->tlp_ibu }}" class="form-control" placeholder="Masukan Nomor Telepon Ibu Siswa" required="true" />
        </div>
     </div>
   </div>

         <div class="col-md-6">
             <label for="" class="control-label">Jenis Kelamin</label>
             <div class="form-group">
               <select class="form-control" name="jenis_kelamin" required="true">
                 <option @if ($datasiswa->jenis_kelamin == "laki-laki") selected @endif value="laki-laki">laki-laki</option>
                 <option @if ($datasiswa->jenis_kelamin == "perempuan") selected @endif value="perempuan">perempuan</option>
               </select>
             </div>
         </div>
         <div class="col-md-6">
             <label for="" class="control-label">Nama Kelas</label>
             <div class="form-group">
               <select class="form-control" name="id_kelas" required="true">
                 @forelse($datakelas as $show)
                 <option @if ($show->id_kelas == $show->id_kelas) selected @endif value="{{ $show->id_kelas }}">{{ $show->nama_kelas }}</option>
                 @empty
                 <option value="">Data Kelas Kosong</option>
                 @endforelse
               </select>
             </div>
         </div>
         <div class="col-md-6">
             <label for="image" class="control-label">Foto</label>
             <div class="form-group">
              <input class="form-control" type="file" name="foto">
             </div>
         </div>
         <div class="col-md-12">
           <label for="" class="control-label">Alamat Siswa</label>
           <div class="form-group">
             <textarea name="alamat" class="form-control" rows="5" cols="80" required="true"> {{ $datasiswa->alamat }} </textarea>
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
