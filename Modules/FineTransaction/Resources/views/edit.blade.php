@extends('app.layouts')
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_title">
      <h2>Update Data Transaksi Denda </h2>
      <div class="clearfix"></div>
      </div>
        <div class="x_content">
          <div class="row clearfix">
            <form action="{{route('FineTransaction.update')}}" method="post" enctype="multipart/form-data">
              <div class="container-fluid">
                @csrf @method('patch')
                <input type="hidden" name="id_denda" value="{{$fine_data->id_denda}}" />
                <div class="col-md-6">
                  <label for="" class="control-label">Denda</label>
                  <div class="form-group">
                    <input type="number" name="Denda" id="denda" value="{{$fine_data->denda}}" class="form-control" min="0" placeholder="total denda" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="" class="control-label">keterlambatan</label>
                  <div class="form-group">
                    <input type="number" name="keterlambatan" id="keterlambatan" value="{{$fine_data->keterlambatan}}" min="0" class="form-control" placeholder="keterlambatan" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="" class="control-label">total bayar</label>
                  <div class="form-group">
                    <input type="number" name="total_bayar" id="total_bayar" value="{{$fine_data->total_bayar}}" class="form-control" readonly required />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="" class="control-label">Nama Siswa</label>
                  <div class="form-group">
                    <select name="id_siswa" class="select2 form-control" placeholder="Nama Siswa" required>
                      <option value="">- pilih siswa -</option>
                      @foreach ($select_student as $key => $items)
                        <option @if ($items->id_siswa == $fine_data->siswa->id_siswa)  selected @endif value="{{$items->id_siswa}}">{{$items->nama_siswa}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-12">
                    <br>
                    <a style="float:left" href="{{route('FineTransaction.index')}}" class="btn btn-danger">Batal</a>
                    <input style="float:right" type="submit" value="Simpan" class="btn btn-success">
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
        $(document).on('keyup','#denda',function () {
            var denda = $(this).val();
            var keterlambatan = $('#keterlambatan').val();
            if (keterlambatan == 0) {
              $('#total_bayar').val(denda * 1)
            }else {
              let jumlah = parseInt(keterlambatan)+parseInt(1);
              $('#total_bayar').val(denda * jumlah)
            }
        });
        $(document).on('keyup','#keterlambatan',function () {
            var denda = $('#denda').val();
            var keterlambatan = $('#keterlambatan').val();
            if (keterlambatan == 0) {
              $('#total_bayar').val(denda * 1)
            }else {
              let jumlah = parseInt(keterlambatan)+parseInt(1);
              $('#total_bayar').val(denda * jumlah)
            }
        });

        let response = $('.box').attr('response');
        let message = $('.box').attr('message');
        console.log(response);
        if(response == 'success'){
          swal("Action Success!", message, "success");
        }else if(response == 'error'){
          swal("Action Error!", message, "error");
        }

    });
</script>
@endsection
