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
// proses hapus data
if (isset($_GET['aksi']))
{
	if ($_GET['aksi'] == 'hapus')
	{
		// baca ID dari parameter ID lama pinjaman yang akan dihapus
		$id = $_GET['id_lama'];
		// proses hapus data lama pinjaman berdasarkan ID via method
		$lama->hapusLama($id);	
	}

	// proses edit data
	else if ($_GET['aksi'] == 'edit')
	{
		// baca ID lama pinjaman yang akan diedit
		$id = $_GET['id_lama'];
		// menampilkan form edit lama pinjaman
		// untuk menampilkan data detil lama pinjaman, gunakan method bacaDataLama()
?>
<link rel="stylesheet" href="kalender/calendar.css" type="text/css">
<script type="text/javascript" src="kalender/calendar.js"></script>
<script type="text/javascript" src="kalender/calendar2.js"></script>
<script>
	function checkForm(formZ){
		if(formZ.lama.value==''){
			alert('Lama Pinjaman tidak boleh kosong, Silahkan masukkan Lama pinjaman');
			formZ.lama.focus();
			return false;
		}
	}
</script>
<b>LAMA PINJAMAN</b>
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
	<form name="lama" action="?page=lama_edit&aksi=update" method="post" onsubmit="return checkForm(this)">
	  <tr><td><input name="id" type="hidden" value="<?php echo $lama->bacaDataLama('id',$id); ?>"></td></tr>
	    <tr>
			
			<td width="15%"><div class="tabtxt">Lama Pinjaman</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="lama" style="width:200px" type="textfield" class="tfield" value="<?php echo $lama->bacaDataLama('lama',$id); ?>">
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td>
				<input name="submit" type="submit" class="button" value="UPDATE" >&nbsp;&nbsp;
				</td>
		</tr>
	</form>
</table>
<?php 
	}
	else if ($_GET['aksi'] == 'update')
	{
		$lama->updateDataLama($_POST['id'], $_POST['lama']);
	}	
}
?>