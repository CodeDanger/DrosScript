<?php
if (isset($_POST["submit"])){
include('../functions.php');
session_start();
if (!isset($_SESSION["loggedin"]) || !password_verify("admin",$_SESSION["loggedin"])){
	header("Location: index.php");
	exit();
}
if (empty($_POST["content"])){header("Location: newmsg.php");exit();}
	
	$con=connect();

	if (newAdminMessage($con,$_POST["id"],$_POST["title"],$_POST["content"])){
		$con=null;
		header("Location: ../npage.php?page=teacher/newmsg.php&success=Message Has Been Sent");
		exit();
	}


		$con=null;
		header("Location: ../npage.php?page=teacher/newmsg.php&warning=Faild To Send Message");
		exit();
}else{
	header("Location: newmsg.php");
}
