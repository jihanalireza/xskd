@extends('app.layouts')
@section('contentheader')
  @if(session()->get('role')['id_role'] == 5)
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>
  @else
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>
  @endif
@endsection
@section('content')
@if(session()->get('role')['id_role'] == 5)
      <!-- Content Header (Page header) -->
     
        <!-- Main content -->
        <section class="content">
          <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}">
          <div class="row">
            <div class="col-md-3">
    
              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="{{ env('API_URL') }}/{{session()->get('sekolah')['foto_guru']}}" alt="User profile picture">
    
                  <h3 class="profile-username text-center">{{session()->get('sekolah')['nama_guru']}}</h3>
                  <p class="text-muted text-center">Guru</p>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
    
              <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                  <p class="text-muted">
                      {{session()->get('sekolah')['email']}}
                  </p>
                  <hr>
                  <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
                  <p class="text-muted">{{session()->get('sekolah')['alamat']}}</p>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab">Riwayat Pelatihan</a></li>
                  <li><a href="#timeline" data-toggle="tab">Riwayat Pendidkan</a></li>
                  <li><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <table id="example2" class="table table-bordered table-hover" style="width:100%;">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pelatihan</th>
                        <th>Jenis Pelatihan</th>
                        <th>Tanggal Pelatihan</th>
                      </tr>
                      </thead>
                      <tbody>
                        @php
                          $no = 1;
                        @endphp
                        @foreach ($pelatihan as $itemsclass)
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $itemsclass->nama_pelatihan }}</td>
                            <td>{{ $itemsclass->jenis_pelatihan }}</td>
                            <td>{{ $itemsclass->tanggal_pelatihan }}</td>
                          </tr>
                    @endforeach
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      @foreach($pendidikan as $item)
                      <li class="time-label">
                            <span class="bg-green">
                                {{ $item->tanggal_masuk }}
                            </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-graduation-cap bg-blue"></i>
    
                        <div class="timeline-item">
                          <span class="time">{{$item->jenjang}}</span>
    
                        <h3 class="timeline-header"><a href="#">{{$item->nama_sekolah}}</a></h3>
                        </div>
                      </li>
                      @endforeach
                      <!-- END timeline item -->
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                      </li>
                    </ul>
                  </div>
                  <!-- /.tab-pane -->
    
                  <div class="tab-pane" id="settings">
                    <div class="form-horizontal">
                      <h2>Riwayat Pelatihan </h2>
                      <hr>
                      <form action="/simpansertifikasi" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="formsertifikasi">
                          <hr>
                          <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Nama Pelatihan</label>
        
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputName"  name="namapelatihan[]" placeholder="Nama pelatihan">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label"  >Jenis Pelatihan</label>
        
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputEmail" name="jenispelatihan[]" placeholder="Jenis pelatihan">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label" >Tanggal Pelatihan</label>
        
                            <div class="col-sm-10">
                              <input type="date" class="form-control" id="inputName" name="tanggalpelatihan[]" placeholder="Name">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputExperience" class="col-sm-2 control-label">Foto Sertifikasi</label>
         
                            <div class="col-sm-10">
                              <input type="file" class="form-control" id="inputExperience" placeholder="Experience" name="fotosertifikasi[]">
                            </div>
                          </div>
                        </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                          </div>
                    </form>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button class="btn btn-primary" id="addsertifikasi"><i class="fa fa-plus"></i> Tambah Pelatihan</button>
                        </div>
                      </div>
                      <h2>Riwayat Pendidikan </h2>
                      <hr>
                      <form action = "/simpanpendidikan" method="POST">
                        @csrf
                      <div id="tes">
                        <hr>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Nama Sekolah</label>
      
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Nama Sekolah" name="namasekolah[]">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail" class="col-sm-2 control-label" >Jenjang Pendidikan</label>
      
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" placeholder="Jenjang Pendidikan" name="jenjangpendidikan[]">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Tahun Masuk</label>
      
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName"name="tanggalmasuk[]" placeholder="Tahun masuk ajaran">
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" onclick="toggle('#hilang', this)">Sampai Sekarang</a>
                                </label>
                              </div>
                            </div>
                          </div>
                        <div class="form-group" id="hilang">
                          <label for="inputExperience" class="col-sm-2 control-label">Tahun Selesai</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputExperience" name="tanggalselesai[]" placeholder="Tahun Selesai atau lulus">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                      </form>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button class="btn btn-primary" id="addjenjang"><i class="fa fa-plus"></i> Tambah Pendidikan</button>
                          </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
    
        </section>
        <!-- /.content -->
@else
@endif
@endsection
@section('jsplus')
<script>
  
  function toggle(className, obj) {
      var $input = $(obj);
      if ($input.prop('checked')) $(className).hide();
      else $(className).show();
    }
    $(document).ready(function(){
        let response = $('.box').attr('response');
        let message = $('.box').attr('message');
        console.log(response);
        if(response == 'success'){
          swal("Action Success!", message, "success");
        }else if(response == 'error'){
          swal("Action Error!", message, "error");
        }
        $("#addjenjang").click(function(){        
            $( "#tes" ).clone().appendTo( "#tes" );
        })
        $("#addsertifikasi").click(function(){        
            $( "#formsertifikasi" ).clone().appendTo( "#formsertifikasi" );
        })
    })
</script>
@endsection