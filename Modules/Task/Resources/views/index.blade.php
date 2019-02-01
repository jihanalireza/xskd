@extends('app.layouts')
@extends('task::additional')
@section('contentheader')
<section class="content-header">
    <h1>
      Tugas
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-graduation-cap"></i> Akademik</a></li>
      <li class="active"><a href="#">Tugas</a></li>
    </ol>
  </section>
@endsection
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}" >
      <div class="box-header">
        <h3 class="box-title">Data Tugas</h3>
        <a href="{{route('create.task')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"> Tambah Data</i></a>
      </div>
      <div class="box-body">
        <table id="example2" class="table table-bordered table-hover" style="width:100%;">
          <thead>
          <tr>
            <th>No</th>
            <th>Id Sekolah</th>
            <th>Kelas</th>
            <th>Guru</th>
            <th>Judul Tugas</th>
            <th>Attachment</th>
            <th>Deskripsi</th>
            <th>Opsi</th>
          </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
            @foreach ($task as $itemstaks)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $itemstaks->sekolah->id_sekolah }}</td>
                <td>{{ $itemstaks->kela->nama_kelas }}</td>
                <td>{{ $itemstaks->guru->nama_guru }}</td>
                <td>{{ $itemstaks->judul_tugas }}</td>
                <td>{{ $itemstaks->attachment }}</td>
                <td>{{ $itemstaks->deskripsi }}</td>
                <td>
                  <a href="{{ route('edit.task',['id_tugas' => $itemstaks->id_tugas]) }}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"> Edit data</i></a>
                  <form action="{{ route('deleteTask',['id_tugas' => $itemstaks->id_tugas]) }}" method="POST" class="form_delete{{$itemstaks->id_tugas}}" >
                   @csrf @method('DELETE')
                   <button id="delete_button" type="submit" class="btn btn-danger delete_button" key="{{$itemstaks->id_tugas}}" title="Delete Data"><i class="fa fa-trash"></i> Hapus Data</button>
                  </form>
                  {{-- <a href="{{ route('deleteTask',['id_tugas' => $itemstaks->id_tugas]) }}" class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i> Hapus Data</a> --}}
                </td>
              </tr>
            @endforeach
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
@stop
