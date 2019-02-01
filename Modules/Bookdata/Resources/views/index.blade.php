@extends('app.layouts')
@section('title')
    Data Teacher
@endsection
@section('contentheader')
<section class="content-header">
    <h1>
      Data Buku
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Data Buku</a></li>
    </ol>
  </section>
@endsection
@section('content')
    <div class="row">
       <div class="col-xs-12">
         <div class="box">
           <div class="box-header">
             <h3 class="box-title">Data Buku</h3>
             <a href="{{route('createbook')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"> Tambah Data</i></a>
           </div>
           <div class="box-body">
             <table id="book_table" class="table table-bordered table-hover">
               <thead>
               <tr>
                 <th>No</th>
                 <th>Kode Buku</th>
                 <th>Nama Buku</th>
                 <th>Penerbit</th>
                 <th>Penulis</th>
                 <th>Tahun Terbit</th>
                 <th>Sekolah</th>
                 <th>Kelas</th>
                 <th>Option</th>
               </tr>
               </thead>
               <tbody>
                 @foreach ($book_data as $no => $value)
                   <tr>
                     <td>{{ $no+1 }}</td>
                     <td>{{ $value->kd_buku }}</td>
                     <td>{{ $value->nama_buku }}</td>
                     <td>{{ $value->penerbit }}</td>
                     <td>{{ $value->penulis }}</td>
                     <td>{{ $value->tahun_terbit }}</td>
                     <td>{{ $value->sekolah->alamat }}</td>
                     <td>{{ $value->kela->nama_kelas}}</td>
                     <td>
                       <a href="bookdata/buku/{{$value->id_buku}}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"> Edit Data</i></a>
                       <form class="form_delete_{{$value->id_buku}}" action="{{route('Bookdata.delete', ['id' => $value->id_buku])}}" method="POST">
                         @csrf @method('DELETE')
                         <button type="submit" class="btn btn-danger delete_button" data="{{$value->id_buku}}" title="Delete Data"><i class="fa fa-trash"></i> Hapus Data</a>
                       </form>
                     </td>
                   </tr>
             	@endforeach
               </tbody>
             </table>
           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->
       </div>
     </div>      
@stop
@section('jsplus')
   <script type="text/javascript">
    $(document).ready(function() {
      $('#book_table').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'responsive'  : true,
        'autoWidth'   : false
      });
    });
  </script>

@endsection