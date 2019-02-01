@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Ubah Nilai
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-graduation-cap"></i> Akademik</a></li>
      <li class="active"><a href="#">Ubah Nilai</a></li>
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
               <h2>Update Data Nilai</h2>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">
               <div class="row clearfix">
                <form action="{{route('update_nilai')}}" method="post">
                  <div class="container-fluid">
                    @csrf
                    <input type="hidden" name="id_nilai" value="{{ $datascore->id_nilai }}" />
                    <div class="col-md-6">
                      <div class="form-group @if($errors->has('id_kelas')) has-error @endif">
                        <label>Kelas</label>
                          <select class="form-control select2" name="id_kelas"value="value="{{ $datascore->id_kelas }}"" style="width: 100%;" id="class">
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
                          <select class="form-control select2" name="id_siswa" value="{{ $datascore->id_siswa }}" style="width: 100%;" id="siswa">
                            <option value="" >Pilih Siswa</option>
                            @foreach($datastudent as $itemsiswa)
                              <option value="{{ $itemsiswa->id_siswa }}" >{{ $itemsiswa->nama_siswa }}</option>
                            @endforeach
                          </select>
                        @if($errors->has('id_siswa')) <span class="help-block">{{ $errors->first('id_siswa') }}</span> @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="" class="control-label">Nilai Uts</label>
                      <div class="form-group">
                          <input type="number" name="uts" min="0" max="100" value="{{ $datascore->uts }}" class="form-control" placeholder="Masukan Nilai Uts" required="true" />
                      </div>
                  </div>
                  <div class="col-md-6">
                      <label for="" class="control-label">Nilai Uas</label>
                      <div class="form-group">
                          <input type="number" name="uas" min="0" max="100" value="{{ $datascore->uas }}" class="form-control" placeholder="Masukan Nilai Uas" required="true" />
                      </div>
                  </div>
                  <div class="col-md-6">
                      <label for="" class="control-label">Nilai Tugas</label>
                      <div class="form-group">
                          <input type="number" name="tugas" min="0" max="100" value="{{ $datascore->tugas }}" class="form-control" placeholder="Masukan Nilai Uas" required="true" />
                      </div>
                  </div>
                  <div class="col-md-6">
                   <label for="" class="control-label">Ulangan Harian</label>
                   <div class="form-group">
                       <input type="number" min="0" max="100" name="ulangan_harian" value="{{ $datascore->ulangan_harian }}" class="form-control" placeholder="Masukan Nilai Uas" required="true" />
                   </div>
               </div>
                <div class="ln_solid"></div>
                 <div class="form-group">
                   <div class="col-md-12">
                     <button type="submit" class="btn btn-success pull-right">Simpan</button>
                     <a href="{{route('indexScoredata')}}" class="btn btn-danger">Batal</a>
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
