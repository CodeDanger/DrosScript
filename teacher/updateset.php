<?php
//YC70v852eS--student
//p8nhXnu4nd--Parent
if(isset($_POST["submit"])){
include("../functions.php");
		session_start();
		session_regenerate_id();
if(empty($_POST["npass"])||empty($_POST["pass"])){header("Location: ../npage.php?page=teacher/settings.php&warning=Please Fill Required Filed");exit();}
$con=connect();
$inf=getParentInfoByUser($con,$_SESSION["user"]);
if(!log_In_Teacher($con,$_POST["pass"])){$con=null;header("Location: ../npage.php?page=teacher/settings.php&warning=Password Is Not Correct");exit();}
		if(updateTeacherPassword($con,$_POST["npass"])){
			$con=null;
			header("Location: ../npage.php?page=teacher/settings.php&success=Setting Has Been Updated");
			exit();
		}
		$con=null;
		header("Location: ../npage.php?page=teacher/settings.php&warning=Faild To Update Settings");

		exit();
}else{
	header("Location: settings.php");
	exit();
}
