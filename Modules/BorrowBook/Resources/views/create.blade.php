@extends('app.layouts')
@section('content')
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Data Peminjaman Buku</h3>
  </div>
  <form action="{{ route('createborrowbookdata.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('post')
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @if($errors->has('nama_buku')) has-error @endif">
            <label>Nama Buku</label>
            <select name="nama_buku" class="js-get-buku form-control">
              <option value="">- Pilih Buku -</option>
            </select>
            @if($errors->has('nama_buku')) <span class="help-block">{{ $errors->first('nama_buku') }}</span> @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group @if($errors->has('siswa')) has-error @endif">
            <label>NISN</label>
            <select name="siswa" class="js-get-siswa form-control" id="kece">
              <option value="">- Pilih Nisn siswa-</option>
              @foreach($datastudent as $student)
              <option value="{{$student->id_siswa}}"> {{ $student->nisn }} - {{ $student->nama_siswa }} </option>
              @endforeach
            </select>
            @if($errors->has('siswa')) <span class="help-block">{{ $errors->first('siswa') }}</span> @endif
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @if($errors->has('jangka_peminjaman')) has-error @endif">
            <label>Jangka Peminjaman</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="reservation" name="jangka_peminjaman">
            </div>
            @if($errors->has('jangka_peminjaman')) <span class="help-block">{{ $errors->first('jangka_peminjaman') }}</span> @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group @if($errors->has('nama_buku')) has-error @endif">
            <label>Nama Siswa</label>
            <input name="nama" type="text" class="form-control" id="namasiswa" disabled >
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <div class="box-footer">
      <a href="{{ route('borrowbookIndex') }}" type="button" class="btn btn-danger">Batal</a>
      <button type="submit" class="btn btn-success pull-right">Simpan</button>
    </div>
  </form>
  <!-- /.box-footer -->
</div>
@stop
@section('jsplus')
<script>
 $(document).ready(function() {
   $(".js-get-buku").select2({
      minimumInputLength: 2,
      allowClear:true,
      placeholder: 'Masukkan nama buku',
      ajax: {
        url: "{{env('API_URL')}}/buku?id_sekolah="+{{ session()->get('sekolah')['id_sekolah'] }},
        dataType: 'json',
        type: "GET",
        delay: 250,
        data: function (term) {
          return {
            'nama_buku[$like]': term.term+'%'
          };
        },
        beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '{{ session()->get('token') }}'); },
        processResults: function (data, page) {
          return {
            results: $.map(data, function (item) {
              return {
                text: item.nama_buku,
                id: item.id_buku
              }
            })
          };
        },
      }
    });
    $('#kece').change(function(){
      var getnisn = $('.js-get-siswa').val();
      console.log(getnisn);
      $.ajax({
        url: "{{env('API_URL')}}/siswa/"+getnisn,
        dataType: 'json',
        type: "GET",
        beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '{{ session()->get('token') }}'); },
        success : function(data){
          var namasiswa = data.nama_siswa;
          console.log(namasiswa);
          $("#namasiswa").val(namasiswa);
        }
      })
    })
    $(".js-get-siswa").select2({
      minimumInputLength: 2,
      allowClear:true,
      placeholder: 'Pilih Siswa Peminjam',
    });
    $(".js-update-buku").select2({
      minimumInputLength: 2,
      allowClear:true,
      placeholder: 'Pilih Buku',
    });

    $('.datepicker').datepicker({
      autoclose: true
    });
    $('#reservation').daterangepicker();
});
</script>
@endsection
