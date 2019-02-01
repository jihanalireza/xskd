@extends('app.layouts')
@extends('studentdata::additional')
@section('contentheader')
<section class="content-header">
    <h1>
      Data Siswa
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-database"></i> Master Data</a></li>
      <li class="active"><a href="#">Data Siswa</a></li>
    </ol>
  </section>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}">
            <div class="box-header">
                <h3 class="box-title">Data Siswa</h3>
                <a href="{{ route('create.student') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"> Tambah Data</i></a>
            </div>
            <div class="box-body">
                <table id="student_table" class="table table-bordered table-hover display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="20"></th>
                            <th>No</th>
                            <th>Nisn</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Foto</th>
                            <th width="200">Option</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Nomor Tlp</th>
                            <th>Nama Ayah</th>
                            <th>Nama Ibu</th>
                            <th>Tlp Ayah</th>
                            <th>Tlp Ibu</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student_data as $no => $value)
                        <tr data-child-value="{{ json_encode($value) }}">
                            <td class="details-control"></td>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $value->nisn }}</td>
                            <td>{{ $value->nama_siswa }}</td>
                            <td>{{ $value->kela->nama_kelas }}</td>
                            <td><img src="{{env('API_URL')}}/{{$value->foto }}" style="width:100px;height:100px"></td>
                            <td width="200">
                                <a href="studentdata/siswa/{{ $value->id_siswa }}" class="btn btn-warning" title="Edit Data"><i
                                        class="fa fa-pencil"> Edit Data</i></a>
                                <form class="form_delete_{{$value->id_siswa}}" action="{{route('studentdata.delete', ["id" => $value->id_siswa])}}" method="POST" id="form_delete">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete_button" data="{{$value->id_siswa}}"><i class="fa fa-trash"></i> Hapus Data</button>
                                </form>
                            </td>
                            <td>{{ $value->jenis_kelamin }}</td>
                            <td>{{ $value->alamat }}</td>
                            <td>{{ $value->nomor_tlp }}</td>
                            <td>{{ $value->nama_ayah }}</td>
                            <td>{{ $value->nama_ibu }}</td>
                            <td>{{ $value->tlp_ayah }}</td>
                            <td>{{ $value->tlp_ibu }}</td>
                            <td>{{ $value->tempat_lahir }}</td>
                            <td>{{ $value->tgl_lahir }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@stop