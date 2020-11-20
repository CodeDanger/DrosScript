<?php
//YC70v852eS
if(isset($_POST["submit"])){
include("../functions.php");

$con=connect();
if(!empty($_POST["pass"])&&!empty($_POST["user"])){
	if(log_In_Student($con,$_POST["user"],$_POST["pass"])){
		session_start();
		$_SESSION['loggedin']=password_hash("user",PASSWORD_DEFAULT);
		$_SESSION['user']=$_POST["user"];
		$con=nil;
		header("Location: dashboard.php");
		exit();
	}else{
		$con=nil;
	header("Location: ../npage.php?page=student/index.php&warning=Can't Fined User");
exit();	
	}
}else{
			$con=nil;
	header("Location: ../npage.php?page=student/index.php&warning=Please Enter Your Username & Password");

	exit();
}
}else{
	header("Location: index.php");
	exit();
}
