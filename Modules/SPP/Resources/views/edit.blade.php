@extends('app.layouts')
@extends('spp::additional')
@section('contentheader')
<section class="content-header">
    <h1>
      Ubah Monitoring Spp
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cart-plus"></i> Transaksi SPP</a></li>
      <li class="active"><a href="#">Ubah Monitoring SPP</a></li>
    </ol>
  </section>
@endsection
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_title">
      <h2>Update Data Transaksi SPP </h2>
      <div class="clearfix"></div>
      </div>
        <div class="x_content">
          <div class="row clearfix">
            <form action="{{route('spp.update')}}" method="post" enctype="multipart/form-data">
              <div class="container-fluid">
                @csrf @method('patch')
                <input type="hidden" name="id_tr_spp" value="{{$tr_Spp->id_tr_spp}}" />
                <div class="col-md-6">
                  <label for="" class="control-label">Tanggal Jatuh Tempo</label>
                  <div class="form-group">
                    <input type="number" name="parameter" value="{{ $tr_Spp->parameter }}" min="1" max="32" class="form-control" placeholder="tanggal jatuh tempo" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="" class="control-label">Biaya Bulanan</label>
                  <div class="form-group">
                    <input type="number" id="biaya_bulanan" name="biaya_bulanan" value="{{$tr_Spp->biaya_bulanan}}" min="0" class="form-control" placeholder="biaya bulanan" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="" class="control-label">Keterlambatan</label>
                  <div class="row">
                    <div class="form-group col-md-10">
                      <input type="number" id="keterlambatan" min="0" max="144" name="keterlambatan" value="{{$tr_Spp->keterlambatan}}" min="0" class="form-control" placeholder="keterlambatan pembayaran" required />
                    </div>
                    <div class="col-md-2">
                      <label for="">bulan</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="" class="control-label">Total Pembayaran</label>
                  <div class="form-group">
                    <input type="number" name="total_pembayaran" id="total_pembayaran" value="{{$tr_Spp->total_pembayaran}}" class="form-control" placeholder="Total Pembayaran" readonly required />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="" class="control-label">Nama Siswa</label>
                  <div class="form-group">
                    <select name="id_siswa" class="select2 form-control" placeholder="Nama Siswa" required>
                      <option value="">- pilih siswa -</option>
                      @foreach ($select_student as $key => $items)
                        <option @if ($items->id_siswa == $tr_Spp->siswa->id_siswa) selected  @endif value="{{$items->id_siswa}}">{{$items->nama_siswa}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-12"><br>
                    <a href="{{route('spp.index')}}" style="float:left" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" style="float:right" class="btn btn-success">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
@section('jsplus')
<script>
$(document).ready(function(){
   //select2 custom value
   $(".select2").select2({
          placeholder: 'masukkan nama siswa',
        });
      $(document).on('keyup','#keterlambatan',function () {
        let keterlambatan = $(this).val();
        let biaya_bulanan = $('#biaya_bulanan').val();
        if (keterlambatan == 0) {
          $('#total_pembayaran').val(0);
          $('#total_pembayaran').val(biaya_bulanan * 1);
        }else {
          let jumlah = parseInt(keterlambatan)+parseInt(1);
          $('#total_pembayaran').val(biaya_bulanan * jumlah);
        }
      });
      $(document).on('keyup','#biaya_bulanan',function () {
        let keterlambatan = $('#keterlambatan').val();
        let biaya_bulanan = $('#biaya_bulanan').val();
        if (keterlambatan == 0) {
          $('#total_pembayaran').val(0);
          $('#total_pembayaran').val(biaya_bulanan * 1);
        }else {
          let jumlah = parseInt(keterlambatan)+parseInt(1);
          $('#total_pembayaran').val(biaya_bulanan * jumlah);
        }
      });
})
</script>
@endsection
