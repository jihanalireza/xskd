@extends('app.layouts')
@section('title')
    Data Schedule
@endsection
@section('contentheader')
<section class="content-header">
    <h1>
     Tambah Jadwal Pelajaran
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-graduation-cap"></i> Akademik</a></li>
      <li class="active"><a href="#">Tambah Jadwal Pelajaran</a></li>
    </ol>
  </section>
@endsection
@section('content')
<div class="box">
	<div class="box box-primary">
	  <div class="box-header with-border">
	    <h3 class="box-title">Create Jadwal Mata Pelajaran</h3>
	  </div>
	  <form action="{{route('SaveSchedule')}}" method="post">
      @method('POST') @csrf()
	    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @if($errors->has('mata_pelajaran')) has-error @endif">
            <label>Mata Pelajaran</label>
              <select class="form-control select2" name="mata_pelajaran" style="width: 100%;">
                <option value="" >Pilih Mata Pelajaran</option>
                @foreach($datalesson as $itemlesson)
                  <option value="{{ $itemlesson->id_mapel }}" >{{ $itemlesson->nama_mapel }}</option>
                @endforeach
              </select>
            @if($errors->has('mata_pelajaran')) <span class="help-block">{{ $errors->first('mata_pelajaran') }}</span> @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group @if($errors->has('kelas')) has-error @endif">
            <label>Kelas</label>
              <select class="form-control select2" name="kelas" style="width: 100%;">
                <option value="" >Pilih Kelas</option>
                @foreach($dataclass as $itemclass)
                  <option value="{{ $itemclass->id_kelas }}" >{{ $itemclass->nama_kelas }}</option>
                @endforeach
              </select>
            @if($errors->has('kelas')) <span class="help-block">{{ $errors->first('kelas') }}</span> @endif
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @if($errors->has('jam_masuk')) has-error @endif">
            <label>Jam Masuk</label>
            <input type="text" value="08:00 AM" class="form-control timepicker" readonly="" name="jam_masuk" id="jam_masuk">
            @if($errors->has('jam_masuk')) <span class="help-block">{{ $errors->first('jam_masuk') }}</span> @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group @if($errors->has('jam_selesai')) has-error @endif">
            <label>Jam Selesai</label>
            <input type="text" value="09:00 AM" class="form-control timepicker" readonly="" name="jam_selesai" id="jam_selesai">
            @if($errors->has('jam_selesai')) <span class="help-block">{{ $errors->first('jam_selesai') }}</span> @endif
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @if($errors->has('hari')) has-error @endif">
            <label>Hari</label>
              <select class="form-control select2" name="hari" style="width: 100%;">
                <option selected disabled>Pilih Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
              </select>
            @if($errors->has('hari')) <span class="help-block">{{ $errors->first('hari') }}</span> @endif
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
	    <!-- /.box-body -->

	    <div class="box-footer">
        <button type="submit" class="btn btn-success pull-right">Simpan</button>
        <a href="{{route('indexSchedule')}}" class="btn btn-danger">Batal</a>
	    </div>
	  </form>
	</div>
</div>
@endsection
@section('jsplus')
<script>
$(document).ready(function(){
	$('.timepicker').timepicker({
      showInputs: false
    })
})
$("#jam_masuk").on('change',function(event) {
    let jamMasuk = converthours($(this).val());
    let jamSelesai = converthours($('#jam_selesai').val());
    if(jamSelesai <= jamMasuk){
        swal({
          title: "Are you sure?",
          text: "Hours must not be less than the time of entry!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        });

        $('#jam_masuk').val("08:00 AM");
        $('#jam_selesai').val("09:00 AM");
    }
  });


  $("#jam_selesai").on('change',function(event) {
    let jamMasuk = converthours($('#jam_masuk').val());
    let jamSelesai = converthours($(this).val());
    if(jamSelesai <= jamMasuk){
        swal({
          title: "Are you sure?",
          text: "Hours must not be less than the time of entry!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        });

        $('#jam_masuk').val("08:00 AM");
        $('#jam_selesai').val("09:00 AM");
    }
  });


  function converthours(Hours){
   let hasil = moment(Hours, "h:mm A").format("HH:mm");
   return hasil;
  }
</script>
@endsection
