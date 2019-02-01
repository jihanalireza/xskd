@section('title')
    Data Teacher
@endsection
@section('jsplus')
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.responsive.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    let response = $('.box').attr('response'); 
    let message = $('.box').attr('message'); 
    console.log(response);
    if(response == 'success'){
      swal("Action Success!", message, "success");
    }else if(response == 'error'){
      swal("Action Error!", message, "error");
    }
    
    $('#example').DataTable();
    setTimeout(function(){ $('.alert-success').hide(1000); }, 5000);
  });

  $(".delete_button").on("click", function (event) {
      event.preventDefault();
      var id = $(this).attr('data');
      console.log(id);
      swal({
          title: "Apa Anda Yakin?",
          text: "Yakin Menghapus Data Guru", type: "warning",
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
</script>
@endsection
