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
$st=getGroupStudents($con,$_POST["group"]);
	for($k=0;$k<count($st);$k++){
		$stt=1;
		$val=(int)$st[$k]["id"];
		if (!isset($_POST["$val"])){$stt=0;}
		 setStudentAttendance($con,$st[$k]["id"],$stt);
	}
	$con=null;
	header("Location: ../npage.php?page=teacher/attendance.php&success=Attendance Has Been Updated");
	exit();
	
}else{
	header("Location: attendance.php");
}
