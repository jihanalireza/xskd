@extends('app.layouts')
@section('contentheader')
<section class="content-header">
    <h1>
      Pembyaran Lain-lain
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cart-plus"></i> Transaksi Lainnya</a></li>
      <li class="active"><a href="#">Pembayaran Lain-lain</a></li>
    </ol>
  </section>
@endsection
@section('content')
<div class="row">
 <div class="col-xs-12">
   <div class="box">
     <div class="box-header">
       <h3 class="box-title">Biaya Lain</h3>
       <a href="{{route('Additionalcosts.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
     </div>
     <div class="box-body">
       <table id="example2" class="table table-bordered table-hover" style="width:100%;">
         <thead>
           <tr>
             <th>No</th>
             <th>Nama Siswa</th>
             <th>Nama Biaya</th>
             <th>Detail</th>
             <th>Total Pembayaran</th>
             <th>Bukti Pembayaran</th>
             <th>Status</th>
             <th>Opsi</th>
           </tr>
         </thead>
         <tbody>
           @php
           $no = 1;
           @endphp
           @foreach ($dataAdditionalCosts as $additionalCost)
           <tr>
             <td>{{ $no++ }}</td>
             <td>{{ $additionalCost->id_siswa }}</td>
             <td>{{ $additionalCost->nama_biaya }}</td>
             <td>{{ $additionalCost->detail }}</td>
             <td>{{ $additionalCost->total_pembayaran }}</td>
             <td><img src="{{ env('API_URL') }}/bukti_transaksi/{{ $additionalCost->bukti_pembayaran }}" alt="" style="width:100px;height:100px"></td>
             <td>{{ $additionalCost->status }}</td>
             <td>
               <a href="{{ route('Additionalcosts.edit',['id_tr_biayalain'=>$additionalCost->id_tr_biayalain]) }}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"></i> Edit data</a>
            <button class="btn waves-effect waves-dark btn-danger btn-outline-danger" data-toggle="modal" data-target="#delete_cost"><i class="fa fa-trash"></i> Hapus</button>
        <!--  awal modal delete -->
                     <div class="modal fade" id="delete_cost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Ingin Hapus data ini?</h5>
                           </div>

                       <div class="modal-footer">
                         <form method="post" class="delete_form" action="{{route('Additionalcosts.delete',['id_tr_biayalain'=>$additionalCost->id_tr_biayalain])}}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                           @method('DELETE')
                         {{csrf_field()}}
                         <input type="hidden" name="_method" value="DELETE"/>
                         <button type="submit" class="btn btn-danger">Delete</button>
                       </form>
                           </div>
                         </div>
                       </div>
                     </div>
        <!-- akhir modal delete -->
              @if($additionalCost->bukti_pembayaran)
               <button type="button" class="btn btn-default" data-toggle="modal" data-target="#Acc{{$additionalCost->id_tr_biayalain}}"><i class="fa fa-check"></i>
                Acc
              </button>
              @include('additionalcosts::acc')
              @endif
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