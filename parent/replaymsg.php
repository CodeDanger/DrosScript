<?php
if (isset($_POST["submit"])){
include('../functions.php');
session_start();
session_regenerate_id();
if (!isset($_SESSION["loggedin"]) || !password_verify("parent",$_SESSION["loggedin"])){
	header("Location: index.php");
	exit();
}
if (empty($_POST["content"])){header("Location: viewmsg.php?id=".$_POST["id"]);exit();}
	
	$con=connect();
	$inf=getParentInfoByUser($con,$_SESSION["user"]);
if(!isItMessageOwner($con,$_POST["id"],$inf["id"])){$con=null; header("Location: viewmsg.php?id=".$_POST["id"]);exit();}
	if (replayMessageByParent($con,$inf["id"],$_POST["id"],$_POST["content"])){
		$con=null;
		header("Location: ../npage.php?page=parent/viewmsg.php?id=".$_POST["id"]."&success=Message Has Been Sent");

		exit();
	}


		$con=null;
		header("Location: ../npage.php?page=parent/viewmsg.php?id=".$_POST["id"]."&warning=Faild To Send Message");

		exit();
}else{
	header("Location: viewmsg.php?id=".$_POST["id"]);
}
