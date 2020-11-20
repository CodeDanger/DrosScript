<?php

if (isset($_POST["submit"])){
include('../functions.php');
session_start();
if (!isset($_SESSION["loggedin"]) || !password_verify("admin",$_SESSION["loggedin"])){
	header("Location: index.php");
	exit();
}
$con=connect();
$grlist=getGroupsList($con);
	if(empty($_POST["user"])){$con=null;header("Location: ../npage.php?page=teacher/setgroup.php&warning=Faild To Set Student Group");exit();}
	if(setStudentGroup($con,$_POST["user"],$_POST["group"])){
		$con=null;
		header("Location: ../npage.php?page=teacher/setgroup.php&success=Student Group Has Been Changed");
		exit();
	}else{
		$con=null;
		header("Location: ../npage.php?page=teacher/setgroup.php&warning=Faild To Set Student Group");
		exit();
	}
	
}else{
	header("Location: setgroup.php");
}
