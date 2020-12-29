<?php

session_start();
include_once "../koneksi.php";
$type = $_REQUEST['type'];

switch ($type) 
{
	case 1:
		$txtbooking		= $_REQUEST['txtbooking'];
		$txtcustomer	= $_REQUEST['txtcustomer'];
		$txtnamamobil	= $_REQUEST['txtnamamobil'];
		$datetgl		= $_REQUEST['datetgl'];
		$txtdurasi		= $_REQUEST['txtdurasi']; 
		

		if (empty($txtbooking)) {
			$mySql = "SELECT * FROM dt_pemesanan WHERE no_booking ='".$txtbooking."'";
		} else {
			$mySql = "SELECT * FROM dt_pemesanan WHERE id_mobil='".$txtnamamobil."' AND NOT(no_booking='".$txtbooking."')";
		}
		$myQry = mysqli_query($koneksidb, $mySql);
		$myData = mysqli_fetch_array($myQry);
		if (mysqli_num_rows($myQry)>=1){
				$data['msg'][0] = "error";
				$data['msg'][1] = "Maaf, mobil sudah dipakai, silahkan ganti dengan yang lain";
		} else {
			$pesanError = array();
			if (empty($txtbooking)) {
				$pesanError[] = "Maaf, <b>No booking</b> tidak boleh kosong";
			}
			if (empty($txtcustomer)) {
				$pesanError[] = "Maaf, <b>nama penyewa</b> tidak boleh kosong";
			}
			if (empty($txtnamamobil)) {
				$pesanError[] = "Maaf, <b>nama mobil</b> tidak boleh kosong";
			}
			if (empty($datetgl)) {
				$pesanError[] = "Maaf, <b>tanggal</b> tidak boleh kosong";
			}
			if (empty($txtdurasi)) {
				$pesanError[] = "Maaf, <b>durasi</b> tidak boleh kosong";
			}
			
			if (count($pesanError)>=1) {
				$pesan="";
				foreach ($pesanError as $pesan_tampil) {
					$pesan.="$pesan_tampil<br>";
				}
				$data['msg'][0] = "error";
				$data['msg'][1] = $pesan;
			}else  {
				$mySql = "SELECT * FROM dt_pemesanan WHERE no_booking='$txtbooking'";
				$myQry = mysqli_query ($koneksidb, $mySql);
				$jumlah= mysqli_num_rows($myQry);

				if($jumlah==0){
				$mySql = "INSERT INTO dt_pemesanan (no_booking, id_customer, id_mobil, tgl_pinjam, durasi)
					VALUES ('$txtbooking', '$txtcustomer', '$txtnamamobil', '$datetgl','$txtdurasi')";
				$data['msg'][0] = "ok";
				$data['msg'][1] = "Data berhasil ditambahkan........";
				} else {
					$mySql = "UPDATE dt_pemesanan SET
							no_booking 		='$txtbooking',
							id_customer		='$txtcustomer',
							id_mobil	 	='$txtnamamobil',
							tgl_pinjam 		='$datetgl',
							durasi			='$txtdurasi'
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
			$mySql = "SELECT a.*,b.*,c.*,d.*, (harga*durasi) as total_harga FROM dt_pemesanan a left join mobil b ON a.id_mobil=b.id_mobil INNER JOIN harga c ON b.id_mobil=c.id_mobil INNER JOIN customer d ON a.id_customer=d.id_customer";
			$myQry = mysqli_query ($koneksidb, $mySql);
			$i=0;
			$data='';
			$txtidharga='';

			while ($myData = mysqli_fetch_array($myQry)) {
				$akses='';
					$akses="<center> <a href='#' class='tooltip-success' data-rel='tooltip' title='ubah'> <span class='green'><i class='ace-icon fa fa-pencil-square-o'></i></span></a> <a href='#' class='tooltip-error' data-rel='tooltip' title='hapus'><span class='red'><i class='ace-icon fa fa-trash '></i></span></a></center> ";
				$data .= sprintf("[\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"],", $i+1,$myData['no_booking'],$myData['id_customer'],$myData['nama'],$myData['id_mobil'],$myData['nama_mobil'],$myData['no_plat'],$myData['tgl_pinjam'],"Rp.".$txtidharga=number_format($myData['harga']),$txtdurasi=$myData['durasi']." hari","Rp.".number_format($myData['total_harga']),$akses);
				$i++;

			}
			echo '{"data":['.substr($data,0,-1).']}';

		break;
		case 2:
			$id 	=	$_REQUEST['id'];
			$mySql 	=	"DELETE FROM dt_pemesanan WHERE no_booking='".$id."'";
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