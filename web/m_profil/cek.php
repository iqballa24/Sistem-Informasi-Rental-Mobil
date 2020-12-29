if(isset($_POST["submit"])){
	$newpassword = $_POST["newpassword"];
	$password = $_POST["password"];

	if(empty($newpassword && $password )){
		header("location:password.php?failed");
	}else{
		header("location:password.php?success");
	}
}