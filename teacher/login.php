<?php

if(isset($_POST["pass"])){
include("../functions.php");

$con=connect();
if(!empty($_POST["pass"])){
	if(log_In_Teacher($con,$_POST["pass"])){
		session_start();
		$_SESSION['loggedin'] = password_hash("admin",PASSWORD_DEFAULT);
		$con=nil;
		header("Location: dashboard.php");
	}else{
		$con=nil;
	header("Location: ../npage.php?page=teacher/index.php&warning=Can't Fined User");

	}
}else{
			$con=nil;
	header("Location: index.php?warning=Please Enter Your Password");
	header("Location: ../npage.php?page=teacher/index.php&warning=Please Enter Your Password");
}
}else{
	header("Location: index.php");
}
