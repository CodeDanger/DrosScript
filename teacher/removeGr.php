<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
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
			removeGroup($con,$_POST["name"]);
			$con=null;
			header("Location: ../npage.php?page=teacher/removegroup.php&success=Group Has Been Deleted");
			exit();
		}
	}
		$con=null;
		header("Location: ../npage.php?page=teacher/removegroup.php&warning=Faild To Remove Group");
		exit();
}else{
	header("Location: removegroup.php");
}
