<?php

session_start();
include_once "../koneksi.php";
$type = $_REQUEST['type'];

switch ($type) 
{
	case 1:
		$cmbnama		= $_REQUEST['cmbnama'];
		$txtharga		= $_REQUEST['txtharga'];
		$txtidharga		= $_REQUEST['txtidharga'];
		if (empty($cmbnama)) {
			$mySql = "SELECT * FROM harga WHERE id_harga ='".$txtidharga."'";
		} else {
			$mySql = "SELECT * FROM harga WHERE id_mobil ='".$cmbnama."' AND NOT (id_harga ='".$txtidharga."')";
		}
		$myQry = mysqli_query($koneksidb, $mySql);
		$myData = mysqli_fetch_array($myQry);
		if (mysqli_num_rows($myQry)>=1){
				$data['msg'][0] = "error";
				$data['msg'][1] = "Maaf, harga mobil sudah di isi , silahkan ganti dengan yang lain";
		} else {
			$pesanError = array();
			if (empty($txtidharga)) {
				$pesanError[] = "Maaf, <b>id harga</b> tidak boleh kosong";
			}
			if (empty($cmbnama)) {
				$pesanError[] = "Maaf, <b>nama mobil</b> tidak boleh kosong";
			}
			if (empty($txtharga)) {
				$pesanError[] = "Maaf, <b>harga</b> tidak boleh kosong";
			}
			if (count($pesanError)>=1) {
				$pesan="";
				foreach ($pesanError as $pesan_tampil) {
					$pesan.="$pesan_tampil<br>";
				}
				$data['msg'][0] = "error";
				$data['msg'][1] = $pesan;
			}else  {
				$mySql = "SELECT * FROM harga WHERE id_harga='$txtidharga'";
				$myQry = mysqli_query ($koneksidb, $mySql);
				$jumlah= mysqli_num_rows($myQry);

				if($jumlah==0){
					$mySql = "INSERT INTO harga (Id_harga,id_mobil, harga)
					VALUES ('$txtidharga','$cmbnama' ,'$txtharga')";
				$data['msg'][0] = "ok";
				$data['msg'][1] = "Data berhasil ditambahkan........";
				} else {
					$mySql = "UPDATE harga SET
							Id_harga ='$txtidharga',
							id_mobil 	='$cmbnama',
							harga ='$txtharga'
							WHERE id_harga='$txtidharga'";
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
			$mySql = "SELECT a.*,b.* from mobil a LEFT JOIN harga b ON a.id_mobil= b.id_mobil";
			$myQry = mysqli_query ($koneksidb, $mySql);
			$i=0;
			$data='';
			while ($myData = mysqli_fetch_array($myQry)) {
				$akses='';
					$akses="<center> <a href='#' class='tooltip-success' data-rel='tooltip' title='ubah'> <span class='green'><i class='ace-icon fa fa-pencil-square-o'></i></span></a> <a href='#' class='tooltip-error' data-rel='tooltip' title='hapus'><span class='red'><i class='ace-icon fa fa-trash '></i></span></a></center> ";

				$data .= sprintf("[\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"],", $i+1,$myData['Id_harga'],$myData['id_mobil'],$myData['nama_mobil'],$myData['no_plat'],"Rp.".$txtharga=number_format($myData['harga'],0,",","."),$myData['harga'],$akses);

				$i++;

			}
			echo '{"data":['.substr($data,0,-1).']}';

		break;
		case 2:
			$id 	=	$_REQUEST['id'];
			$mySql 	=	"DELETE FROM harga WHERE Id_harga='".$id."'";
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