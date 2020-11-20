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
	if(empty($_POST["id"])){$con=null;header("Location: ../npage.php?page=teacher/removestudent.php&warning=Faild To Remove Student");exit();}
	if(removeStudent($con,$_POST["id"])){
		$con=null;
		header("Location: ../npage.php?page=teacher/removestudent.php&success=Student Has Been Removed <br/> <p>All Student Data Has Been Removed Like:<br/> 1-Parent Account <br/> 2-Parent Messages <br/> ..etc</p>");
		exit();
	}else{
		$con=null;
		header("Location: ../npage.php?page=teacher/removestudent.php&warning=Faild To Remove Student");
		exit();
	}
}else{
	header("Location: removestudent.php");
}
