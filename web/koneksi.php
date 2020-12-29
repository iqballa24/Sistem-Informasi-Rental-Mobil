<?php
# konek ke web server lokal  
$myHost = "localhost" ; //nama server 
$myUser = "root" ; //nama user database 
$myPass = "" ; //password yang digunakan
$myDbs = "rental1" ; //nama database yang kita buat 
 
$koneksidb = mysqli_connect($myHost, $myUser, $myPass, $myDbs);

if (! $koneksidb) {
	// jikaa gagal koneksi
	echo "failed connection !";
}
?>