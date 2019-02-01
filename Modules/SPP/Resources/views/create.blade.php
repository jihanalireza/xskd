@extends('app.layouts')
@extends('spp::additional')
@section('contentheader')
<section class="content-header">
    <h1>
     Tambah Monitoring Spp
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cart-plus"></i> Transaksi SPP</a></li>
      <li class="active"><a href="#">Tambah Monitoring SPP</a></li>
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
               <h2>Tambah Data Transaksi SPP</h2>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">
               <div class="row clearfix">
                     <form action="{{route('postspp.store')}}" method="post" enctype="multipart/form-data">
                     <div class="container-fluid">
                     @csrf
                     <div class="col-md-6">
                       <div class="form-group @if($errors->has('siswa')) has-error @endif">
                         <label>Siswa</label>
                         <select name="siswa" class="select2 form-control">
                           <option value="">- Pilih Siswa Peminjam -</option>
                           @foreach($datastudent as $student)
                           <option value="{{$student->id_siswa}}"> {{ $student->nama_siswa }} </option>
                           @endforeach
                         </select>
                         @if($errors->has('siswa')) <span class="help-block">{{ $errors->first('siswa') }}</span> @endif
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group @if($errors->has('parameter')) has-error @endif">
                         <label for="" class="control-label">Tanggal Bayar</label>
                             <select class="form-control" name="parameter" required="">
                               <option value="">--Pilih Tanggal Pembayaran--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
                               <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
                               <option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option>
                               <option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
                               <option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option>
                               <option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option>
                               <option value="31">31</option>
                             </select>
                             @if($errors->has('parameter')) <span class="help-block">{{ $errors->first('parameter') }}</span> @endif
                         </div>
                     </div>
               <div class="col-md-6">
                 <div class="form-group @if($errors->has('biaya_bulanan')) has-error @endif">
                   <label for="" class="control-label">Biaya Perbulan</label>
                   <div class="row">
                     <div class="col-sm-2">
                       <label for="" class="control-label">Rp:</label>
                     </div>
                     <div class="col-sm-10">
                       <input type="number" min="0" name="biaya_bulanan" value="" class="form-control" placeholder="Masukan Biaya Perbulan" required="" />
                     </div>
                   </div>
                       @if($errors->has('biaya_bulanan')) <span class="help-block">{{ $errors->first('biaya_bulanan') }}</span> @endif
                   </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group @if($errors->has('keterlambatan')) has-error @endif">
                   <label for="" class="control-label">Keterlambatan Pembayaran</label>
                   <div class="row">
                     <div class="col-sm-10">
                       <input type="number" min="0" name="keterlambatan" value="" class="form-control" placeholder="Masukan Jumlah Bulan" required="" />
                     </div>
                     <div class="col-sm-2">
                       <label for="" class="control-label">Bulan</label>
                     </div>
                   </div>
                       @if($errors->has('keterlambatan')) <span class="help-block">{{ $errors->first('keterlambatan') }}</span> @endif
                   </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group @if($errors->has('total_pembayaran')) has-error @endif">
                   <label for="" class="control-label">Total Pembayaran</label>
                   <div class="row">
                     <div class="col-sm-2">
                       <label for="" class="control-label">Rp:</label>
                     </div>
                     <div class="col-sm-10">
                       <input type="number" min="0" name="total_pembayaran" value="" class="form-control" placeholder="Masukan Total Pembayaran" required="" />
                     </div>
                   </div>
                       @if($errors->has('total_pembayaran')) <span class="help-block">{{ $errors->first('total_pembayaran') }}</span> @endif
                   </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group @if($errors->has('status')) has-error @endif">
                   <label for="" class="control-label">Status Pembayaran</label>
                       <select class="form-control" name="status" required="">
                         <option value="">--Pilih Status Pembayaran--</option>
                         <option value="Belum Bayar">Belum Bayar</option>
                         <option value="Terbayar">Terbayar</option>
                         <option value="Jatuh Tempo">Jatuh Tempo</option>
                       </select>
                       @if($errors->has('status')) <span class="help-block">{{ $errors->first('status') }}</span> @endif
                   </div>
               </div>
                <div class="ln_solid"></div>
                 <div class="form-group">
                   <div class="col-md-12">
                     <a href="{{route('spp.index')}}" style="float:left" class="btn btn-danger">Batal</a>
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
@section('jsplus')
<script>
$(document).ready(function(){
   //select2 custom value
   $(".select2").select2({
          placeholder: 'masukkan nama siswa',
        });
      $(document).on('keyup','#keterlambatan',function () {
        let keterlambatan = $(this).val();
        let biaya_bulanan = $('#biaya_bulanan').val();
        if (keterlambatan == 0) {
          $('#total_pembayaran').val(0);
          $('#total_pembayaran').val(biaya_bulanan * 1);
        }else {
          let jumlah = parseInt(keterlambatan)+parseInt(1);
          $('#total_pembayaran').val(biaya_bulanan * jumlah);
        }
      });
      $(document).on('keyup','#biaya_bulanan',function () {
        let keterlambatan = $('#keterlambatan').val();
        let biaya_bulanan = $('#biaya_bulanan').val();
        if (keterlambatan == 0) {
          $('#total_pembayaran').val(0);
          $('#total_pembayaran').val(biaya_bulanan * 1);
        }else {
          let jumlah = parseInt(keterlambatan)+parseInt(1);
          $('#total_pembayaran').val(biaya_bulanan * jumlah);
        }
      });
})
</script>
@endsection
