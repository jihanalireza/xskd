@extends('app.layouts')
@section('title')
    Data Schedule
@endsection
@section('contentheader')
<section class="content-header">
    <h1>
      Jadwal Pelajaran
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-graduation-cap"></i> Akademik</a></li>
      <li class="active"><a href="#">Jadwal Pelajaran</a></li>
    </ol>
  </section>
@endsection
@section('content')
  <div class="row">
       <div class="col-xs-12">
         <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}">
           <div class="box-header">
             <h3 class="box-title">Data Jadwal</h3>
             <a href="{{route('CreateSchedule')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"> Tambah Data</i></a>
           </div>
           <div class="box-body">
             <table id="example2" class="table table-bordered table-hover" style="width:100%;">
               <thead>
               <tr>
                 <th>No</th>
                 <th>Hari</th>
                 <th>Mapel</th>
                 <th>Kelas</th>
                 <th>Jam Masuk</th>
                 <th>Jam Selesai</th>
                 <th>Opsi</th>
               </tr>
               </thead>
               <tbody>
                 @php
                   $no = 1;
                 @endphp
                 @foreach ($schedule as $itemsschedule)
                   <tr>
                     <td>{{ $no++ }}</td>
                     <td>{{ $itemsschedule->hari }}</td>
                     <td>{{ $itemsschedule->mata_pelajaran->nama_mapel }}</td>
                     <td>{{ $itemsschedule->kela->nama_kelas }}</td>
                     <td>{{ $itemsschedule->jam_masuk }}</td>
                     <td>{{ $itemsschedule->jam_selesai }}</td>
                     <td>
                       <a href="{{ route('editSchedule',['id'=>$itemsschedule->id_jadwal]) }}" class="btn btn-warning" title="Edit Data" id=""><i class="fa fa-pencil"> Edit data</i></a>
                       <form action="{{route('deleteSchedule', ["id" => $itemsschedule->id_jadwal])}}" method="POST" class="form_delete_{{$itemsschedule->id_jadwal}}">
                         @csrf @method('DELETE')
                         <button type="submit" class="btn btn-danger delete_button" data="{{$itemsschedule->id_jadwal}}"><i class="fa fa-trash"></i> Hapus Data</button>
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
