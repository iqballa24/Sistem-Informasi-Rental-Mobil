<?php

session_start();
include_once "../koneksi.php";
$type = $_REQUEST['type'];

switch ($type) 
{
	case 1:
		$txtidmerk		= $_REQUEST['txtidmerk'];
		$txtmerk		= $_REQUEST['txtmerk'];
		if (empty($txtidmerk)) {
			$mySql = "SELECT * FROM merk WHERE id_merk='".$txtidmerk."'";
		} else {
			$mySql = "SELECT * FROM merk WHERE merk='".$txtmerk."' AND NOT  (id_merk='".$txtidmerk."')";
		}
		$myQry = mysqli_query($koneksidb, $mySql);
		$myData = mysqli_fetch_array($myQry);
		if (mysqli_num_rows($myQry)>=1){
				$data['msg'][0] = "error";
				$data['msg'][1] = "Maaf, Merk <b> $txtmerk </b> sudah dipakai, silahkan ganti dengan yang lain";
		} else {
			$pesanError = array();
			if (empty($txtidmerk)) {
				$pesanError[] = "Maaf, <b>Id Merk</b> tidak boleh kosong";
			}
			if (empty($txtmerk)) {
				$pesanError[] = "Maaf, <b>Merk</b> tidak boleh kosong";
			}
			if (count($pesanError)>=1) {
				$pesan="";
				foreach ($pesanError as $pesan_tampil) {
					$pesan.="$pesan_tampil<br>";
				}
				$data['msg'][0] = "error";
				$data['msg'][1] = $pesan;
			}else  {
				$mySql = "SELECT * FROM merk WHERE id_merk='$txtidmerk'";
				$myQry = mysqli_query ($koneksidb, $mySql);
				$jumlah= mysqli_num_rows($myQry);

				if($jumlah==0){
					$mySql = "INSERT INTO merk (id_merk, merk)
					VALUES ('$txtidmerk', '$txtmerk')";
				$data['msg'][0] = "ok";
				$data['msg'][1] = "Data berhasil ditambahkan........";
				} else {
					$mySql = "UPDATE merk SET
							id_merk ='$txtidmerk',
							merk 	='$txtmerk'
							WHERE id_merk='$txtidmerk'";
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
			$mySql = "SELECT * FROM merk ORDER BY id_merk ";
			$myQry = mysqli_query ($koneksidb, $mySql);
			$i=0;
			$data='';
			while ($myData = mysqli_fetch_array($myQry)) {
				$akses='';
					$akses="<center> <a href='#' class='tooltip-success' data-rel='tooltip' title='ubah'> <span class='green'><i class='ace-icon fa fa-pencil-square-o'></i></span></a> <a href='#' class='tooltip-error' data-rel='tooltip' title='hapus'><span class='red'><i class='ace-icon fa fa-trash '></i></span></a></center> ";
				$data .= sprintf("[\"%s\",\"%s\",\"%s\",\"%s\"],", $i+1,$myData['id_merk'],$myData['merk'],$akses);
				$i++;

			}
			echo '{"data":['.substr($data,0,-1).']}';

		break;
		case 2:
			$id 	=	$_REQUEST['id'];
			$mySql 	=	"DELETE FROM merk WHERE id_merk='".$id."'";
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
		default :
}
