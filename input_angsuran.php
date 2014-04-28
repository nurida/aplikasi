<?php
include_once 'include/class.php';
include_once 'include/lib.php';

$user = new User();
$angsur = new Angsuran();

$iduser = $_SESSION['id'];
if (!$user->get_sesi())
{
header("location:index.php");
}
$nopim = $_GET['nopinjam'];
//ambil data nasabah berdasarkan nomor pinjam
$id_nsb=$angsur->tampilPinjamAngsur('id',$nopim);
?>
<b>ANGSURAN</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=pinjaman_mgr">DATA</a> &raquo; <b>ANGSURAN</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
		<form action="?page=input_angsuran" method="post" name="postform">
		<input type="hidden" value="<?php echo $angsur->tampilPinjamNasabah('id',$id_nsb); ?>" name="id_nasabah"/>
        <input type="hidden" value="<?php echo $angsur->tampilPinjamAngsur('nopim',$nopim); ?>" name="no_pinjam"/>
 		<tr>
			<td width="20%"><div class="tabtxt">Tanggal</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%"><input style="width:200px" name="tgl" type="textfield" class="tfield" readonly="readonly" value="<?php echo date("d-m-Y"); ?>"/></td>
		</tr>
        <tr>
			<td><div class="tabtxt">Nama</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="nama" type="textfield" class="tfield" readonly="readonly" value="<?php echo $angsur->tampilPinjamNasabah('nama',$id_nsb);?>"/></td>
		</tr>
         <tr>
			<td><div class="tabtxt">Alamat</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><textarea name="alamat" style="width:200px" class="tfield" rows="3" /><?php echo $angsur->tampilPinjamNasabah('alamat',$id_nsb); ?></textarea></td>
		</tr>
        <tr>
			<td><div class="tabtxt">Pokok Pinjaman</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="pokok" type="textfield" class="tfield" readonly="readonly" value="<?php echo $angsur->tampilPinjamAngsur('pokok',$nopim);?>"/></td>
		</tr>
          <tr>
			<td><div class="tabtxt">Lama Angsuran</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="lama" type="textfield" class="tfield" readonly="readonly" value=<?php echo $angsur->tampilPinjamAngsur('lama',$nopim)."&nbsp;Kali";?> /></td>
		</tr>
          <tr>
			<td><div class="tabtxt">Bunga</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="bunga" type="textfield" class="tfield" readonly="readonly" value=<?php echo $angsur->tampilPinjamAngsur('bunga',$nopim)."&nbsp;%";?> /></td>
		</tr>
       
<tr>
			<td><div class="tabtxt">Angsuran</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="angsuran" type="textfield" class="tfield" readonly="readonly" value="<?php echo $angsur->tampilPinjamAngsur('angsuran',$nopim);?>"/></td>
		</tr>
<?php       
 	
	//cari angsuran ke berapa lewat method cariAngsur()
	$angsuranke=$angsur->cariAngsuran($nopim);
 	
	//mencari berapa sisa angsuran
	$lamapinj = $angsur->tampilPinjamAngsur('lama',$nopim);
	$sisaangsuran=$angsur->cariSisaAngsur($lamapinj,$angsuranke);

	//pencarian apakah nasabah terkena denda atau tidak
	$tglpinjam=$angsur->tampilPinjamAngsur('tgl',$nopim);
	$tempo_tgl = substr($tglpinjam,8,2);
	$tempo_bln= substr($tglpinjam,5,2);
	$tempo_thn =substr($tglpinjam,0,4);
	
	$angsuran = $angsur->tampilPinjamAngsur('angsuran',$nopim);
	$cekDendaTempo = $angsur->cekDenda($angsuranke,$tempo_bln,$tempo_tgl,$tempo_thn,$angsuran);
	//set value array 0 (value $tglp_tempo) pada method cekDenda() 
	$tgltempo=$cekDendaTempo[0];
	
	//set value array 1 (value $haridenda) pada method cekDenda()
	$haridenda=$cekDendaTempo[1];
	
	//set value array 2 (value $jml_denda) pada method cekDenda()
	$jumlahdenda=$cekDendaTempo[2];
	
	//hitung total bayar
	$totalbayar=$angsur->hitungTotal($angsuran,$jumlahdenda);

?>
    <tr>
			<td><div class="tabtxt">Pembayaran Angsuran Ke -</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="ags_ke" type="textfield" class="tfield" readonly="readonly" value="<?php echo $angsuranke;?>"/></td>
</tr>    
    <tr>
			<td><div class="tabtxt">Sisa Angsuran</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="sisa_ags" type="textfield" class="tfield" readonly="readonly" value=<?php echo $sisaangsuran."&nbsp;Kali";?> /></td>
</tr> 
 <tr>
			<td><div class="tabtxt">Tanggal Jatuh Tempo</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="tempo" type="textfield" class="tfield" readonly="readonly" value="<?php echo $tgltempo ;?>" /></td>
</tr>   
    <tr>
			<td><div class="tabtxt">Denda</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="denda" type="textfield" class="tfield" readonly="readonly" value=<?php echo $haridenda."&nbsp;Hari";?> /></td>
</tr>   
    <tr>
			<td><div class="tabtxt">Jumlah Denda</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="jml_denda" type="textfield" class="tfield" readonly="readonly" value="<?php echo $jumlahdenda;?>"/></td>
</tr> 
<tr>
			<td><div class="tabtxt">Total Bayar Angsuran</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="tobay" type="textfield" class="tfield" readonly="readonly" value="<?php echo $totalbayar;?>"/></td>
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
	if($_POST['submit']){
	$id_nsb=$_POST['id_nasabah'];
	$tgl=$_POST['tgl'];
	$telat=$_POST['denda'];
	$jml_denda=$_POST['jml_denda'];
	$nopim=$_POST['no_pinjam'];
	$lm_angsur=$_POST['lama'];
	$ags_ke=$_POST['ags_ke'];
	$tempo = tgl_ind_to_eng($_POST['tempo']);
	$tgl_eng=substr($tgl,6,4)."-".substr($tgl,3,2)."-".substr($tgl,0,2);
	// tambah data angsuran via method
	//cek apakah angsuran sudah lunas atau belum
	if($lm_angsur-$ags_ke>0){
		$angsur->simpanAngsuran($tgl_eng, $tempo, $ags_ke, $telat, $jml_denda, $nopim, $id_nsb);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=pinjaman_mgr">'; 
	}else {
	$angsur->simpanAngsuran($tgl_eng, $tempo, $ags_ke, $telat, $jml_denda, $nopim, $id_nsb);
	$angsur->updateAngsuran($no_pinjam);
	}
	
}
?>