@extends('app.layouts')
@section('title')
    Data Class
@endsection
@section('contentheader')
<section class="content-header">
    <h1>
      Data Kelas
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Data Kelas</a></li>
    </ol>
  </section>
@endsection
@section('content')
  <div class="row">
       <div class="col-xs-12">
         <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}">
           <div class="box-header" >
             <h3 class="box-title">Data Kelas</h3>
             <a href="{{Route('create.class')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
           </div>
           <div class="box-body">
             <table id="example2" class="table table-bordered table-hover" style="width:100%;">
               <thead>
               <tr>
                 <th>No</th>
                 <th>Nama Kelas</th>
                 <th>Opsi</th>
               </tr>
               </thead>
               <tbody>
                 @php
                   $no = 1;
                 @endphp
                 @foreach ($dataclass as $itemsclass)
                   <tr>
                     <td>{{ $no++ }}</td>
                     <td>{{ $itemsclass->nama_kelas }}</td>
                     <td>
                       <a href="{{ route('editClassdata',$itemsclass->id_kelas) }}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"></i> Edit data</a>
                       <form action="{{route('deleteClassdata',["id" => $itemsclass->id_kelas])}}" method="POST" class="form_delete{{$itemsclass->id_kelas}}" id="form_delete">
                        @csrf @method('DELETE')
                        <button id="delete_button" type="submit" class="btn btn-danger delete_button" key="{{$itemsclass->id_kelas}}" title="Delete Data"><i class="fa fa-trash"></i> Hapus Data</button>
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
@section('jsplus')

<script type="text/javascript">
  $(document).ready(function() {
    let response = $('.box').attr('response');
    let message = $('.box').attr('message');
    console.log(response);
    if(response == 'success'){
      swal("Action Success!", message, "success");
    }else if(response == 'error'){
      swal("Action Error!", message, "error");
    }

    $('#example').DataTable();
    setTimeout(function(){ $('.alert-success').hide(1000); }, 5000);
  });

  $(".delete_button").on("click", function (event) {
      event.preventDefault();
      var id = $(this).attr('key');
      swal({
          title: "Apa Anda Yakin?",
          text: "Yakin Menghapus Data Kelas", type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Iya",
          closeOnConfirm: false
      },
      function () {
        {{--  submit dengan id dari form delete  --}}
        $('.form_delete'+id).submit();
      });
  });
</script>
@endsection
