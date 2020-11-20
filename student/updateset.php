<?php
//YC70v852eS--student
//p8nhXnu4nd--Parent
if(isset($_POST["submit"])){
include("../functions.php");
		session_start();
		session_regenerate_id();
if(empty($_POST["user"])||empty($_POST["name"])||empty($_POST["pass"])){header("Location: ../npage.php?page=student/settings.php&warning=Please Fill Required Filed"); exit();}
$con=connect();
$inf=getStudentInfoByUser($con,$_SESSION["user"]);
if(!password_verify($_POST["pass"],$inf["pass"])){$con=null;header("Location: ../npage.php?page=student/settings.php&warning=Password Is Not Correct"); exit();}
		if(updateStudentInfo($con,$_SESSION["user"],$_POST["user"],$_POST["fname"],$_POST["npass"])){
			$con=null;
			header("Location: ../npage.php?page=student/settings.php&success=Setting Has Been Updated");
			exit();
		}
		$con=null;
		header("Location: ../npage.php?page=student/settings.php&warning=Faild To Update Settings");
		exit();
}else{
	header("Location: settings.php");
	exit();
}
