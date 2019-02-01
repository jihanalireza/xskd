@section('title')
    Data Transaksi BIaya lain
@endsection
@section('css')
@endsection
@section('jsplus')
  <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.responsive.js')}}"></script>
  <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      //select2 custom value
      $(".js-get-siswa").select2({
        minimumInputLength: 2,
        allowClear:true,
        placeholder: 'Pilih Siswa Peminjam',
      });
  })


  </script>

@endsection
