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
  background-color: #79D3EE;
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
	background-color:#0099C6;
}
.footer_x {
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1rem;
  background-color: #CACACA;
  text-align: center;
}
</style>
</head>
<body>

<div class="header">
  <a href="#default" class="logo">Intra Training</a>
</div>
<div style="padding-left:150px;padding-top:50px;height:300px;">
    <h2>Hallo {{$name}}</h2>
    <p>Are you receiving this email because we recaived a password reset request for your account</p>
    @component('mail::button', ['url' => route('resetpassword',['token'=>encrypt($name)])])
    Reset Password
    @endcomponent

</div>
<div class="footer_x">@ 2018-2019 IntraTraining<strong>  All rights reserved.</strong>.</div>
</body>
</html>
