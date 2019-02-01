

<div class="modal fade" id="Acc{{$additionalCost->id_tr_biayalain}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Default Modal</h4>
      </div>
      <form  action="{{ Route('Additionalcosts.acc') }}" method="post">
        @csrf @method('PATCH')
      <div class="modal-body">
        <input type="hidden" name="id_tr_biayalain" value="{{$additionalCost->id_tr_biayalain}}">
        <input type="hidden" name="email" value="joniliwong69@gmail.com">
        <input type="hidden" name="Status" value="Acc">
        <center>atas Nama :
          <h3>{{$additionalCost->siswa->nama_siswa}} </h3> sudah melakukan pembayaran</center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-success">Acc</button>
      </div>
    </form>
    </div>
  </div>
</div>
