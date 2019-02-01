<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  height: 500px;
}

.header {
  overflow: hidden;
  background-color: #EAEAEA;
  padding: 30px 35%;
}

.header a {
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  color: #494949;
  font-size: 25px;
  font-weight: bold;
}
.btn {
	border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
.btn-default{
  background-color: #22BC66;
  border-top: 10px solid #22BC66;
  border-right: 18px solid #22BC66;
  border-bottom: 10px solid #22BC66;
  border-left: 18px solid #22BC66;
}
.footer_x {
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1rem;
  background-color: #EAEAEA;
  text-align: center;
}
.content{
  padding-top: 35px;
  padding-right: 35px;
  padding-bottom: 35px;
  padding-left: 35px;
}
</style>
</head>
<body>

<div class="header">
  <a href="#default" class="logo">Sistem Akademik</a>
</div>

<div class="content">
  <div class="" style="margin-left: 150px;margin-right: 120px; margin-top:20px">
    <h2>Hallo {{$name}}</h2>
    <p>Anda baru-baru ini meminta untuk mereset kata sandi Anda untuk akun {{$name}} Anda. Gunakan tombol di bawah ini untuk mengatur ulang. Pengaturan ulang kata sandi ini hanya berlaku untuk 24 jam ke depan.</p>
    @component('mail::button', ['url' => route('resetpassword',['token'=>encrypt($name)])])
    Reset your Password
    @endcomponent
    <p>Demi keamanan, permintaan ini diterima dari perangkat  menggunakan https://siakad.rdlvindonesia.com. Jika Anda tidak meminta pengaturan ulang kata sandi, silakan abaikan email ini atau hubungi dukungan jika Anda memiliki pertanyaan.</p>
    <p>Thanks, The sistem Akademik Team</p>
</div>
</div>
<div class="footer_x">@ 2018-2019 sistemAkademik<strong>  All rights reserved.</strong>.</div>
</body>
</html>
