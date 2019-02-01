<div class="modal fade" id="absen">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Absen Siswa</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover">
          <tbody>
            <tr>
              <form id="formabsen" action="" method="post" enctype="multipart/form-data">
                @csrf
                <td id="nameStudent" style="padding-left:10px;"></td>
                <td width=300>
                  <div class="form-group">
                      <div class="radio">
                      <label for="" class="control-label">
                        <input type="radio" name="absensi" value="masuk" id="radio-1" class="radioAbsen">
                        Masuk
                      </label>
                      <label for="" class="control-label">
                        <input type="radio" name="absensi" value="izin" id="radio-2" class="radioAbsen">
                        Izin
                      </label>
                      <label for="" class="control-label">
                        <input type="radio" name="absensi" value="sakit" id="radio-3" class="radioAbsen">
                        Sakit
                      </label>
                      <label for="" class="control-label">
                        <input type="radio" name="absensi" value="alpa" id="radio-4" class="radioAbsen">
                        Alpa
                      </label>
                      </label>
                    </div>
                  </div>
                </td>
                <input type="hidden" name="informationabsent" id="valueAbsen" value="">
                <input type="hidden" name="idstudent" id="studentid" value="">
                <input type="hidden" name="classstudent" id="classstudent" value="">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
            </tr>
        </tbody>
      </table>
      <div class="show-btn-uploadfile">
        <!-- show button upload file -->
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success proccesAbsen" disabled>Simpan</button>
      </div>
    </div>
  </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
