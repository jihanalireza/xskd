@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">

<style>
td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_close.png') no-repeat center center;
}
</style>
@endsection
@section('jsplus')
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.responsive.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>

<script type="text/javascript">

//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
})

   function format(value) {
      return '<div class="slider">'+
        '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td>Jenis Kelamin: </td>'+
                '<td> '+value.jenis_kelamin+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Alamat: </td>'+
                '<td> '+value.alamat+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Nomor Telp: </td>'+
                '<td> '+value.nomor_tlp+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Nama Ayah: </td>'+
                '<td> '+value.nama_ayah+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Nama Ibu: </td>'+
                '<td> '+value.nama_ibu+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Telp Ayah: </td>'+
                '<td> '+value.tlp_ayah+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Telp Ibu: </td>'+
                '<td> '+value.tlp_ibu+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Tempat Lahir: </td>'+
                '<td> '+value.tempat_lahir+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Tgl Lahir: </td>'+
                '<td> '+value.tgl_lahir+'</td>'+
            '</tr>'+
        '</table>'+
    '</div>';
  }
  $(document).ready(function() {
    let response = $('.box').attr('response');
    let message = $('.box').attr('message');
    console.log(response);
    if(response == 'success'){
      swal("Action Success!", message, "success");
    }else if(response == 'error'){
      swal("Action Error!", message, "error");
    }

   var table = $('#student_table').DataTable({
    "columnDefs": [
            {
                "targets": [ 7 ],
                "visible": false,
            },
            {
                "targets": [ 8 ],
                "visible": false
            },
            {
                "targets": [ 9 ],
                "visible": false
            },
            {
                "targets": [ 10 ],
                "visible": false
            },
            {
                "targets": [ 11 ],
                "visible": false
            },
            {
                "targets": [ 12 ],
                "visible": false
            },
            {
                "targets": [ 13 ],
                "visible": false
            },
            {
                "targets": [ 14 ],
                "visible": false
            },
            {
                "targets": [ 15 ],
                "visible": false
            },
        ],
        "scrollX": true
   });

      // Add event listener for opening and closing details
      $('#student_table').on('click', 'td.details-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row(tr);

          if (row.child.isShown()) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          } else {
              // Open this row
              row.child(format(tr.data('child-value'))).show();
              tr.addClass('shown');
          }
      });

    $(".delete_button").on("click", function (event) {
        event.preventDefault();
        var id = $(this).attr('data');
        console.log(id);
        swal({
            title: "Apa Anda Yakin?",
            text: "Yakin Menghapus Data Siswa", type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Iya",
            closeOnConfirm: false
        },
        function () {
            {{--  submit dengan clas dari form delete  --}}
            $('.form_delete_'+id).submit();
        });
    });
  });
</script>
@endsection
