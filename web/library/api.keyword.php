<?php

session_start();
include_once "../koneksi.php";
$type = $_REQUEST['type'];

switch ($type) 
{
	case 1:
		$txtcustomer	= $_REQUEST['txtcustomer'];
		$txtnama		= $_REQUEST['txtnama'];
		$txtalamat		= $_REQUEST['txtalamat'];
		$txttelepon		= $_REQUEST['txttelepon'];
		$Cmbsex			= $_REQUEST['Cmbsex'];
		$txtktp			= $_REQUEST['txtktp'];
		if (empty($txtcustomer)) {
			$mySql = "SELECT * FROM customer WHERE telepon ='".$txttelepon."'";
		} else {
			$mySql = "SELECT * FROM customer WHERE no_ktp ='".$txtktp."' AND NOT (id_customer='".$txtcustomer."')";
		}
		$myQry = mysqli_query($koneksidb, $mySql);
		$myData = mysqli_fetch_array($myQry);
		if (mysqli_num_rows($myQry)>=1){
				$data['msg'][0] = "error";
				$data['msg'][1] = "Maaf, nama <b> $txtnama </b> sudah dipakai, silahkan ganti dengan yang lain";
		} else {
			$pesanError = array();
			if (empty($txtcustomer)) {
				$pesanError[] = "Maaf, <b>Id customer</b> tidak boleh kosong";
			}
			if (empty($txtnama)) {
				$pesanError[] = "Maaf, <b>Nama</b> tidak boleh kosong";
			}
			if (empty($txtalamat)) {
				$pesanError[] = "Maaf, <b>Alamat</b> tidak boleh kosong";
			}
			if (empty($txttelepon)) {
				$pesanError[] = "Maaf, <b>Telepon</b> tidak boleh kosong";
			}
			if (empty($Cmbsex)) {
				$pesanError[] = "Maaf, <b>Jenis kelamin</b> tidak boleh kosong";
			}
			if (empty($txtktp)) {
				$pesanError[] = "Maaf, <b>Ktp</b> tidak boleh kosong";
			}
			if (count($pesanError)>=1) {
				$pesan="";
				foreach ($pesanError as $pesan_tampil) {
					$pesan.="$pesan_tampil<br>";
				}
				$data['msg'][0] = "error";
				$data['msg'][1] = $pesan;
			}else  {
				$mySql 	= "SELECT * FROM customer WHERE id_customer ='$txtcustomer'";
				$myQry 	= mysqli_query ($koneksidb, $mySql);
				$jumlah = mysqli_num_rows ($myQry);

				if($jumlah==0){
					$mySql = "INSERT INTO customer (id_customer, nama, alamat, telepon, jenis_kelamin, no_ktp )
					VALUES ('$txtcustomer', '$txtnama', '$txtalamat', '$txttelepon', '$Cmbsex', '$txtktp')";
				$data['msg'][0] = "ok";
				$data['msg'][1] = "Data berhasil ditambahkan........";
				}
				else {
					$mySql = "UPDATE customer SET
							id_customer		='$txtcustomer',
							nama 			='$txtnama',
							alamat 			='$txtalamat',
							telepon 		='$txttelepon',
							jenis_kelamin 	='$Cmbsex',
							no_ktp			='$txtktp'
							WHERE id_customer='$txtcustomer'";
				$data['msg'][0] = "ok";
				$data['msg'][1] = "Data berhasil diubah......";
				}/*
				$mySql = "UPDATE merk SET
							id_merk='$txtidmerk',
							merk='$txtmerk'
							WHERE id_merk='$txtidmerk'";
				$data['msg'][0] = "ok";
				$data['msg'][1] = "Data berhasil diubah......";
				*/
			}
			$myQry = mysqli_query($koneksidb, $mySql);
		}
		
		echo json_encode($data);	
		break;
		case 97:
			$mySql = "SELECT * FROM customer ORDER BY id_customer ";
			$myQry = mysqli_query ($koneksidb, $mySql);
			$i=0;
			$data='';
			while ($myData = mysqli_fetch_array($myQry)) {
				$akses='';
					 $akses="<center> <a href='#' class='tooltip-success' data-rel='tooltip' title='ubah'> <span class='green'><i class='ace-icon fa fa-pencil-square-o'></i></span></a> <a href='#' class='tooltip-error' data-rel='tooltip' title='hapus'><span class='red'><i class='ace-icon fa fa-trash'></i></span></a></center> ";
				$data .= sprintf("[\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"],", $i+1,$myData['id_customer'],$myData['nama'],$myData['alamat'],$myData['telepon'],$myData['jenis_kelamin'],$myData['no_ktp'],$akses);
				$i++;

			}
			echo '{"data":['.substr($data,0,-1).']}';

		break;
		case 2:
			$id 	=	$_REQUEST['id'];
			$mySql 	=	"DELETE FROM customer WHERE id_customer='".$id."'";
			$myQry 	=	mysqli_query($koneksidb, $mySql);

			if(!$myQry){
				$data['msg'][0] = "hapus";
				$data['msg'][1] = "<b>Error:</b>".mysqli_error($koneksidb);
			} 
			else{
				$data['msg'][0] = "hapus";
				$data['msg'][1] = "Hapus data berhasil dilakukan!";
			}
			echo json_encode($data);
		break;
		default;
}