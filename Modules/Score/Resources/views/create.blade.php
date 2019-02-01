@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Nilai
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-graduation-cap"></i> Akademik</a></li>
      <li class="active"><a href="#">Tambah Nilai</a></li>
    </ol>
  </section>
@endsection
@section('content')
<div class="box">
	<div class="box box-primary">
	  <div class="box-header with-border">
	    <h3 class="box-title">Tambah Data Nilai</h3>
	  </div>
	  <form action="{{route('saveScoredata')}}" method="post">
      @method('POST') @csrf()
	    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @if($errors->has('id_kelas')) has-error @endif">
            <label>Kelas</label>
              <select class="form-control select2" name="id_kelas" style="width: 100%;" id="class">
                <option value="" >Pilih Kelas</option>
                @foreach($dataclass as $itemclass)
                  <option value="{{ $itemclass->id_kelas }}" >{{ $itemclass->nama_kelas }}</option>
                @endforeach
              </select>
            @if($errors->has('id_kelas')) <span class="help-block">{{ $errors->first('id_kelas') }}</span> @endif
          </div>
        </div>
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
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @if($errors->has('uts')) has-error @endif">
            <label>Nilai UTS</label>
            <input type="number" min="0" max="100" class="form-control" name="uts" value="{{ old('uts') }}" placeholder="Nilai UTS">
            @if($errors->has('uts')) <span class="help-block">{{ $errors->first('uts') }}</span> @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group @if($errors->has('uas')) has-error @endif">
            <label>Nilai UAS</label>
            <input type="number" min="0" max="100" class="form-control" name="uas" value="{{ old('uas') }}" placeholder="Nilai UAS">
            @if($errors->has('uas')) <span class="help-block">{{ $errors->first('uas') }}</span> @endif
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @if($errors->has('tugas')) has-error @endif">
            <label>Nilai Tugas</label>
            <input type="number" min="0" max="100" class="form-control" name="tugas" value="{{ old('tugas') }}" placeholder="Nilai Tugas">
            @if($errors->has('tugas')) <span class="help-block">{{ $errors->first('tugas') }}</span> @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group @if($errors->has('ulangan_harian')) has-error @endif">
            <label>Ulangan Harian</label>
            <input type="number" min="0" max="100"class="form-control" name="ulangan_harian" value="{{ old('ulangan_harian') }}" placeholder="Ulangan Harian">
            @if($errors->has('ulangan_harian')) <span class="help-block">{{ $errors->first('ulangan_harian') }}</span> @endif
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
	    <!-- /.box-body -->

	    <div class="box-footer">
	      <button type="submit" class="btn btn-success pull-right">Simpan</button>
        <a href="{{route('indexScoredata')}}" class="btn btn-danger">Batal</a>
	    </div>
	  </form>
	</div>
</div>
@endsection
@section('jsplus')
<script>
 // alert('kelas');
 $('#class').on('change', function(event) {
    var kelas = $(this).val();
    // alert(kelas);
    $.ajax({
      url: location.origin+'/score/Showsiswa',
      type: 'get',
      data: {param: kelas},
    })
    .done(function(data) {
      var isi = "";
      $.each(data, function(index, el) {
        isi += '<option value="'+el.id_siswa+'">'+el.nama_siswa+'</option>'
      });
      console.log(isi);
      $('#siswa').html(isi);
    })
    .fail(function() {
      console.log("error");
    });

  });
</script>
@endsection
