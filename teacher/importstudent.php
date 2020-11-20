<?php
if (isset($_POST['submit'])){
include('../functions.php');
session_start();
if (!isset($_SESSION["loggedin"]) || !password_verify("admin",$_SESSION["loggedin"])){
	header("Location: index.php");
	exit();
}
$con=connect();
$att=getAttendanceDayStudents($con,$_POST["date"]);
						 if($_FILES['file']['name'])
						 {
						  $filename = explode(".", $_FILES['file']['name']);
						  if($filename[1] == 'csv')
						  {
						   $handle = fopen($_FILES['file']['tmp_name'], "r");
						   while($data = fgetcsv($handle))
						   {
							   $name=explode(" ",$data[1]);
								addStudent($con,$name[0],$name[1].' '.$name[2],$data[3],$data[2],$data[5],$data[4],true,$data[0]);
						   }
							fclose($handle);
							$con=null;
						  }
						 }
						 header("Location: ../npage.php?page=teacher/addstudent.php&success=Student List Has Been Imported");
						 exit();
}else{
	header("Location: addstudent.php");
	exit();
}

