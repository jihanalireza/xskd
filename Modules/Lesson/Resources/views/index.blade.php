@extends('app.layouts')
@section('title')
    Lesson
@endsection
@section('contentheader')
<section class="content-header">
    <h1>
      Data Mata Pelajaran
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Data Mata Pelajaran</a></li>
    </ol>
  </section>
@endsection
@section('content')
    <div class="row">
       <div class="col-xs-12">
         <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}" >
           <div class="box-header">
             <h3 class="box-title">Data Mata Pelajaran</h3>
             <a href="{{ route('create.lesson') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"> Tambah Data</i></a>
           </div>
           <div class="box-body">
             <table style="width:100%" id="example2" class="table table-bordered table-hover">
               <thead>
               <tr>
               <th>nama mapel</th>
               <th>Opsi</th>
               </tr>
               </thead>
               <tbody>
               @foreach ($lesson_data as $show)
                <tr>
                    <td>{{ $show->nama_mapel }}</td>
                    <td>
                        <a href="{{ route('editlesson',$show->id_mapel)}}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"> Edit Data</i></a>
                        <form class="form_delete_{{$show->id_mapel}}" action="{{route('delete.lesson', ["id" => $show->id_mapel])}}" method="POST" id="form_delete">
                          @csrf @method('DELETE')
                          <button type="submit" class="btn btn-danger delete_button" data="{{$show->id_mapel}}"><i class="fa fa-trash"></i> Hapus Data</button>
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
      var id = $(this).attr('data');
      console.log(id);
      swal({
          title: "Apa Anda Yakin?",
          text: "Yakin Menghapus Data Pelajaran", type: "warning",
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
