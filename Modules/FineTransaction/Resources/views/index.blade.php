@extends('app.layouts')
@section('title')
    Data Transaksi Denda
@endsection
@section('content')
    <div class="row">
       <div class="col-xs-12">
         <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}">
           <div class="box-header">
             <h3 class="box-title">Data Transaksi Denda</h3>
             <a href="{{route('FineTransaction.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"> Tambah Data</i></a>
           </div>
           <div class="box-body">
             <table id="fine" class="table table-bordered table-hover">
               <thead>
               <tr>
                 <th>No</th>
                 <th>Denda</th>
                 <th>Keterlambatan</th>
                 <th>Total Bayar</th>
                 <th>Bukti Pembayaran</th>
                 <th>Sekolah</th>
                 <th>Siswa</th>
                 <th>Option</th>
               </tr>
               </thead>
               <tbody>
                 @foreach ($fine_data as $no => $value)
                   <tr>
                     <td>{{ $no+1 }}</td>
                     <td>{{ $value->denda }}</td>
                     <td>{{ $value->keterlambatan }}</td>
                     <td>{{ $value->total_bayar }}</td>
                     <td>{{ $value->bukti_pembayaran }}</td>
                     <td>{{ $value->sekolah->nama_sekolah }}</td>
                     <td>{{ $value->siswa->nama_siswa }}</td>
                     <td>
                       <a href="{{route('FineTransaction.edit',['id_denda'=>$value->id_denda])}}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"> Edit Data</i></a>
                       <form class="form_delete_finetransaction{{ $value->id_denda }}" action="{{ route('FineTransaction.delete',['id'=>$value->id_denda ]) }}" method="POST">
                         @csrf @method('DELETE')
                         <button type="submit" class="btn btn-danger delete_button" idfinedata="{{ $value->id_denda }}" title="Delete Data"><i class="fa fa-trash"></i> Hapus Data</a>
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

      $('#fine').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'responsive'  : true,
        'autoWidth'   : false
      });


    // show modal delete
      $(".delete_button").on("click", function (event) {
          event.preventDefault();
          var id = $(this).attr('idfinedata');
          swal({
              title: "Apa Anda Yakin?",
              text: "Yakin Menghapus Data Transaksi Denda", type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Iya",
              closeOnConfirm: false
          },
          function () {
            {{--  submit dengan id dari form delete  --}}
            $('.form_delete_finetransaction'+id).submit();
          });
      });
    })

  </script>

@endsection
