@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Monitoring Spp
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cart-plus"></i> Transaksi SPP</a></li>
      <li class="active"><a href="#">Monitoring SPP</a></li>
    </ol>
  </section>
@endsection
@section('content')
  <div class="container-fluid">
    <div class="col-log-12">
       <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}">
        <div class="box-header">
          <h3 class="box-title"> Monitoring Spp </h3>
          <a href="{{Route('spp.create')}}" class="btn btn-primary pull-right" title="tambah data"> <i class="fa fa-plus"></i> Tambah data</a>
        </div>
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover" style="width:100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Parameter</th>
                <th>Biaya Bulanan</th>
                <th>Keterlambatan</th>
                <th>Status</th>
                <th>Total Pembayaran</th>
                <th>Bukti Pembayaran</th>
                <th>Opsi</th>
              </tr>
              </thead>
          <tbody>
            @foreach($data_tr_spp as $key => $data)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $data->parameter }}</td>
              <td>{{ $data->biaya_bulanan }}</td>
              <td>{{ $data->keterlambatan }}</td>
              <td>{{ $data->status }}</td>
              <td>{{ $data->total_pembayaran }}</td>
              <td>
                <a href="{{route('SPP.edit',$data->id_tr_spp)}}" class="btn btn-warning" title="edit data" > <li class="fa fa-edit"></li> Edit data</a>
                <form class="form_delete_{{$data->id_tr_spp}}" action="{{route('SPP.delete', ['id' => $data->id_tr_spp ])}}" method="POST" >
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-danger delete_button" data="{{$data->id_tr_spp}}"><i class="fa fa-trash"></i> Hapus Data</button>
                </form>
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
