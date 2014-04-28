<?php 
include_once 'include/class.php';
include_once 'include/lib.php';

// instansiasi objek user
$user = new User();
// instansiasi objek nsb
$nsb = new Nasabah();

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
		// baca ID dari parameter ID nasabah yang akan dihapus
		$id = $_GET['id_nsb'];
		// proses hapus data nasabah berdasarkan ID via method
		$nsb->hapusNasabah($id);	
	}

	// proses edit data
	else if ($_GET['aksi'] == 'edit')
	{
		// baca ID nasabah yang akan diedit
		$id = $_GET['id_nsb'];
		// menampilkan form edit nasabah
		// untuk menampilkan data detil nasabah, gunakan method bacaDataNasabah()
?>
<link rel="stylesheet" href="kalender/calendar.css" type="text/css">
<script type="text/javascript" src="kalender/calendar.js"></script>
<script type="text/javascript" src="kalender/calendar2.js"></script>
<script>
	function checkForm(formZ){
		if(formZ.nama.value==''){
			alert('Nama Nasabah tidak boleh kosong.');
			formZ.nama.focus();
			return false;
		}
		if(formZ.alamat.value==''){
			alert('Alamat tidak boleh kosong.');
			formZ.alamat.focus();
			return false;
		}
		if(formZ.tmpt_lahir.value==''){
			alert('Tempat lahir tidak boleh kosong.');
			formZ.tmpt_lahir.focus();
			return false;
		}
		if(formZ.tgl_lahir.value==''){
			alert('Tanggal lahir tidak boleh kosong.');
			formZ.tgl_lahir.focus();
			return false;
		}
		if(formZ.ktp.value==''){
			alert('Nomor KTP tidak boleh kosong.');
			formZ.ktp.focus();
			return false;
		}
		if(formZ.telp.value==''){
			alert('Telpon tidak boleh kosong.');
			formZ.telp.focus();
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
				<a href="?page=nasabah_mgr">DATA</a> &raquo; <b>EDIT NASABAH</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="nasabah" action="?page=nasabah_edit&aksi=update" method="post" onsubmit="return checkForm(this)">
		<tr>
			<td width="15%"><div class="tabtxt">ID Nasabah</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
		  <input name="id" style="width:100px" type="textfield" class="tfield"  value="<?php echo $nsb->bacaDataNasabah('id', $id); ?>" readonly>
			</td>
    </tr>        
      <tr>
			<td width="15%"><div class="tabtxt">Nama Nasabah</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="nama" style="width:200px" type="textfield" class="tfield" value="<?php echo $nsb->bacaDataNasabah('nama', $id); ?>">
			</td>
		</tr>
		<tr>
			<td><div class="tabtxt">Tempat, Tgl. Lahir</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
				<input name="tmpt_lahir" style="width:100px" type="textfield" class="tfield" value="<?php echo $nsb->bacaDataNasabah('tmpt_lahir', $id); ?>">&nbsp;		
				<input name="tgl_lahir" style="width:80px" type="textfield" id="tgl" class="tfield" value="<?php echo tgl_eng_to_ind($nsb->bacaDataNasabah('tgl', $id)); ?>" readonly>
				<a href="JavaScript:;" onClick="return showCalendar('tgl', 'dd-mm-y');"><img border=0 src="images/ico_calendar.gif" align="top"></a>
			</td>
		</tr>
		<tr>
			<td valign="top"><div class="tabtxt">Alamat</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<textarea name="alamat" style="width:200px" class="tfield" rows="4"><?php echo $nsb->bacaDataNasabah('alamat', $id); ?></textarea>
			</td>
		</tr>
        <tr>
			<td><div class="tabtxt">Nomor KTP</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
				<input name="ktp" style="width:200px" type="textfield" class="tfield" value="<?php echo $nsb->bacaDataNasabah('ktp', $id); ?>">
			</td>
		</tr>
		<tr>
			<td><div class="tabtxt">Telpon</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
				<input name="telp" style="width:200px" type="textfield" class="tfield" value="<?php echo $nsb->bacaDataNasabah('telpon', $id); ?>">
			</td>
		</tr>
		<tr>
			<td><div class="tabtxt">E-mail</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
				<input name="email" style="width:200px" type="textfield" class="tfield" value="<?php echo $nsb->bacaDataNasabah('email', $id); ?>">
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td>
				<input name="submit" type="submit" class="button" value="Update">&nbsp;&nbsp;
				<input type="button" class="button" value="Batal" onclick=self.history.back()>
				</td>
		</tr>
	</form>
</table>
<?php
	}
	else if ($_GET['aksi'] == 'update') {
		// update data nasabah via method
		$nsb->updateDataNasabah($_POST['id'], $_POST['nama'], $_POST['ktp'], $_POST['tmpt_lahir'], tgl_ind_to_eng($_POST['tgl_lahir']), 
                            $_POST['alamat'], $_POST['telp'], $_POST['email']);
	} 
}
?>