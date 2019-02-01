@extends('app.layouts')
@extends('studentattendance::additional')
@section('contentheader')
<section class="content-header">
    <h1>
      Absensi Siswa
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="#"><i class="fa fa-book"></i> Absensi Siswa</a></li>
    </ol>
  </section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="box box-primary">
          <div class="box-header">
          <div class="row">
            <div class="box-header">
              <label for="inputEmail3" class="col-md-2 control-label">Pilih Kelas :</label>
              <div class="col-md-10">
              <select class="form-control" name="id_kelas" id="id_class">
                <option value="">Pilih Kelas</option>
                @foreach ($Class as $key => $data)
                  <option value="{{$data->id_kelas}}">{{$data->nama_kelas}}</option>
                @endforeach
              </select>
            </div>
          </div><hr>
          </div>
        <div class="col-md-12">
            <div class="box-header">
              <h3 class="box-title">Data Siswa</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-hover StudentAttendance">
                  <thead>
                      <tr>
                      <th>NISN</th>
                      <th>Nama</th>
                      <th>Option</th>
                      </tr>
                  </thead>
                <tbody id="Student">

                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="box box-primary">
      <div class="box-header">
        <div class="active tab-pane" id="activity">
          <p class="col-md-7">Daftar Siswa Yang Sudah di Absen</p>
          <p class=" col-md-5 pull-right">Tanggal : {{ date('d-M-Y') }}</p>
          <br>
        </div>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>NISN</th>
                <th>Nama</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody id="itemAbsent">
              <tr>
                <td colspan="3" style="text-align: center">Tidak ada data</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
</div>
<!-- include modal absent -->
@include('studentattendance::pop_upabsen')
@stop
