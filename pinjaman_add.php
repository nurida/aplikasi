<?php
include_once 'include/class.php';
include_once 'include/lib.php';

$user = new User();
$pinjam = new Pinjaman();

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
		$id = $_GET['nopim'];
		// proses hapus data nasabah berdasarkan ID via method
		$pinjam->hapuspinjaman($id);	
	}
	
	else if ($_GET['aksi'] == 'tambah')
	{

?>
<link rel="stylesheet" href="kalender/calendar.css" type="text/css">
<script type="text/javascript" src="kalender/calendar.js"></script>
<script type="text/javascript" src="kalender/calendar2.js"></script>
<script>
	function checkForm(formZ){
		if(formZ.tgl.value==''){
			alert('Tanggal Pinjaman tidak boleh kosong, Silahkan Pilih Tanggal');
			formZ.tgl.focus();
			return false;
		}
		if(formZ.nama.value==0){
			alert('Nama Nasabah tidak boleh kosong, Silahkan pilih Nama');
			formZ.nama.focus();
			return false;
		}
		if(formZ.pokok.value==0){
			alert('Pokok Pinjaman tidak boleh kosong, Silahkan pilih Pokok');
			formZ.pokok.focus();
			return false;
		}
		if(formZ.bunga.value==''){
			alert('Bunga Pinjaman tidak boleh kosong, Silahkan masukkan Bunga');
			formZ.bunga.focus();
			return false;
		}
		if(formZ.lama.value==0){
			alert('Lama Pinjaman tidak boleh kosong, Silahkan pilih Lama');
			formZ.lama.focus();
			return false;
		}
	}
</script>
<b>PINJAMAN</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=pinjaman_mgr">DATA</a> &raquo; <b>PINJAMAN</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="pinjaman" action="?page=pinjaman_add&aksi=tambah" method="post" onsubmit="return checkForm(this)">
		<tr>
			<td valign="top"><div class="tabtxt">No Pinjaman</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<input name="no" style="width:100px" type="textfield" class="tfield" readonly value="<?php echo kdauto("pinjaman","PN"); ?>">
			</td> 
		</tr>
		<tr>
			<td width="15%"><div class="tabtxt">Tanggal Pinjaman</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
		<input name="tgl" style="width:100px" type="textfield" id="tgl" class="tfield" value="" readonly>
		<a href="JavaScript:;" onClick="return showCalendar('tgl', 'dd-mm-y');"><img border=0 src="images/ico_calendar.gif" align="top"></a>
			</td>   
      </tr>     
        <tr>
			<td><div class="tabtxt">Nama Nasabah</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
			<select name="nama" class="tfield_a">
			<option value="0" selected="selected">Pilih Nama Nasabah</option>
			<?php
			//Tampilkan combo nama nasabah
			$arrayNama=$pinjam->comboNama();
			foreach($arrayNama as $datanama)
			{
			?>
				<option value="<?php  echo $datanama['id']; ?>"><?php  echo $datanama['nama']; ?></option>
			<?php } ?>
			
			</select>	
			</td>
		</tr>
		  <tr>
			<td><div class="tabtxt">Pokok Pinjaman</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
			<select name="pokok" class="tfield_a">
			<option value="0" selected="selected">Pilih Pokok Pinjaman</option>
			<?php 
			//Tampilkan combo pokok pinjaman
			$arrayPokok=$pinjam->comboPokok();
			foreach($arrayPokok as $datapokok)
			{
			?>
				<option value="<?php  echo $datapokok['pokok']; ?>"><?php  echo $datapokok['pokok']; ?></option><?php 
			}
			?>
			</select>	
			</td>
		</tr>
		<tr>
			<td valign="top"><div class="tabtxt">Bunga Pinjaman</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<input name="bunga" style="width:100px" type="textfield" class="tfield">&nbsp;&nbsp; %
			</td> 
		</tr>
       <tr>
			<td><div class="tabtxt">Lama Pinjaman</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
			<select name="lama" class="tfield_a">
			<option value="0" selected="selected">Pilih Lama Pinjaman</option>
			<?php 
			//Tampilkan combo lama pinjaman
			$arrayLama=$pinjam->comboLama();
			foreach($arrayLama as $datalama)
			{
			?>
				<option value="<?php  echo $datalama['lama']; ?>"><?php  echo $datalama['lama']; ?></option><?php 
			}
			?>
			</select> &nbsp;&nbsp; bulan	
			</td>
		</tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			<td>
				<input name="submit" type="submit" class="button" value="Simpan" >&nbsp;&nbsp;
				<input type="button" class="button" value="Batal" onclick=self.history.back()>
			</td>
		</tr>
	</form>
</table>
<?php
			$tgl_eng=substr($_POST['tgl'],6,4)."-".substr($_POST['tgl'],3,2)."-".substr($_POST['tgl'],0,2); 
			//simpan data pinjaman lewat method simpanPinjaman()
			if($_POST['submit']){
				//panggil hasil hitung angsuran dari method hitungAngsuran()
				$angsuran = $pinjam->hitungAngsuran($_POST['lama'], $_POST['pokok'], $_POST['bunga']);
				$pinjam->simpanPinjaman($_POST['no'],$tgl_eng, $_POST['pokok'], $_POST['lama'], $_POST['bunga'], $angsuran, $_POST['nama']);
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=pinjaman_mgr">'; 
			}
}
}			
?>