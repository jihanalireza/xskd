@extends('app.layouts')
@section('title')
    Data Schedule
@endsection
@section('contentheader')
<section class="content-header">
    <h1>
      Ubah Jadwal Pelajaran
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-graduation-cap"></i> Akademik</a></li>
      <li class="active"><a href="#">Ubah Jadwal Pelajaran</a></li>
    </ol>
  </section>
@endsection
@section('content')

<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Form Edit data jadwal</h3>
	</div>
	<!-- /.box-header -->
	<form method="PUT" action="{{ route('updateSchedule',['id'=>$dataschedule->id_jadwal]) }}">
		@csrf
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group @if($errors->has('mata_pelajaran')) has-error @endif">
						<label>Mata Pelajaran</label>
							<select class="form-control select2" name="mata_pelajaran" style="width: 100%;">
								<option value="" >Pilih Mata Pelajaran</option>
								@foreach($datalesson as $itemlesson)
									<option @if($itemlesson->id_mapel == $dataschedule->id_mapel) selected @endif value="{{ $itemlesson->id_mapel }}" >{{ $itemlesson->nama_mapel }}</option>
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
									<option @if($itemclass->id_kelas == $dataschedule->id_kelas) selected @endif value="{{ $itemclass->id_kelas }}" >{{ $itemclass->nama_kelas }}</option>
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
						<input type="text" id="jam_masuk" class="form-control timepicker" name="jam_masuk" value="{{ $dataschedule->jam_masuk }}" readonly="">
						@if($errors->has('jam_masuk')) <span class="help-block">{{ $errors->first('jam_masuk') }}</span> @endif
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group @if($errors->has('jam_selesai')) has-error @endif">
						<label>Jam Selesai</label>
						<input type="text" id="jam_selesai" class="form-control timepicker" name="jam_selesai" value="{{ $dataschedule->jam_selesai }}" readonly="">
						@if($errors->has('jam_selesai')) <span class="help-block">{{ $errors->first('jam_selesai') }}</span> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group @if($errors->has('hari')) has-error @endif">
						 <label>Hari</label>
			              <select class="form-control select2" name="hari" style="width: 100%;">
			                <option readonly>Pilih Hari</option>
			                <option @if($dataschedule->hari == 'Senin') selected @endif value="Senin">Senin</option>
			                <option @if($dataschedule->hari == 'Selasa') selected @endif value="Selasa">Selasa</option>
			                <option @if($dataschedule->hari == 'Rabu') selected @endif value="Rabu">Rabu</option>
			                <option @if($dataschedule->hari == 'Kamis') selected @endif value="Kamis">Kamis</option>
			                <option @if($dataschedule->hari == 'Jumat') selected @endif value="Jumat">Jumat</option>
			                <option @if($dataschedule->hari == 'Sabtu') selected @endif value="Sabtu">Sabtu</option>
			              </select>
						@if($errors->has('hari')) <span class="help-block">{{ $errors->first('hari') }}</span> @endif
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<div class="box-footer">
			<a href="{{ route('indexSchedule') }}" type="button" class="btn btn-danger">Batal</a>
			<button type="submit" class="btn btn-success pull-right">Simpan</button>
		</div>
	</form>
	<!-- /.box-footer -->
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
