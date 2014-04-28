<?php 
include_once 'include/class.php';
$user = new User();
if (!$user->get_sesi())
{
header("location:index.php");
}
 ?>
<div class="subtitle" align="left">
<img src="images/uang.jpg" align="left" width="300" height="225" /> &nbsp;&nbsp;&nbsp;&nbsp;
	<p> Selamat Datang di <br>
	<br />
	<b>Program Aplikasi Pembayaran Angsuran Bank Lokomedia</b> dibuat dengan teknik Pemrograman Berbasis Objek (OOP). 
  Bebeberapa modul yang terdapat dalam aplikasi ini meliputi: 
	<br /><br />
	<b>1. Modul Nasabah</b>, yang berfungsi untuk mengelola data nasabah (tambah, edit ataupun hapus).
	<br />
	<b>2. Modul Pokok Pinjaman</b>, yang berfungsi untuk mengelola data pokok pinjaman (tambah, edit ataupun hapus).
	<br />
	<b>3. Modul Lama Pinjaman</b>, yang berfungsi untuk mengelola berapa lama pinjaman yang boleh dimiliki nasabah (tambah, edit ataupun hapus).
	<br />
	<b>4. Modul Pinjaman</b>, yang berfungsi untuk membuat pinjaman baru bagi nasabah dan mengelolanya. 
  Dalam Modul ini juga terdapat fungsi pembayaran angsuran, melihat data angsuran beserta dendanya. 
	<br /><br /><b> Semoga berguna, sehingga dapat Anda kembangkan sendiri untuk kesempurnaan aplikasi.	</b>
	</p></div><br>

