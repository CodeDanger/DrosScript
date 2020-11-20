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
						  ob_start();
							$f = fopen('php://memory', 'w');
							$delimiter = ",";
							$filename = "Attendance_" . $_POST["date"] . ".csv";
							$fields = array('ID', 'Full Name', 'Is Attend');
							fputcsv($f, $fields, $delimiter);
							
						  for ($k=0;$k<count($att);$k++){
							  $info=getStudentInfoById($con,$att[$k]["studentid"]);
							  if($info["grou"]==$_POST["group"]){
									if($att[$k]["isattend"]=="1"){	
									$lineData = array($info['id'], $info['firstname'].' '.$info['lastname'], "Yes");										
									}else{
									$lineData = array($info['id'], $info['firstname'].' '.$info['lastname'], "No");
									}
									fputcsv($f, $lineData, $delimiter);								 
							  }
						  }

							fseek($f, 0);
							header('Content-Type: text/csv');
							header('Content-Disposition: attachment; filename="' . $filename . '";');
							fpassthru($f);
	
$con=null;
}else{
	header("Location: attendance.php");
	exit();
}

