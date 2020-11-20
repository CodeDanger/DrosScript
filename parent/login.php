<?php
//YC70v852eS--student
//p8nhXnu4nd--Parent
if(isset($_POST["submit"])){
include("../functions.php");

$con=connect();
if(!empty($_POST["pass"])&&!empty($_POST["user"])){
	if(log_In_Parent($con,$_POST["user"],$_POST["pass"])){
		session_start();
		$_SESSION['loggedin']=password_hash("parent",PASSWORD_DEFAULT);
		$_SESSION['user']=$_POST["user"];
		$con=nil;
		header("Location: dashboard.php");
		exit();
	}else{
		$con=nil;
	header("Location: index.php?warning=Can't Fined User");
exit();	
	}
}else{
			$con=nil;
	header("Location: index.php?warning=Please Enter Your Username & Password");
	exit();
}
}else{
	header("Location: index.php");
	exit();
}
