@extends('app.layouts')
@section('title')
Data Peminjam Buku
@endsection

@section('content')
    <div class="row">
       <div class="col-xs-12">
         <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}">
           <div class="box-header">
             <h3 class="box-title">Data Peminjam Buku</h3>
             <a href="{{route('createborrowbook.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"> Tambah Peminjam Buku</i></a>
           </div>
           <div class="box-body">
             <table id="borrow_table" class="table table-bordered table-hover">
               <thead>
               <tr>
                 <th>No</th>
                 <th>Kode Peminjam</th>
                 <th>Tgl Pinjam</th>
                 <th>Tgl pengembalian</th>
                 <th>Status</th>
                 <th>qr code</th>
                 <th>Buku</th>
                 <th>Sekolah</th>
                 <th>Siswa</th>
               </tr>
               </thead>
               <tbody>
                 @foreach ($borrow_data as $no => $value)
                   <tr>
                     <td>{{ $no+1 }}</td>
                     <td>{{ $value->kd_peminjam }}</td>
                     <td>{{ $value->tgl_pinjam }}</td>
                     <td>{{ $value->tgl_pengembalian }}</td>
                     <td>{{ $value->status }}</td>
                     <td><img src=" {{env('API_URL')}}/{{$value->qr_code }}" style="width:100px;height:100px;"></td>
                     <td>{{ $value->buku->nama_buku }}</td>
                     <td>{{ $value->sekolah->nama_sekolah }}</td>
                     <td>{{ $value->siswa->nama_siswa }}</td>
                     <td>
                       <a href="borrowbook/borrowbuku/{{$value->id_buku}}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"> Edit Data</i></a>

                       <form class="form_delete_{{$value->id_pinjam_buku}}" action="{{route('deletePinjamBuku', ["id" => $value->id_pinjam_buku])}}" method="POST">
                         @csrf @method('DELETE')
                         <button type="submit" class="btn btn-danger delete_button" data="{{$value->id_pinjam_buku}}" title="Delete Data"><i class="fa fa-trash"></i> Hapus Data</a>
                       </form>
                        @if($value->status == 'telat')
                          <form class="form_invoice_{{$value->id_pinjam_buku}}" action="{{route('sendInvoice')}}" method="POST">
                            @csrf @method('POST')
                            <input type="hidden" name="siswa" value="{{$value->id_siswa}}">
                            <input type="hidden" name="idpinjambuku" value="{{$value->id_pinjam_buku}}">
                            <button type="submit" class="btn btn-info invoice_button" data="{{$value->id_pinjam_buku}}" title="Kirim Peringatan"><i class="fa fa-envelope"></i> Kirim Peringatan</a>
                          </form>
                        @else
                        @endif

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
<script>
  $(document).ready(function() {
    let response = $('.box').attr('response');
    let message = $('.box').attr('message');
    if(response == 'success'){
      swal("Action Success!", message, "success");
    }else if(response == 'error'){
      swal("Action Error!", message, "error");
    }
    setTimeout(function(){ $('.alert-success').hide(1000); }, 5000);
    $('#borrow_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'responsive'  : true,
      'autoWidth'   : false
    });
    
  $(".delete_button").on("click", function (event) {
    event.preventDefault();
    var id = $(this).attr('data');
    console.log(id);
    swal({
      title: "Apa Anda Yakin?",
      text: "Yakin Menghapus Data Peminjam Buku", type: "warning",
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

  $(".invoice_button").on("click", function (event) {
    event.preventDefault();
    var id = $(this).attr('data');
    console.log(id);
    swal({
      title: "Apa Anda Yakin?",
      text: "Yakin mengirim peringatan", type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Iya",
      closeOnConfirm: false
    },
    function () {
      {{--  submit dengan clas dari form delete  --}}
      $('.form_invoice_'+id).submit();
    });
  });
  })
</script>
@endsection
