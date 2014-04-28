<?php
include_once 'include/class.php';
include_once 'include/lib.php';

$user = new User();
$pokok = new pokokPinjaman();

$iduser = $_SESSION['id'];
if (!$user->get_sesi())
{
header("location:index.php");
}
?>
<b>DATA POKOK PINJAMAN</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<b>DATA</b> &raquo; <a href="?page=pokok_add">TAMBAH</a>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<br>
<table class="tabholder" border="0" cellspacing="1" cellpadding="0">
	<tr class="tabhead">
		<td align="center" width="50" class="tabtxt">No</td>
        <td align="center" class="tabtxt">Pokok Pinjaman</td>
		 <td align="center" class="tabtxt">Terbilang</td>
		<td align="center" width="60" class="tabtxt">Aksi</td>
	</tr>
<?php
//Tampilkan semua pokok pinjaman
$arrayPokok=$pokok->tampilPokok();
if (count($arrayPokok))
{
foreach($arrayPokok as $data)
{
?>

	<tr class="tabcont">
		<td class="tabtxt" align="center"><?php echo $c=$c+1;?>.</td>
        <td class="tabtxt"><?php echo format_angka($data['pokok']);?></td>
		 <td class="tabtxt"><?php echo terbilang($data['pokok']);?></td>
		<td align="left">
			<div class="tabtxt imghref">
				<span class="dashnav">&nbsp;</span>
				<a href="?page=pokok_edit&aksi=edit&id_pokok=<?php echo $data['id'];?>">
					<img src="images/ico_edit.gif" class="ico" border="0" title="Edit" />
				</a>
				<span class="dashnav">&nbsp;</span>
				<a href="?page=pokok_edit&aksi=hapus&id_pokok=<?php echo $data['id'];?>">
					<img src="images/ico_del.gif" class="ico" border="0" title="Hapus"  onClick="return confirm('Apakah Anda Yakin?');"/>
				</a>
			</div>
		</td>
	</tr>
<?php
} 
}?>
</table>
</p>
<img src="images/ico_edit.gif" border="0" title="Edit" /> = Edit Pokok Pinjaman &nbsp;&nbsp;			
<img src="images/ico_del.gif" border="0" title="Delete" /> = Hapus Pokok Pinjaman			