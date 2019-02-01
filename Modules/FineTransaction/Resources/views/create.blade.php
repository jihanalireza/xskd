@extends('app.layouts')

@section('content')
<div class="box">
	<div class="box box-primary">
	  <div class="box-header with-border">
	    <h3 class="box-title">Tambah Data Transaksi Denda</h3>
	  </div>
	  <form action="{{route('FineTransaction.save')}}" method="post" enctype="multipart/form-data">
      @method('POST') @csrf()
	    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @if($errors->has('id_siswa')) has-error @endif">
            <label>Siswa</label>
              <select class="form-control select2" name="id_siswa" style="width: 100%;" id="siswa">
                <option value="" >Pilih Siswa</option>
                @foreach($datastudent as $itemsiswa)
                  <option value="{{ $itemsiswa->id_siswa }}" >{{ $itemsiswa->nama_siswa }}</option>
                @endforeach
              </select>
            @if($errors->has('id_siswa')) <span class="help-block">{{ $errors->first('id_siswa') }}</span> @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group @if($errors->has('denda')) has-error @endif">
            <label>Nominal Denda</label>
            <input type="number" min="0" class="form-control" name="denda" value="{{ old('denda') }}" placeholder="Nominal Denda">
            @if($errors->has('denda')) <span class="help-block">{{ $errors->first('denda') }}</span> @endif
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @if($errors->has('keterlambatan')) has-error @endif">
            <label>Keterlambatan</label>
            <input type="number" class="form-control" name="keterlambatan" value="{{ old('keterlambatan') }}" placeholder="Keterlambatan">
            @if($errors->has('keterlambatan')) <span class="help-block">{{ $errors->first('keterlambatan') }}</span> @endif
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
	    <!-- /.box-body -->

	    <div class="box-footer">
	      <button type="submit" class="btn btn-success pull-right">Simpan</button>
        <a href="{{route('FineTransaction.index')}}" class="btn btn-danger">Batal</a>
	    </div>
	  </form>
	</div>
</div>
@endsection
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
        })
        $(document).on('keyup','#keterlambatan',function () {
            var denda = $('#denda').val();
            var keterlambatan = $('#keterlambatan').val();
            if (keterlambatan == 0) {
              $('#total_bayar').val(denda * 1)
            }else {
              let jumlah = parseInt(keterlambatan)+parseInt(1);
              $('#total_bayar').val(denda * jumlah)
            }
        })

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
