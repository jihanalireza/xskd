@extends('app.layouts')
@extends('schooldata::additional')
@section('contentheader')
<section class="content-header">
    <h1>
      Data Sekolah
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Data Sekolah</a></li>
    </ol>
  </section>
@endsection
@section('content')
  <div class="row">
       <div class="col-xs-12">
         <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}">
           <div class="box-header">
             <h3 class="box-title">Data Sekolah</h3>
             <a href="{{route('school.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
           </div>
           <div class="box-body">
             <table id="example2" class="table table-bordered table-hover" style="width:100%;">
               <thead>
               <tr>
                 <th>No</th>
                 <th>Logo</th>
                 <th>Nama Sekolah</th>
                 <th>Alamat</th>
                 <th>Nomor telepon</th>
                 <th>Opsi</th>
               </tr>
               </thead>
               <tbody>
                 @php
                   $no = 1;
                 @endphp
                 @foreach ($dataschool as $itemsschool)
                   <tr>
                     <td>{{ $no++ }}</td>
                     <td><img src="{{ env('API_URL') }}/{{ $itemsschool->logo }}" alt="" style="width:100px;height:100px"></td>
                     <td>{{ $itemsschool->nama_sekolah }}</td>
                     <td>{{ $itemsschool->alamat }}</td>
                     <td>{{ $itemsschool->nomor_tlp }}</td>
                     <td>
                       <a href="{{ route('school.edit',['id_sekolah'=>$itemsschool->id_sekolah]) }}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"></i> Edit data</a>
                      <form class="form_delete_{{$itemsschool->id_sekolah}}" action="{{route('school.delete', ["id" => $itemsschool->id_sekolah])}}" method="POST" id="form_delete">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger delete_button" data="{{$itemsschool->id_sekolah}}"><i class="fa fa-trash"></i> Hapus Data</button>
                      </form>  
                     </td>
                   </tr>
             @endforeach
               </tfoot>
             </table>
           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->
       </div>
     </div>
@stop