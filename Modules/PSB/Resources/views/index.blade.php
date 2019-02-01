@extends('psb::layouts.master')
@extends('psb::additional')

@section('content')

<div class="col-md-6 col-xs-8 col-md-offset-3 col-xs-offset-2" style="margin-top:20px; margin-bottom:20px;">
    <div class="register-box-body">
        <div class="box" response="{{ Session::get('response') }}" message="{{ Session::get('message') }}"></div>
        <h1>Penerimaan Siswa Baru</h1>
        <form id="the_form" action="{{route('psb.store')}}" method="post" enctype="multipart/form-data">
            @csrf @method('POST')
            <h3>Data Diri</h3>
            <fieldset style="margin-bottom:50px">
                <legend>Data Diri</legend>
                <label >Nama lengkap</label>
                <input name="nama_siswa" type="text" class="required form-control">
                <label >Jenis Kelamin</label>
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input class="minimal" type="radio" name="jenis_kelamin" value="laki-laki" checked="">
                      Laki - laki
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input class="minimal" type="radio" name="jenis_kelamin" value="perempuan">
                        Perempuan
                    </label>
                  </div>
                </div>
                <label >NISN</label>
                <input name="nisn" type="number" class="required form-control">
                <label >NIK</label>
                <input name="nik" type="number" class="required form-control">
                <label >Tempat , Tanggal Lahir</label>
                <input name="tempat_tgl_lahir" type="text" class="required form-control"value=" , " >
                <label >Agama</label>
                <select name="agama" class="required form-control">
                    <option value="">-</option>
                    <option value="islam">Islam</option>
                    <option value="kristen">Kristen</option>
                    <option value="hindu">Hindu</option>
                    <option value="budha">Budha</option>
                </select>
                <label >Status Keluarga</label>
                <input name="status_keluarga" type="text" class="required form-control">
                <label >Anak Ke</label>
                <input name="anak_ke" type="number" class="required form-control">
                <label >Jumlah Saudara Kandung</label>
                <input name="jml_saudara_kandung" type="number" class="required form-control">
                <label >Sekolah Asal</label>
                <input name="sekolah_asal" type="text" class="required form-control">
                <label >Foto</label>
                <input type="file" class="required form-control" name="foto" >
            </fieldset>
        
            <h3>Data Wali</h3>
            <fieldset>
                {{--  data ayah  --}}
                <legend>Data Ayah</legend>
                <label >Nama Ayah</label>
                <input name="nama_ayah" type="text" class="required form-control">
                <label >Tempat, Tanggal Lahir Ayah</label>
                <input name="ttl_ayah" type="text" class="required form-control">
                <label >Pekerjaan Ayah</label>
                <input name="pekerjaan_ayah" type="text" class="required form-control">
                <label >Pendidikan Ayah</label>
                <input name="pendidikan_ayah" type="text" class="required form-control">
                <label >Penghasilan Ayah</label>
                <input name="penghasilan_ayah" type="number" class="required form-control">
                {{--  data ibu  --}}
                <br>
                <legend>Data Ibu</legend>
                <label >Nama Ibu</label>
                <input name="nama_ibu" type="text" class="required form-control">
                <label >Tempat, Tanggal Lahir Ibu</label>
                <input name="ttl_ibu" type="text" class="required form-control">
                <label >Pekerjaan Ibu</label>
                <input name="pekerjaan_ibu" type="text" class="required form-control">
                <label >Pendidikan Ibu</label>
                <input name="pendidikan_ibu" type="text" class="required form-control">
                <label >Penghasilan Ibu</label>
                <input name="penghasilan_ibu" type="number" class="required form-control">
                {{--  data wali   --}}
                <br>
                <legend>Data Wali</legend>
                <label >Nama Wali</label>
                <input name="nama_wali" type="text" class="required form-control">
                <label >Tempat, Tanggal Lahir Wali</label>
                <input name="ttl_wali" type="text" class="required form-control">
                <label >Pekerjaan Wali</label>
                <input name="pekerjaan_wali" type="text" class="required form-control">
                <label >Pendidikan Wali</label>
                <input name="pendidikan_wali" type="text" class="required form-control">
                <label >Penghasilan Wali</label>
                <input name="penghasilan_wali" type="number" class="required form-control">
            </fieldset>
        
            <h3>Alamat</h3>
            <fieldset>
                <legend>Alamat Siswa</legend>
                <label >Jenis tinggal</label>
                <input name="jenis_tinggal" type="text" class="required form-control">
                <label >Alamat</label>
                <input name="alamat" type="text" class="required form-control">
                <label >RT/RW</label>
                <input name="rt_rw" type="text" class="required form-control">
                <label >Kelurahan/Desa</label>
                <input name="kelurahan" type="text" class="required form-control">
                <label >Kode Pos</label>
                <input name="kode_pos" type="number" class="required form-control">
                <label >Kecamatan</label>
                <input name="kecamatan" type="text" class="required form-control">
                <label >Kabupaten/Kota</label>
                <input name="kabupaten" type="text" class="required form-control">
                <label >Provinsi</label>
                <input name="provinsi" type="text" class="required form-control">
            </fieldset>
        
            <h3>Profile</h3>
            <fieldset>
                <legend>Profile Siswa</legend>
                <label >Tinggi Badan</label>
                <input name="tinggi_badan" type="number" class="required form-control">
                <label >Berat Badan</label>
                <input name="berat_badan" type="number" class="required form-control">
                <label >Telepon / Hp</label>
                <input name="nomor_tlp" type="text" class="required form-control">
                <label >Jarak Rumah ke Sekolah</label>
                <input name="jarak" type="number" class="required form-control">
                <label >Kendaraan Ke Sekolah</label>
                <input name="alat_transportasi" type="text" class="required form-control">
                <label >Email</label>
                <input name="email" type="email" class="required form-control">
            </fieldset>
        </form>
    </div>
</div>
@stop