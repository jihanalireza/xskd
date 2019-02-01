@section('title')
Data Nilai
@endsection
@section('jsplus')
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.responsive.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script>
  $(document).ready(function() {
    $('.StudentAttendance').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'responsive'  : true,
      'autoWidth'   : false
    });
  });

  // option choosee class with ajax
  $('#id_class').on('change', function(event) {
    var id = $(this).val();
    $.ajax({
      url: location.origin+'/studentattendance/show_student/'+id,
      type: 'get',
      data: {param: id},
    })
    .done(function(data) {

      var isi = "";
      var isi1 = "";
      var information = '';
      let nisn = '';

      // foreach data absensi student
      $.each(data.absent, function(indexs, item) {
        nisn +=item;
        if (item.masuk == 1) {
          information ='masuk';
        }else if (item.ijin == 1) {
          information ='izin';
        }else if (item.sakit == 1) {
          information ='sakit';
        }else if (item.alfa == 1) {
          information ='alfa';
        }
        console.log(data.absent);
        if (item != null) {
          isi1 += '<tr><td>'+item.siswa.nisn+'</td>\
          <td>'+item.siswa.nama_siswa+'</td>\
          <td>'+information+'</td><tr>';
        }else {
          isi1 += '<tr><td colspan="3" style="text-align: center"> Belum ada Siswa di Absent</td><tr>';
        }
      });
      $('#itemAbsent').html(isi1);
      // foreach data student
      $.each(data.student, function(index, el) {
        var absent = data.absent;
        var arrayabsent = Object.keys(absent).map(function(k) { return absent[k] });
        var dataabsent = arrayabsent.filter( obj => obj.id_siswa === el.id_siswa);
        if (dataabsent.length <= 0) {
            isi += '<tr><td>'+el.nisn+'</td>\
                    <td>'+el.nama_siswa+'</td>\
                    <td>'+'<a href="#" class="btn btn-success absen" classid="'+id+'" idStudent="'+el.id_siswa+'" name="'+el.nama_siswa+'">Absen</a>'+'</td></tr>';
        }
      });
      $('#Student').html(isi);
    })
    .fail(function() {
      console.log("error");
    });
  });

  // button abbsen to show modal
  $(document).on('click','.absen',function(event) {
    $('.radioAbsen').prop('checked', false);
    $('.show-btn-uploadfile').empty();

    name = $(this).attr('name');
    id = $(this).attr('idStudent');
    idclass = $(this).attr('classid');
    $('#absen').modal('show');
    $('#nameStudent').text(name);
    $('#studentid').val(id);
    $('#classstudent').val(idclass);
  });

  // checkedd radio button
  $(document).on("change",".radioAbsen",function(event) {
    $('.proccesAbsen').removeAttr('disabled', true)
    $('.show-btn-uploadfile').empty();
    value = $(this).val();
    $('#valueAbsen').val(value);
    if (value == 'izin' || value == 'sakit') {
        $('.show-btn-uploadfile').html('<br><label for="" class="control-label">Lampirkan Surat Bukti Ketidakhadiran :</label>\
                    <input type="file" name="fileInformation[]" class="btn btn-primary" id="fileinformation" multiple><div class="notif-warning"></div>');

    }
  });

  // button proccess absensi
  $(document).on('submit','#formabsen',function(event){
    event.preventDefault();
    absen = $(document).find('#valueAbsen').val();
    file = $('#fileinformation').val();
    if (file == '') {
      $('.notif-warning').html('<p style="color:red; padding-left:10px;">Inputan tidak boleh Kosong</p>')
    }else{
        token = $('#token').val();
        idstudent =   $('#studentid').val();
        idclass =   $('#classstudent').val();
        var form = new FormData(this);

        if ($('#fileinformation').val() != undefined) {
          files =   $('#fileinformation').prop('files')[0];
          form.append('file',files);
        }

        $.ajax({
          headers:{
            'X-CSRF-TOKEN':token,
          },
          type:'post',
          async: false,
          url: location.origin+'/studentattendance/procces_Absent/',
          cache: false,
          contentType: false,
          processData: false,
          data: form,
          success: function(data){
            // data for loaddata student
            var param = {
                  idclass : idclass,
                  methode : 'get',
                  url     : '/studentattendance/loaddatastudent/',
                  _token   : token
                };
              // call function ajax to get data student
            var data = loaddata(param);
            $('#Student').html(data);
            // value data for loaddata absent
            var params = {
                  idclass : idclass,
                  methode : 'get',
                  url     : '/studentattendance/loaddataabsent/',
                  _token   : token
                };
            // call ajax to get data absent
            var item = loaddata(params);
            $('#itemAbsent').html(item);
            $('#absen').modal('hide');   /** modal hide **/
          }
        });
    }
  });

// load data after absent student
  function loaddata(param)
  {
    var returnt = '';
    $.ajax({
      headers:{
        'X-CSRF-TOKEN':param._token,
      },
      type:param.method,
      async: false,
      url: location.origin+param.url,
      data: param,
      success: function(data){
        returnt = data;
      }
    });

    return returnt;
  }

</script>
@endsection
