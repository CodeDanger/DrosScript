<?php
if (isset($_POST["submit"])){
include('../functions.php');
session_start();
session_regenerate_id();
if (!isset($_SESSION["loggedin"]) || !password_verify("admin",$_SESSION["loggedin"])){
	header("Location: index.php");
	exit();
}
if (empty($_POST["content"])){header("Location: viewmsg.php?id=".$_POST["id"]);exit();}
	
	$con=connect();
	if (replayMessageByTeacher($con,$_POST["id"],$_POST["content"])){
		$con=null;
		header("Location: ../npage.php?page=teacher/viewmsg.php?id=".$_POST["id"]."&success=Message Has Been Sent");

		exit();
	}


		$con=null;
		header("Location: ../npage.php?page=teacher/viewmsg.php?id=".$_POST["id"]."&warning=Faild To Send Message");
		exit();
}else{
	header("Location: viewmsg.php?id=".$_POST["id"]);
}
