<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	date_default_timezone_set('Asia/Makassar');
	$tanggal=date("Y-m-d H:i:s");

	$id = $_GET['id'];
	$upd = mysql_query("update tb_kredit set status=3 where id_kredit='$id'");
	$ins = mysql_query("insert into tb_bpkb (id_kredit, tgl_kirim) values ('$id','$tanggal')");
	header('Location:admin.php');
?>