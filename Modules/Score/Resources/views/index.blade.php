@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Nilai
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-graduation-cap"></i> Akademik</a></li>
      <li class="active"><a href="#">Nilai</a></li>
    </ol>
  </section>
@endsection
@section('content')
@section('title')
Data Nilai
@endsection
@section('content')
<div class="row">
 <div class="col-xs-12">
   <div class="box">
     <div class="box-header">
       <h3 class="box-title">Data Nilai</h3>
       <a href="{{route('createScoredata')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"> Tambah Data</i></a>
     </div>
     @if(Session::get('response'))
      <div class="response" data-response="{{ Session::get('response') }}" data-message="{{ Session::get('message') }}"> </div>
      @php Session::forget('response') @endphp
     @endif
     <div class="box-body">
       <table id="score_table" class="table table-bordered table-hover">
         <thead>
           <tr>
             <th>No</th>
             <th>Uts</th>
             <th>Uas</th>
             <th>Tugas</th>
             <th>Ulangan Harian</th>
             <th>Total Nilai</th>
             <th>Siswa</th>
             <th>Kelas</th>
             <th>Sekolah</th>
             <th>Guru</th>
             <th>Option</th>
           </tr>
         </thead>
         <tbody>
           @foreach ($score_data as $no => $value)
           <tr>
             <td>{{ $no+1 }}</td>
             <td>{{ $value->uts }}</td>
             <td>{{ $value->uas }}</td>
             <td>{{ $value->tugas }}</td>
             <td>{{ $value->ulangan_harian }}</td>
             <td>{{ $value->total_nilai }}</td>
             <td>{{ $value->siswa->nama_siswa }}</td>
             <td>{{ $value->kela->nama_kelas }}</td>
             <td>{{ $value->sekolah->nama_sekolah }}</td>
             <td>{{ $value->guru->nama_guru }}</td>
             <td>
               <a href="{{route('editScoredata', ["id" => $value->id_nilai])}}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"></i>Edit Data</a>
               <form class="form_delete_{{$value->id_nilai}}" action="{{route('deleteScoredata', ["id" => $value->id_nilai])}}" method="post" id="form_delete">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger delete_button" idScore="{{$value->id_nilai}}"><i class="fa fa-trash"></i> Hapus Data</button>
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
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.responsive.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script>
  $(document).ready(function() {
    $('#score_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'responsive'  : true,
      'autoWidth'   : false
    })

    let response = $('.response').attr('data-response'); 
    let message = $('.response').attr('data-message'); 
    console.log(response);
    if(response == 'success'){
      swal("Action Success!", message, "success");
    }else if(response == 'error'){
      swal("Action Error!", message, "error");
    }

  });

  $(".delete_button").on("click", function (event) {
    event.preventDefault();
    var id = $(this).attr('idScore');
    console.log(id);
    swal({
      title: "Apa Anda Yakin?",
      text: "Yakin Menghapus Data Nilai", type: "warning",
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