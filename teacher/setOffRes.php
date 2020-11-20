<?php
if (isset($_POST["submit"])){
include('../functions.php');
session_start();
if (!isset($_SESSION["loggedin"]) || !password_verify("admin",$_SESSION["loggedin"])){
	header("Location: index.php");
	exit();
}
$con=connect();
$stlist=getGroupStudents($con,$_POST["grname"]);
	for($k=0;$k<count($stlist);$k++){
		addStOffRes($con,$_POST["quizid"],$stlist[$k]["id"],$_POST[$stlist[$k]["id"]]);		
	}
		$con=null;
		header("Location: ../npage.php?page=teacher/offlineresult.php&success=Result Has Been Updated");
		exit();
}else{
	header("Location: offlineresult.php");
}
