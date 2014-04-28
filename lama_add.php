<?php
include_once 'include/class.php';
include_once 'include/lib.php';
// instansiasi objek user
$user = new User();
// instansiasi objek nsb
$lama = new lamaPinjaman();
$iduser = $_SESSION['id'];
if (!$user->get_sesi())
{
header("location:index.php");
}
?>
<link rel="stylesheet" href="kalender/calendar.css" type="text/css">
<script type="text/javascript" src="kalender/calendar.js"></script>
<script type="text/javascript" src="kalender/calendar2.js"></script>
<script>
	function checkForm(formZ){
		if(formZ.lama.value==''){
			alert('Lama Pinjaman tidak boleh kosong, Silahkan masukkan Lama Pinjaman');
			formZ.lama.focus();
			return false;
		}
	}
</script>
<b>NASABAH</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=lama_mgr">DATA</a> &raquo; <b>LAMA PINJAMAN</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="lama" action="?page=lama_add" method="post" onsubmit="return checkForm(this)">  
        <tr>
			<td width="15%"><div class="tabtxt">Lama Pinjaman</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="lama" style="width:200px" type="textfield" class="tfield">
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td>
				<input name="submit" type="submit" class="button" value="SIMPAN" >&nbsp;&nbsp;
				<input name="Reset" type="Reset" class="button" value="BATAL">
			</td>
		</tr>
	</form>
</table>
<?php
	if($_POST['submit']){
	// tambah data pokok pinjaman via method
	$lama->tambahDataLama($_POST['lama']);
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=lama_mgr">'; 
}
?>