@extends('app.layouts')
@extends('teacherdata::additional')
@section('contentheader')
<section class="content-header">
    <h1>
      Data Guru
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Data Guru</a></li>
    </ol>
  </section>
@endsection
@section('content')
  <div class="container-fluid">
    <div class="col-log-12">
      @if (Session('update'))
       <div class="alert alert-success" role="alert">
           <strong>Update Success!</strong> Update data was successfully.
       </div>
       <?php Session('update');?>
       @endif
       <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}">
        <div class="box-header">
          <h3 class="box-title"> Data Guru</h3>
          <a href="{{ route('createTeacherdata') }}" class="btn btn-primary pull-right" title="tambah data"> <i class="fa fa-plus"></i> Tambah data</a>
        </div>
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover" style="width:100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Almat</th>
                <th>No Tlp</th>
                <th>Email</th>
                <th>Foto</th>
                <th>opsi</th>
              </tr>
              </thead>
          <tbody>
            @foreach ($dataTheacher as $key => $data)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$data->nama_guru}}</td>
              <td>{{$data->alamat}}</td>
              <td>{{$data->nomor_tlp}}</td>
              <td>{{$data->email}}</td>
              <td><img src="{{ env('API_URL') }}/{{ $data->foto }}" style="width:100px;height:100px;"></td>
              <td>
                  <a href="{{ route('formupdateTeacherdata',['idTeacher'=> $data->id_guru ]) }}" class="btn btn-warning" title="edit data" > <li class="fa fa-edit"></li> Edit data</a>
                  <form class="form_delete_{{$data->id_guru}}" action="{{route('deleteTeacherdata', ["id" => $data->id_guru])}}" method="POST" id="form_delete">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger delete_button" data="{{$data->id_guru}}"><i class="fa fa-trash"></i> Hapus Data</button>
                  </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
@stop
