<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
if (!isset($_SESSION['username'])) {
?>
	<script type="text/javascript">
		alert("Terjadi Kesalahan saat login");
		window.location = "../";
	</script>

<?php
}else{

/* penyesuaian folder aplikasi yang akan kita buat. 
	pada kasus ini kita berada pada folder PW */
$baseURL = 'http://'.$_SERVER['SERVER_NAME'].'/web/web/';
parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $_GET);

/* untuk mengambil file hasil parsing, jika tidak ada file pada URL yang diambil,
	maka untuk default yang akan dijalankan adalah main.php */
$filename = $_SERVER['QUERY_STRING'];
if ($filename=="") $filename='home';
define('OFFDIRECT', TRUE);

/* jika ada file, maka yang akan dijalankan adalah file tersebut */
$filename = trim($filename,'/');
$filename=$filename.'.php';

/* jika file tidak ditemukan maka yang akan dijalankan ada file error404.php */
if (!file_exists($filename)) include 'error404.php';

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo "Admin - "; ?>RentCar</title>
		<link rel="shortcut icon" href="<?php echo $icon; ?>images/favicon.png" type="image/x-icon"  />
		
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo $baseURL; ?>css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo $baseURL; ?>font-awesome/4.5.0/css/font-awesome.min.css" />
		
		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo $baseURL; ?>css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="<?php echo $baseURL; ?>css/colorbox.min.css" />
		
		<link rel="stylesheet" href="<?php echo $baseURL; ?>css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="<?php echo $baseURL; ?>css/bootstrap-timepicker.min.css" />
		
		
		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo $baseURL; ?>css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link href="<?php echo $baseURL;?>css/fileinput.min.css" rel="stylesheet">
		<script>
			function goBack() {
				window.history.back()
			}
		</script>    
	
	</head>
  <!-- menjalankan file yg diterima dari hasil URL -->
  <?php include $filename; ?>  
</html>	

<?php
}
?>

