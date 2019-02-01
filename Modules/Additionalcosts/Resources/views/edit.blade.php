@extends('app.layouts')
@extends('additionalcosts::additional')
@section('contentheader')
<section class="content-header">
    <h1>
      Ubah Pembyaran Lain-lain
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cart-plus"></i> Transaksi Lainnya</a></li>
      <li class="active"><a href="#">Ubah Pembayaran Lain-lain</a></li>
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
      <h2>Update Data Biaya lain </h2>
      <div class="clearfix"></div>
      </div>
        <div class="x_content">
          <div class="row clearfix">
            <form action="{{route('Additionalcosts.update')}}" method="post" enctype="multipart/form-data">
              <div class="container-fluid">
                @csrf @method('patch')
                <input type="hidden" name="id_tr_biayalain" value="{{$edit_Additionalcost->id_tr_biayalain}}" />
                <div class="col-md-6">
                  <label for="" class="control-label">Nama Biaya</label>
                  <div class="form-group">
                    <input type="text" name="nama_biaya" value="{{$edit_Additionalcost->nama_biaya}}" class="form-control" placeholder="Nama Biaya" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="" class="control-label">Detail</label>
                  <div class="form-group">
                    <input type="text" name="detail" value="{{$edit_Additionalcost->detail}}" class="form-control" placeholder="Detail" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="" class="control-label">Total Pembayaran</label>
                  <div class="form-group">
                    <input type="number" min="0" name="total_pembayaran" value="{{$edit_Additionalcost->total_pembayaran}}" class="form-control" placeholder="Total Pembayaran" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @if($errors->has('id_siswa')) has-error @endif">
                    <label>NISN</label>
                    <select name="id_siswa" class="js-get-siswa form-control" id="kece">
                      <option value="">- Pilih Nisn siswa-</option>
                      @foreach ($select_siswa as $key => $items)
                        <option @if ($items->id_siswa == $edit_Additionalcost->siswa->id_siswa) selected @endif value="{{$items->id_siswa}}">{{$items->nisn}}</option>
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
