<?php
if(!defined('OFFDIRECT')) include 'error404.php';
?>
<body class="no-skin">
<?php
	include "base_template_topnav.php";	 //akan memanggil file base_template_topnav.php sebagai header
	echo '<div class="main-container ace-save-state" id="main-container">';
	include "menu.php";	 //akan memanggil file menu.php sebagai pembuatan menu
	
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<br/>
	<br/>
	<br/>
	<center><h1><i class="menu-icon fa fa-key "></i></h1></center>
	<center><h2>UBAH PASSWORD</h2></center>	
	<div class="login">
	<br/>
		<form action="" method="post"  enctype="multipart/form-data" >
			
            <div>
				<label><center>Password baru:</center></label>
				<input type="password" name="password" id="txtPassword" placeholder="masukan password baru" />
				<p id="password1msg"></p>
			</div>
			<div>
				<label><center>konfirmasi password:</center></label>
				<input type="password" name="confirmPassword" id="txtConfirmPassword" placeholder="konfirmasi password"  />
				<p id="passwordmsg"></p>
			</div>			
			<div>
				<button type="submit" name="btnsubmit" id="btnsubmit" onclick="return validasi()" >
                    <i class= "ace-icon fa fa-save"></i>
                    simpan
                </button>
                <button  type="reset">
                    <i class="ace-icon fa fa-undo"></i>
                    Reset
                </button>
			</div>
		</form>
	</div>
</body>
 
</html>
<?php
	include "base_template_footer.php";	//akan memanggil base_template_footer.php sebagai footer
?>
</body>
<script type="text/javascript">
    function validasi() {
        var password = document.getElementById("txtPassword").value;
        if (password =="") {
            $('#password1msg').html('<p class="red">* Harap mengisi password yang akan di ubah.</p>');
            return false;
        }
        else{
     		 $('#password1msg').html(
        		'');
    	}
        var confirmPassword = document.getElementById("txtConfirmPassword").value;

        if (confirmPassword == "") {
            $('#passwordmsg').html('<p class="red">* Ulangi password baru anda !</p>');
            return false;
        }
        if (password != confirmPassword) {
            $('#passwordmsg').html('<p class="red">* password tidak sama.</p>');
            return false;
        }
        else{
        	var result = 
     		 confirm('Yakin password ingin di ubah ? ');
     		 if (result == true){
     		 	alert("password berhasil di ubah");

     		 }
     		 else {
     		 	alert ("password batal diubah ");
     		 }
  		}
    }
</script>
