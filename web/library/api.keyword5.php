<?php

session_start();
include_once "../koneksi.php";
$type = $_REQUEST['type'];

switch ($type) 
{
	case 1:
		$txtbooking		= $_REQUEST['txtbooking'];
		$datetglkembali	= $_REQUEST['datetglkembali'];
		$txttelat		= $_REQUEST['txttelat'];
		$txtharga		= $_REQUEST['txtharga'];
		if (empty($txtbooking)) {
			$mySql = "SELECT * FROM dt_pengembalian WHERE no_booking ='".$txtbooking."'";
		} else {
			$mySql = "SELECT * FROM dt_pengembalian WHERE no_booking='".$txtbooking."' AND NOT(no_booking='".$txtbooking."')";
		}
		$myQry = mysqli_query($koneksidb, $mySql);
		$myData = mysqli_fetch_array($myQry);
		if (mysqli_num_rows($myQry)>=1){
				$data['msg'][0] = "error";
				$data['msg'][1] = "Maaf, no booking<b> $txtbooking</b> sudah dipakai, silahkan ganti dengan yang lain";
		} else {
			$pesanError = array();
			if (empty($txtbooking)) {
				$pesanError[] = "Maaf, <b>No booking</b> tidak boleh kosong";
			}
			if (empty($datetglkembali)) {
				$pesanError[] = "Maaf, <b>tanggal kembali</b> tidak boleh kosong";
			}
			if (empty($txttelat)) {
				$pesanError[] = "Maaf, <b>keterlambatan</b> tidak boleh kosong";
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
				$mySql = "SELECT * FROM dt_pengembalian WHERE no_booking='$txtbooking'";
				$myQry = mysqli_query ($koneksidb, $mySql);
				$jumlah= mysqli_num_rows($myQry);

				if($jumlah==0){
				$mySql = "INSERT INTO dt_pengembalian (no_booking, tanggal_kembali, keterlambatan, Biaya_denda)
					VALUES ('$txtbooking', '$datetglkembali', '$txttelat', '$txtharga')";
				$data['msg'][0] = "ok";
				$data['msg'][1] = "Data berhasil ditambahkan........";
				} else {
					$mySql = "UPDATE dt_pengembalian SET
							no_booking 		='$txtbooking',
							tanggal_kembali	='$datetglkembali',
							keterlambatan 	='$txttelat',
							Biaya_denda		='$txtharga'
							WHERE no_booking='$txtbooking'";
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
			$mySql = "SELECT a.*,b.*,c.*,d.*,e.* FROM dt_pemesanan a inner join mobil b ON a.id_mobil=b.id_mobil INNER JOIN harga c ON b.id_mobil=c.id_mobil INNER JOIN customer d ON a.id_customer=d.id_customer INNER JOIN dt_pengembalian e ON a.no_booking=e.no_booking";
			$myQry = mysqli_query ($koneksidb, $mySql);
			$i=0;
			$data='';
			while ($myData = mysqli_fetch_array($myQry)) {
				$akses='';
					$akses="<center> <a href='#' class='tooltip-success' data-rel='tooltip' title='ubah'> <span class='green'><i class='ace-icon fa fa-pencil-square-o'></i></span></a> <a href='#' class='tooltip-error' data-rel='tooltip' title='hapus'><span class='red'><i class='ace-icon fa fa-trash '></i></span></a></center> ";
				$data .= sprintf("[\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"],", $i+1,$myData['no_booking'],$myData['nama'],$myData['nama_mobil'],$myData['no_plat'],$myData['tgl_pinjam'],$myData['tanggal_kembali'],$myData['keterlambatan'],$myData['Biaya_denda'],$akses);
				$i++;

			}
			echo '{"data":['.substr($data,0,-1).']}';

		break;
		case 2:
			$id 	=	$_REQUEST['id'];
			$mySql 	=	"DELETE FROM dt_pengembalian WHERE no_booking='".$id."'";
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
		default:
	}