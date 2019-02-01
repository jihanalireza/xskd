@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Informa Sekolah
    </h1>
    <ol class="breadcrumb">
      <li  class="active"><a href="#"><i class="fa fa-university"></i> Informasi Sekolah</a></li>
    </ol>
  </section>
@endsection
@section('title')
    Data Schedule
@endsection
@section('content')
  <div class="row">
       <div class="col-xs-12">
         <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}">
           <div class="box-header">
             <h3 class="box-title">Data Informasi Sekolah</h3>
             <a href="{{route('createinfosekolah.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"> Tambah Data</i></a>
           </div>
           <div class="box-body">
             <table id="example2" class="table table-bordered table-hover" style="width:100%;">
               <thead>
               <tr>
                 <th>No</th>
                 <th>Judul</th>
                 <th>Deskripsi</th>
                 <th>Opsi</th>
               </tr>
               </thead>
               <tbody>
                 @foreach ($datainformasi as $itemsinformation)
                   <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$itemsinformation->judul}}</td>
                     <td>{{$itemsinformation->deskripsi}}</td>
                     <td>
                       <a href="{{route('SchoolInformation.edit' , ['id' => $itemsinformation->id_informasi])}}" class="btn btn-warning" title="Edit Data" id=""><i class="fa fa-pencil"> Edit data</i></a>
                       <button class="btn waves-effect waves-dark btn-danger btn-outline-danger" data-toggle="modal" data-target="#delete_cost"><i class="fa fa-trash"></i> Hapus</button>
        <!--  awal modal delete -->
                     <div class="modal fade" id="delete_cost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Ingin Hapus data ini?</h5>
                           </div>

                       <div class="modal-footer">
                         <form method="post" class="delete_form" action="{{route('SchoolInformation.delete',['id_informasi'=>$itemsinformation->id_informasi])}}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                           @method('DELETE')
                         {{csrf_field()}}
                         <input type="hidden" name="_method" value="DELETE"/>
                         <button type="submit" class="btn btn-danger">Delete</button>
                       </form>
                           </div>
                         </div>
                       </div>
                     </div>
        <!-- akhir modal delete -->
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

    if(response == 'success'){
      swal("Action Success!", message, "success");
    }else if(response == 'error'){
      swal("Action Error!", message, "error");
    }

    $('#example').DataTable();
    setTimeout(function(){ $('.alert-success').hide(1000); }, 5000);

    //Timepicker
   
  });

  $(".delete_button").on("click", function (event) {
      event.preventDefault();
      var id = $(this).attr('data');
      console.log(id);
      swal({
          title: "Apa Anda Yakin?",
          text: "Yakin Menghapus Data Jadwal", type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Iya",
          closeOnConfirm: false
      },
      function () {
        {{--  submit dengan clas dari form delete  --}}
        $('.form_delete_'+id).submit();
      });
  });

</script>
@endsection
