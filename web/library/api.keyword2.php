<?php

session_start();
include_once "../koneksi.php";
$type = $_REQUEST['type'];

switch ($type) 
{
	case 1:
		$txtidmobil		= $_REQUEST['txtidmobil'];
		$cmbmerk		= $_REQUEST['cmbmerk'];
		$txtnamamobil	= $_REQUEST['txtnamamobil'];
		$cmbtipe		= $_REQUEST['cmbtipe'];
		$txtkapasitas	= $_REQUEST['txtkapasitas'];
		$txtnoplat		= $_REQUEST['txtnoplat'];
		$txttahun		= $_REQUEST['txttahun'];		

		if (empty($txtidmobil)) {
			$mySql = "SELECT * FROM mobil WHERE id_mobil ='".$txtidmobil."'";
		} else {
			$mySql = "SELECT * FROM mobil WHERE no_plat='".$txtnoplat."' AND NOT (id_mobil='".$txtidmobil."')";
		}
		$myQry = mysqli_query($koneksidb, $mySql);
		$myData = mysqli_fetch_array($myQry);
		if (mysqli_num_rows($myQry)>=1){
				$data['msg'][0] = "error";
				$data['msg'][1] = "Maaf, mobil <b>$txtnamamobil</b> dengan plat <b>$txtnoplat</b> sudah dipakai, silahkan ganti dengan yang lain";
		} else {
			$pesanError = array();
			if (empty($txtidmobil)) {
				$pesanError[] = "Maaf, <b>id mobil</b> tidak boleh kosong";
			}
			if (empty($cmbmerk)) {
				$pesanError[] = "Maaf, <b>merk</b> tidak boleh kosong";
			}
			if (empty($txtnamamobil)) {
				$pesanError[] = "Maaf, <b>nama mobil</b> tidak boleh kosong";
			}
			if (empty($cmbtipe)) {
				$pesanError[] = "Maaf, <b>tipe mobil</b> tidak boleh kosong";
			}
			if (empty($txtkapasitas)) {
				$pesanError[] = "Maaf, <b>kapasitas</b> tidak boleh kosong";
			}
			if (empty($txtnoplat)) {
				$pesanError[] = "Maaf, <b>no plat</b> tidak boleh kosong";
			}
			if (empty($txttahun)) {
				$pesanError[] = "Maaf, <b>tahun</b> tidak boleh kosong";
			}
		
			if (count($pesanError)>=1) {
				$pesan="";
				foreach ($pesanError as $pesan_tampil) {
					$pesan.="$pesan_tampil<br>";
				}
				$data['msg'][0] = "error";
				$data['msg'][1] = $pesan;
			}else  {
				$mySql = "SELECT * FROM mobil WHERE id_mobil='$txtidmobil'";
				$myQry = mysqli_query ($koneksidb, $mySql);
				$jumlah= mysqli_num_rows($myQry);

				if($jumlah==0){
					$mySql = "INSERT INTO mobil (id_mobil,id_merk, nama_mobil, tipe_mobil, kapasitas, no_plat, tahun)
					VALUES ('$txtidmobil','$cmbmerk' ,'$txtnamamobil','$cmbtipe','$txtkapasitas','$txtnoplat','$txttahun')";
				$data['msg'][0] = "ok";
				$data['msg'][1] = "Data berhasil ditambahkan........";
				} else {
					$mySql = "UPDATE mobil SET
							id_mobil 	='$txtidmobil',
							id_merk 	='$cmbmerk',
							nama_mobil 	='$txtnamamobil',
							tipe_mobil 	='$cmbtipe',
							kapasitas 	='$txtkapasitas',
							no_plat 	='$txtnoplat',
							tahun 		='$txttahun'
							WHERE id_mobil='$txtidmobil'";
				$data['msg'][0] = "ok";
				$data['msg'][1] = "Data berhasil diubah......";
				}
			/*} else {
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
			$mySql = "SELECT * FROM mobil INNER JOIN merk ON mobil.id_merk = merk.id_merk";
			$myQry = mysqli_query ($koneksidb, $mySql);
			$i=0;
			$data='';
			while ($myData = mysqli_fetch_array($myQry)) {
				$akses='';
					$akses="<center> <a href='#' class='tooltip-success' data-rel='tooltip' title='ubah'> <span class='green'><i class='ace-icon fa fa-pencil-square-o'></i></span></a> <a href='#' class='tooltip-error' data-rel='tooltip' title='hapus'><span class='red'><i class='ace-icon fa fa-trash '></i></span></a></center> ";
				$data .= sprintf("[\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"],", $i+1,$myData['id_mobil'],$myData['id_merk'],$myData['merk'],$myData['nama_mobil'],$myData['tipe_mobil'],$myData['kapasitas'],$myData['no_plat'],$myData['tahun'],$akses);
				$i++;

			}
			echo '{"data":['.substr($data,0,-1).']}';

		break;
		case 2:
			$id 	=	$_REQUEST['id'];
			$mySql 	=	"DELETE FROM mobil WHERE id_mobil='".$id."'";
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