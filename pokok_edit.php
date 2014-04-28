<?php 
include_once 'include/class.php';
include_once 'include/lib.php';

// instansiasi objek user
$user = new User();
// instansiasi objek nsb
$pokok = new pokokPinjaman();

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
		// baca ID dari parameter ID pokok pinjaman yang akan dihapus
		$id = $_GET['id_pokok'];
		// proses hapus data pokok pinjaman berdasarkan ID via method
		$pokok->hapusPokok($id);	
	}

	// proses edit data
	else if ($_GET['aksi'] == 'edit')
	{
		// baca ID lama pinjaman yang akan diedit
		$id = $_GET['id_pokok'];
		// menampilkan form edit pokok pinjaman
		// untuk menampilkan data detil pokok pinjaman, gunakan method bacaDataPokok()
?>

<link rel="stylesheet" href="kalender/calendar.css" type="text/css">
<script type="text/javascript" src="kalender/calendar.js"></script>
<script type="text/javascript" src="kalender/calendar2.js"></script>
<script>
	function checkForm(formZ){
		if(formZ.pokok.value==''){
			alert('Pokok Pinjaman tidak boleh kosong, Silahkan masukkan Pokok pinjaman');
			formZ.pokok.focus();
			return false;
		}
	}
</script>
<b>POKOK PINJAMAN</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=pokok_mgr">DATA</a> &raquo; <b>POKOK PINJAMAN</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="pokok" action="?page=pokok_edit&aksi=update" method="post" onsubmit="return checkForm(this)">
	  <tr><td><input name="id" type="hidden" value="<?php echo $pokok->bacaDataPokok('id',$id); ?>"></td></tr>
	    <tr>
			
			<td width="15%"><div class="tabtxt">Pokok Pinjaman</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="pokok" style="width:200px" type="textfield" class="tfield" value="<?php echo $pokok->bacaDataPokok('pokok',$id); ?>" >
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
		$pokok->updateDataPokok($_POST['id'], $_POST['pokok']);
	}	
}
?>