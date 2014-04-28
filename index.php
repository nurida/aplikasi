<?php  
error_reporting(0);
session_start();
include_once 'include/class.php';

// instance objek db dan user
$user = new User();
$db = new Database();

// koneksi ke MySQL via method
$db->connectMySQL();

// cek apakah user login atau tidak via method
if($user->get_sesi()) {
  header("location:admin.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $login=$user->cek_login($_POST['username'], $_POST['passwd']);
  if($login) {
    // login sukses, arahkan ke file admin.php
    header("location:admin.php");
  }
  else {
  // login gagal, beri peringatan dan kembali ke file index.php
  ?>
  <script language="javascript">
		alert("Maaf, User Atau Password Anda salah!!");
		document.location="index.php";
	</script>
  <?php  
  }
}
?>

<html>
<head>
<title>Halaman Login Aplikasi Pembayaran Angsuran</title>
<link href="css/login-box.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="padding: 100px 0 0 250px;">
<div id="login-box">
<H2>Login Aplikasi</H2>
<br /><br />
<form method="post" name="login" >

<div id="login-box-name" style="margin-top:20px;">Username:</div> 
<div id="login-box-field" style="margin-top:20px;">
<input name="username" class="form-login" title="username" value="" size="30" maxlength="2048" /></div>

<div id="login-box-name">Password:</div>
<div id="login-box-field"><input name="passwd" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div><br />

<input type="image" src="images/login-btn.png" width="103" height="42" style="margin-left:90px";>
</form>
</div>
</div>
</body>
</html>
