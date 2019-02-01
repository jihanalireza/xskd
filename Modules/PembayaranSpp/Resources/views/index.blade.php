@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Pembayaran SPP
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cart-plus"></i> Transaksi SPP</a></li>
      <li class="active"><a href="#">Pembayaran SPP</a></li>
    </ol>
  </section>
@endsection
@section('content')
  <div class="container-fluid">
    <div class="col-log-12">
       <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}">
        <div class="box-header">
          <h3 class="box-title"> Pembayaran Spp </h3>
        </div>
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover" style="width:100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Invoice</th>
                <th>Total Bayar</th>
                <th>Bukti Pembayaran</th>
                <th>Status</th>
                <th>Opsi</th>
              </tr>
              </thead>
          <tbody>
            @foreach($data_tr_spp as $key => $data)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $data->no_invoice }}</td>
              <td>{{ $data->total_dibayarkan }}</td>
              <td>{{ $data->bukti_pembayaran }}</td>
              @if($data->status == 0)
                <td><span class="label label-danger">Belum Bayar</span></td>
              @elseif($data->status == 1)
                <td><span class="label label-warning">Pending</span></td>
              @elseif($data->status == 2)
                <td><span class="label label-success">Suksess</span></td>
              @elseif($data->status == 3)
                <td><span class="label label-danger">Ditolak</span></td>
              @endif
              <td>
                @if($data->status == 0)
                <a href="{{route('pembayaranspp.terima',$data->id_tr_spp)}}" class="btn btn-success" title="edit data" > <li class="fa fa-check"></li> Terima</a>
                <a href="{{route('pembayaranspp.tolak',$data->id_tr_spp)}}" class="btn btn-danger" title="edit data" > <li class="fa fa-times"></li> Tolak</a>
                @else
                <a href="{{route('pembayaranspp.terima',$data->id_tr_spp)}}" class="btn btn-success" title="edit data" disabled> <li class="fa fa-check"></li> Terima</a>
                <a href="{{route('pembayaranspp.tolak',$data->id_tr_spp)}}" class="btn btn-danger" title="edit data" disabled> <li class="fa fa-times"></li> Tolak</a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
      </div>
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
    });

    $(".delete_button").on("click", function (event) {
    event.preventDefault();
    var id = $(this).attr('data');
    console.log(id);
    swal({
      title: "Apa Anda Yakin?",
      text: "Yakin Menghapus Data SPP", type: "warning",
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
