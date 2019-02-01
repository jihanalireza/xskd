@extends('app.layouts')
@section('content')
    <section class="content">
      <div class="row">
        <section class="col-lg-12">
          <!-- History Image -->
          <div class="box box-info">
            <div class="box-header with-border">
              <i class="fa fa-image"></i>
              <h3 class="box-title">History Image</h3>

              <div class="box-tools pull-right">
                <span class="label label-primary"><span id="count_files"></span> Image</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">

                <center>
                  <div class="w3-content w3-display-container" style="max-width:800px">
                    <div id="show-history-slider">
                    </div>


                    <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
                      <div class="w3-left w3-hover-text-khaki" style="color:aqua" onclick="plusDivs(-1)">&#10094;</div>
                      <div class="w3-right w3-hover-text-khaki" style="color:aqua" onclick="plusDivs(1)">&#10095;</div>

                      <div id="currentDiv">
                      </div>
                  </div>

                </div>
                </center>

              </div>
            </div>
          </div>

              <!-- Chatting -->
          <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-comments-o"></i>
              <h3 class="box-title">Chat Group</h3>
              <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
              </div>
            </div>
            <div class="box-body chat" id="chat-box">
              <!-- chat item -->
              <div class="item" hidden id="clone">
                <img src="dist/img/user3-128x128.jpg">
                <p class="message">
                  <a class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> </small>
                  </a>
                  <span class="messagev2">
                  </span>
                </p>
              </div>
              <!-- /.item -->
            </div>
            <!-- /.chat -->
            <div class="box-footer">
              <div class="input-group">
                <input class="form-control value-message-group" placeholder="Type message...">
                <!-- FILE -->
                  <div class="input-group-btn">
                      <input type="file" class="add-file" style="display:none" value="">
                    <button type="button" class="upload-file btn btn btn-info"><i class="fa fa-file-image-o"></i></button>
                  </div>
                  <!-- SEND -->
                  <div class="input-group-btn">
                    <button type="button" class="add-message-group btn btn-success"><i class="fa fa-send"></i></button>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </section>

    <!-- Modal Detail Image -->
   <div id="myModal" class="modal">
     <br><br><br>
     <img class="modal-content" id="showImage">
     <div id="caption"></div>
   </div>
@stop
@section('jsplus')
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase.js"></script>
<script>
// random string
function random_string() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < 50; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}
  // get sekolah
  var id_sekolah = "<?php echo session()->get('sekolah')['id_sekolah'] ?>";
  var nama_sekolah = "<?php echo session()->get('sekolah')['nama_sekolah'] ?>";
  // Tooltip
  $(document).find('.value-message-group').tooltip({
  trigger: 'manual',
  placement: 'top',
  title: 'Can not be empty',
  });

  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDI3kP9p0Z8piyUYNQDEjk4Wp8j9qQR9bc",
    authDomain: "message-intratrainingcenter.firebaseapp.com",
    databaseURL: "https://message-intratrainingcenter.firebaseio.com",
    projectId: "message-intratrainingcenter",
    storageBucket: "message-intratrainingcenter.appspot.com",
    messagingSenderId: "10946710934"
  };
  firebase.initializeApp(config);
  var db = firebase.database();
  var storage = firebase.storage();
  var message = db.ref('message');
  var storageRef = storage.ref('files')
  message.on('value',showData,error);

  //WARNING add message with enter
  $(document).on('keypress','.value-message-group',function (e) {
    if(e.which == 13) {
        if ($(document).find('.value-message-group').val() == '' ) {
          $(document).find('.value-message-group').tooltip('show');
          setTimeout(function(){ $(document).find('.value-message-group').tooltip('hide'); }, 2000);
        }else {
          addData()
        }
    }
  })

  //WARNING add message with click
  $(document).on('click','.add-message-group',function () {
    if ($(document).find('.value-message-group').val() == '' ) {
      $(document).find('.value-message-group').tooltip('show');
      setTimeout(function(){ $(document).find('.value-message-group').tooltip('hide'); }, 2000);
    }else {
      addData()
    }
  })

  function addData() {
    var value = $(document).find('.value-message-group').val();
    message.push({
          id: Date.now(),
          id_username: id_sekolah,
          username: nama_sekolah,
          value: value,
          created_at:new Date().toLocaleString()
    })
    $(document).find('.value-message-group').val('');
    $("#chat-box").animate({ scrollTop: $('#chat-box').prop("scrollHeight")}, 1000);
  }

  function showData(result) {
    date = new Date().toLocaleString();
    var value = $(document).find('.value-message-group').val();
    $(document).find('.chat-group').remove();
    // slider
    $(document).find('#show-history-slider').empty();
    $(document).find('#currentDiv').empty();
    $(document).find('#count_files').empty();

      // WARNING show chatting
      result.forEach(function(result2) {
        $(document).find('#clone').clone().appendTo('#chat-box').attr('id',result2.val().id).attr('class','item chat-group').removeAttr('hidden');
        $(document).find('#'+result2.val().id+' p').attr('key',result2['key']).attr('class','message remove_chat');
        // show username
            if (id_sekolah == result2.val().id_username) {
        $(document).find('#'+result2.val().id+' .message .name').append('saya');
            }else {
        $(document).find('#'+result2.val().id+' .message .name').append(result2.val().username);
            }
        //show message if image
            if (result2.val().value.substring(0,4) == 'IMG-') {
                  if (id_sekolah == result2.val().id_username) {
                    $(document).find('#'+result2.val().id+' .message').append("<img image='"+result2.val().image+"' height='125px' alt='upload by saya' data-toggle='modal' data-target='#myModal' class='myImg' src='" + result2.val().value.substring(4, result2.val().value.length - 3) + "' >");
                  }else {
                    $(document).find('#'+result2.val().id+' .message').append("<img image='"+result2.val().image+"' height='125px' alt='upload by "+ result2.val().username +"' data-toggle='modal' data-target='#myModal' class='myImg' src='" + result2.val().value.substring(4, result2.val().value.length - 3) + "' >");
                  }
            }else {
        $(document).find('#'+result2.val().id+' .message').append(result2.val().value);
            }
        // show datetime
            if (result2.val().created_at.substring(0,10) == date.substring(0,10)) {
        $(document).find('#'+result2.val().id+' .message .name small').append(result2.val().created_at.substring(11,23));
            }else {
        $(document).find('#'+result2.val().id+' .message .name small').append(result2.val().created_at.substring(0,23));
            }
    })

    // WARNING clone slider history image
    var count_files='';
    var currentDiv='1';
    result.forEach(function(result2) {
      if (result2.val().value.substring(0,4) == 'IMG-') {
        count_files++
            if (currentDiv == '1') {
                    if (id_sekolah == result2.val().id_username) {
                      $("<img class='mySlides myImg' data-toggle='modal' data-target='#myModal' alt='upload by saya' src='"+ result2.val().value.substring(4, result2.val().value.length - 3) +"' style='width:100%;height:220px;'>").appendTo('#show-history-slider');
                    }else {
                      $("<img class='mySlides myImg' data-toggle='modal' data-target='#myModal' alt='upload by "+result2.val().username+"' src='"+ result2.val().value.substring(4, result2.val().value.length - 3) +"' style='width:100%;height:220px;'>").appendTo('#show-history-slider');
                    }
                    $("<span class='w3-badge demo w3-border w3-transparent w3-hover-white w3-white' onclick='currentDiv("+ currentDiv++ +")'></span>").appendTo('#currentDiv');
            }else {
                    if (id_sekolah == result2.val().id_username) {
                      $("<img class='mySlides myImg' style='display:none' data-toggle='modal' data-target='#myModal' alt='upload by saya' src='"+ result2.val().value.substring(4, result2.val().value.length - 3) +"' style='width:100%;height:220px;'>").appendTo('#show-history-slider');
                    }else {
                      $("<img class='mySlides myImg' style='display:none' data-toggle='modal' data-target='#myModal' alt='upload by "+result2.val().username+"' src='"+ result2.val().value.substring(4, result2.val().value.length - 3) +"' style='width:100%;height:220px;'>").appendTo('#show-history-slider');
                    }
                    $("<span class='w3-badge demo w3-border w3-transparent w3-hover-white' onclick='currentDiv("+ currentDiv++ +")'></span>").appendTo('#currentDiv');
            }
      }
    })
    if (!count_files) {
      $(document).find('#count_files').append('0');
    }else {
      $(document).find('#count_files').append(count_files);
    }
  }

  function error(result) {
    console.log('no internet access');
  }

  //WARNING Upload File
    $(document).on('click','.upload-file',function () {
       $(document).find('.add-file').click();
    })
    $(document).on('change','.add-file',function (e) {
    var rndm_strng = random_string()+'.jpg';
    var name = e.target.files[0];
    var storageRef = storage.ref('files/' + rndm_strng )
    // add to storage
    var uploadTask = storageRef.put(name)

    uploadTask.on('state_changed', null, error, completeUpload)

    function error(result) {
      console.log('no internet access');
    }
    function completeUpload(data) {
    console.log('suceess');
      // add to database
       storageRef.getDownloadURL().then(function(url){
            message.push({
                  id: Date.now(),
                  id_username: id_sekolah,
                  username: nama_sekolah,
                  image: rndm_strng,
                  value: 'IMG-' + url,
                  created_at:new Date().toLocaleString()
           })
       });
       $("#chat-box").animate({ scrollTop: $('#chat-box').prop("scrollHeight")}, 1000);
      }
    $(document).find('.add-file').val('');
    })

    //WARNING Delete Data
    $(document).on('click','.remove_chat',function () {
      var key = $(this).attr('key');
      message.child(key).remove()
      var image = $(this).find('img').attr('image');
      var deleteStorage = storageRef.child(image);

        deleteStorage.delete().then(function() {
          console.log('sucess');
        }).catch(function(error) {
          console.log('eror');
        });
    })
    message.on('child_removed', removeData);


    function removeData() {
      alert('success');
    }

    //WARNING Show Image
    $(document).on('click','.myImg',function () {
      $(document).find('.modal-content').empty();
      $(document).find('#caption').empty();
      $(document).find('#showImage').attr('src',$(this).attr('src'));
      $(document).find('#caption').append($(this).attr('alt'));
    })

    //WARNING slider
    var slideIndex = 1;

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function currentDiv(n) {
      showDivs(slideIndex = n);
    }
    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
         dots[i].className = dots[i].className.replace(" w3-white", "");
      }
        x[slideIndex-1].style.display = "block";
        x[slideIndex-1].style.width = "100%";
        x[slideIndex-1].style.height = "220px";
        dots[slideIndex-1].className += " w3-white";
    }

</script>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('dist/css/w3.css')}}">
<style>
#myImg:hover {opacity: 0.7;}

#myImg:hover {opacity: 0.7;}
.modal-content {
    margin: auto;
    display: block;
}
.modal-content, #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
    height: 450px;
}
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px;
    height: 150px;
}
@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)}
    to {-webkit-transform:scale(1)}
}
/* slider */
.w3-badge {height:13px;width:13px;padding:0}
</style>
@endsection
