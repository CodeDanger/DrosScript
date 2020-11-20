<?php
include('../functions.php');
session_start();
if (!isset($_SESSION["loggedin"]) || !password_verify("admin",$_SESSION["loggedin"])){
	header("Location: index.php");
	exit();
}
if(!empty($_GET["id"])){
$con=connect();
if (deleteMessage($con,$_GET["id"])){
	header("Location: ../npage.php?page=teacher/message.php&success=Message Has Been Deleted");
	exit();
}
	header("Location: ../npage.php?page=teacher/message.php&warning=Faild To Delete Message");
	exit();	
}else{
	header("Location: addgroup.php");
}
