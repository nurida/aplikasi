<?php 
if (!$user->get_sesi())
{
header("location:index.php");
} 
 ?>
		<ul>
			<li><a href="?page=home">Home</a></li>
			<li><a href="?page=nasabah_mgr">Nasabah</a></li>
            <li><a href="?page=pokok_mgr">Pokok Pinjaman</a></li>
            <li><a href="?page=lama_mgr">Lama Pinjaman</a></li>
			<li><a href="?page=pinjaman_mgr">Pinjaman</a></li>
            <li><a href="?page=logout">Keluar</a></li>
		</ul>
