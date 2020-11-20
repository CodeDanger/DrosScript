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
	for($k=0;$k<count($grlist);$k++){
		if ($grlist[$k]["name"]==$_POST["name"]){
			header("Location: ../npage.php?page=teacher/addgroup.php&warning=Group is already exist");
			break;
			exit();
		}
	}
	if (addGroup($con,$_POST["name"])){
		$con=null;
			header("Location: ../npage.php?page=teacher/addgroup.php&success=Group Has Been Add");
		exit();
		return;
	}


		$con=null;
		header("Location: ../npage.php?page=teacher/addgroup.php&warning=Faild To Add Group");
		exit();
}else{
	header("Location: addgroup.php");
}
