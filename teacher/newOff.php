<?php
if (isset($_POST["submit"])){
include('../functions.php');
session_start();
if (!isset($_SESSION["loggedin"]) || !password_verify("admin",$_SESSION["loggedin"])){
	header("Location: index.php");
	exit();
}
$con=connect();
	if (addOfflineQuiz($con,$_POST["name"])){
		$con=null;
		header("Location: ../npage.php?page=teacher/newoffline.php&success=Quiz Has Been Add");
		exit();
		return;
	}


		$con=null;
		header("Location: newoffline.php?warning=Faild To Add Quiz");
		header("Location: ../npage.php?page=teacher/newoffline.php&warning=Faild To Add Quiz");
		exit();
}else{
	header("Location: newoffline.php");
}
