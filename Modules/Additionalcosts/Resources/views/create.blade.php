@extends('app.layouts')
@extends('additionalcosts::additional')
@section('contentheader')
<section class="content-header">
    <h1>
      Tambah Pembyaran Lain-lain
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cart-plus"></i> Transaksi Lainnya</a></li>
      <li class="active"><a href="#">Tambah Pembayaran Lain-lain</a></li>
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
      <h2>Tambah Data Biaya lain </h2>
      <div class="clearfix"></div>
      </div>
        <div class="x_content">
          <div class="row clearfix">
            <form action="{{ route('Additionalcosts.add') }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('post')
              <div class="container-fluid">
                <div class="col-md-6">
                    <div class="form-group @if($errors->has('nama_biaya')) has-error @endif">
                    <label>Nama Biaya Lain</label>
                    <input type="text" class="form-control" name="nama_biaya" value="{{ old('nama_biaya') }}">
                    @if($errors->has('nama_biaya')) <span class="help-block">{{ $errors->first('nama_biaya') }}</span> @endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @if($errors->has('detail')) has-error @endif">
                    <label>Detail</label>
                    <input type="text" class="form-control" name="detail" value="{{ old('detail') }}">
                    @if($errors->has('detail')) <span class="help-block">{{ $errors->first('detail') }}</span> @endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @if($errors->has('total_pembayaran')) has-error @endif">
                    <label>Total Pembayaran</label>
                    <input type="number" min="0" class="form-control" name="total_pembayaran" value="{{ old('total_pembayaran') }}">
                    @if($errors->has('total_pembayaran')) <span class="help-block">{{ $errors->first('total_pembayaran') }}</span> @endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @if($errors->has('id_siswa')) has-error @endif">
                    <label>NISN</label>
                    <select name="id_siswa" class="js-get-siswa form-control" id="kece">
                      <option value="">- Pilih Nisn siswa-</option>
                      @foreach ($student as $key => $items)
                        <option value="{{$items->id_siswa}}">{{$items->nisn}}</option>
                      @endforeach
                    </select>
                    @if($errors->has('id_siswa')) <span class="help-block">{{ $errors->first('id_siswa') }}</span> @endif
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-12"><br>
                    <a href="{{route('Additionalcosts.index')}}" style="float:left" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" style="float:right" class="btn btn-success">
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
