<?php
$siteowner="Dros Script";
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dros');

function getDirFiles($dir){
	$files = scandir($dir);
	$arr=array();
	$num=0;
	for($k=0;$k<count($files);$k++){
		if($files[$k]!=="." &&$files[$k]!==".."){
			$arr[$num]=$files[$k];
			$num++;
		}
	}
	
	return $arr;
}	

function connect(){
	$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
	return($pdo);
}
function log_In_Teacher($con,$pass){
	$stmt=$con->prepare("SELECT * FROM teacher WHERE password=?");
	$fpass=password_hash($pass,PASSWORD_DEFAULT);
	if( $stmt->execute([$fpass])){
		return true;
	}
	return false;
}
function log_In_Student($con,$user,$pass){
	$stmt=$con->prepare("SELECT * FROM users WHERE username=?");
	if( $stmt->execute([$user])){
		if($stmt->rowCount()>0){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if (password_verify($pass,$row["pass"])){
				return true;
			}
			
		}
	}
	return false;
}
function log_In_Parent($con,$user,$pass){
	$stmt=$con->prepare("SELECT * FROM parent WHERE username=?");
	if( $stmt->execute([$user])){
		if($stmt->rowCount()>0){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if (password_verify($pass,$row["pass"])){
				return true;
			}
			
		}
	}
	return false;
}

function getStudentList($con){
	$stmt=$con->prepare("SELECT * FROM users");	
	if ($stmt->execute()){
		$arr=array();
		$num=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$arr[$num]=$row;
			$num++;
		}
		return $arr;
	}
return false;	
}

function getGroupsList($con){
	$stmt=$con->prepare("SELECT * FROM groups");	
	if ($stmt->execute()){
		$arr=array();
		$num=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$arr[$num]=$row;
			$num++;
		}
		return $arr;
	}
return false;	
}

function isGroupExist($con,$n){
		$stmt=$con->prepare("SELECT * FROM groups WHERE name=?");	
	if ($stmt->execute([$n])){
			if($stmt->rowCount()>0) {return true;}
		}
		return false;
}

function addGroup($con,$name){
	if(isGroupExist($con,$name)){return false;}
	$stmt=$con->prepare("INSERT INTO groups (name) VALUES(?)");
		if ($stmt->execute([$name])){
			return true;
		}
	return false;
}
function removeGroup($con,$name){
	$stmt=$con->prepare("DELETE FROM groups WHERE name=?");
		if ($stmt->execute([$name])){
			return true;
		}
	return false;
}
function isParentExist($con,$parent){
$stmt=$con->prepare("SELECT * FROM parent WHERE username=:p");
$stmt->execute([
	'p'=>$parent,
]);
if ($stmt->rowCount()>0){return true;}
return false;
}

function generateRandomParentUser($con,$length){
	 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
	while(isParentExist($con,$randomString)){
	generateRandomParentUser($con,$length);
	}
    return $randomString;
}

function isStudentExist($con,$user){
$stmt=$con->prepare("SELECT * FROM users WHERE username=:p");
$stmt->execute([
	'p'=>$user,
]);
if ($stmt->rowCount()>0){return true;}
return false;
}

function generateRandomStudentUser($con,$length){
	 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
	while(isStudentExist($con,$randomString)){
	generateRandomParentUser($con,$length);
	}
    return $randomString;
}

function generateRandomPass($length){
	 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function addStudent($con,$first,$last,$ispaid,$group,$phone,$pphone,$isincludeusername,$ia){
	if (empty($phone)){$phone="";}
	if (empty($pphone)){$pphone="";}
	if (!$isincludeusername==true){
	$parentuser=generateRandomParentUser($con,5);
	$parentpass=generateRandomPass(10);
	}else{
		$parentuser=str_replace(' ', '',$first." ".$last.$ia);			
		$parentpass=str_replace(' ', '',$first." ".$last.$ia);		
	}
	$parenthashpass=password_hash($parentpass,PASSWORD_DEFAULT);
	$stmt=$con->prepare("INSERT INTO parent (username,name,pass,mobilenum) VALUES (?,?,?,?)");
	if (!$stmt->execute([$parentuser,$last,$parenthashpass,$pphone])){
		return false;
	}else{
	$pid = $con->lastInsertId();
	if(!$isincludeusername==true){
	$studentuser=generateRandomStudentUser($con,5);	
	$studentpass=generateRandomPass(10);
	}else{
	$studentuser=str_replace(' ', '',$first." ".$last.$ia);				
	$studentpass=str_replace(' ', '',$first." ".$last.$ia);		
	}
	$studenthashpass=password_hash($studentpass,PASSWORD_DEFAULT);
	$regdate=date("r");
	$stmt1=$con->prepare("INSERT INTO users (username,firstname,lastname,pass,ispaid,regdate,grou,parentid,mobilenum) VALUES (?,?,?,?,?,?,?,?,?)");
		if ($stmt1->execute([$studentuser,$first,$last,$studenthashpass,$ispaid,$regdate,$group,$pid,$phone])){
			return array("Suser"=>$studentuser,"Spass"=>$studentpass,"Puser"=>$parentuser,"Ppass"=>$parentpass);
		}
	}
	return false;
}

function setStudentGroup($con,$us,$gr){
	if(!isStudentExist($con,$us)){return false;}
	$stmt=$con->prepare("UPDATE users SET grou=? WHERE username=?");
	if($stmt->execute([$gr,$us])){
		return true;
	}
	return false;
}

function getGroupStudents($con,$gr){
	$stmt=$con->prepare("SELECT * FROM users WHERE grou=?");
	if($stmt->execute([$gr])){
		$arr=array();
		$num=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$arr[$num]=$row;
			$num++;
		}
		return $arr;
		
	}
	return false;
}

function addOfflineQuiz($con,$name){
	$stmt=$con->prepare("INSERT INTO offlinequiz(name) VALUES(?)");
	if($stmt->execute([$name])){return true;}
	return false;
}

function getOfflineQuizInfo($con,$id){
	$stmt=$con->prepare("SELECT * FROM offlinequiz WHERE id=?");
	if($stmt->execute([$id])){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	return false;
}
function getOfflineQuizList($con){
	$stmt=$con->prepare("SELECT * FROM offlinequiz");
	if($stmt->execute()){
		$arr=array();
		$num=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$arr[$num]=$row;
			$num++;
		}
		return $arr;
		
	}
	return false;
}

function addStOffRes($con,$quid,$stid,$result){
	$stmt1=$con->prepare("SELECT * FROM offlineresults WHERE studentid=:s AND quizid=:q");
	$stmt1->execute(["s"=>$stid,"q"=>$quid]);
	if($stmt1->rowCount()>0){
		$stmt=$con->prepare("UPDATE offlineresults SET result=:r WHERE studentid=:s AND quizid=:i");
		if($stmt->execute(["r"=>$result,"s"=>$stid,"i"=>$quid])){return true;}
	}else{
		$stmt=$con->prepare("INSERT INTO offlineresults(quizid, studentid, result) VALUES (?,?,?)");
		if($stmt->execute([$quid,$stid,$result])){return true;}
	}
	return false;	
}


function getParentInfoByID($con,$id){
		$stmt=$con->prepare("SELECT * FROM parent WHERE id=?");
		if( $stmt->execute([$id])){
			$inf=$stmt->fetch(PDO::FETCH_ASSOC);
			return $inf;
		}
		return false;
}

function getStudentInfoByUser($con,$user){
		$stmt=$con->prepare("SELECT * FROM users WHERE username=?");
		if( $stmt->execute([$user])){
			$inf=$stmt->fetch(PDO::FETCH_ASSOC);
			return $inf;
		}
		return false;
}

function getStudentInfoById($con,$id){
		$stmt=$con->prepare("SELECT * FROM users WHERE id=?");
		if( $stmt->execute([$id])){
			$inf=$stmt->fetch(PDO::FETCH_ASSOC);
			return $inf;
		}
		return false;
}

function getStudentOffQuizs($con,$user){
	$stmt=$con->prepare("SELECT * FROM users WHERE username=?");
	if( $stmt->execute([$user])){
		$inf=$stmt->fetch(PDO::FETCH_ASSOC);
		$id=$inf["id"];
		$stmt1=$con->prepare("SELECT * FROM offlineresults WHERE studentid=?");
		if( $stmt1->execute([$id])){
			$arr=array();
			$num=0;
			while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
				$arr[$num]=$row;
				$num++;
			}
			return $arr;
		}
	}
	return false;	
}

function getParentChild($con,$user){
		$stmt=$con->prepare("SELECT * FROM parent WHERE username=?");
		if( $stmt->execute([$user])){
			$inf=$stmt->fetch(PDO::FETCH_ASSOC);
			$id=$inf["id"];
			$stmt2=$con->prepare("SELECT * FROM users WHERE parentid=?");
			if( $stmt2->execute([$id])){
				$row=$stmt2->fetch(PDO::FETCH_ASSOC);
				return $row;
			}
		}	
	return false;
}


function getParentInfoByUser($con,$user){
		$stmt=$con->prepare("SELECT * FROM parent WHERE username=?");
		if( $stmt->execute([$user])){
			$inf=$stmt->fetch(PDO::FETCH_ASSOC);
			return $inf;
		}
		return false;
}

function setStudentAttendance($con,$stid,$st){
	$today=date("d-m-Y");
	$stmt1=$con->prepare("SELECT * FROM attendance WHERE studentid=:s AND date=:q");
	$stmt1->execute(["s"=>$stid,"q"=>$today]);
	if($stmt1->rowCount()>0){
		$stmt=$con->prepare("UPDATE attendance SET isattend=:r WHERE studentid=:s AND date=:i");
		if($stmt->execute(["r"=>$st,"s"=>$stid,"i"=>$today])){return true;}
	}else{
		$stmt=$con->prepare("INSERT INTO `attendance`(`studentid`, `date`, `isattend`) VALUES (?,?,?)");
		if($stmt->execute([$stid,$today,$st])){return true;}
	}
	return false;
}
function getStudentAttendance($con,$stid){
		$stmt=$con->prepare("SELECT * FROM attendance WHERE studentid=? ORDER BY date DESC");
		if( $stmt->execute([$stid])){
			$arr=array();
			$num=0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$arr[$num]=$row;
				$num++;
			}
			return $arr;
		}
		return false;	
	
}
function getParentList($con){
		$stmt=$con->prepare("SELECT * FROM parent ORDER BY id DESC");
		$arr=array();
		if( $stmt->execute()){
			$num=0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$arr[$num]=$row;
				$num++;
			}
		}
			return $arr;	
}
function getInboxList($con){
		$stmt=$con->prepare("SELECT * FROM messages WHERE (isparent=? AND owner=?) ORDER BY id DESC");
		$v="0";
		$o="parent";
		$arr=array();
		if( $stmt->execute([$v,$o])){
			$num=0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$arr[$num]=$row;
				$num++;
			}
		}
			return $arr;
	
}

function getSentList($con){
		$stmt=$con->prepare("SELECT * FROM messages WHERE (isparent=? AND owner=?) ORDER BY id DESC");
		$v="0";
		$o="teacher";
		$arr=array();
		if( $stmt->execute([$v,$o])){
			$num=0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$arr[$num]=$row;
				$num++;
			}
		}
			return $arr;
	
}

function newAdminMessage($con,$id,$title,$content){
	$stmt=$con->prepare("INSERT INTO `messages`(`isparent`, `title`, `content`, `byu`, `tou`, `owner`) VALUES (?,?,?,?,?,?)");
	$isp=0;
	$aid=1;
	$ow="teacher";
	if($stmt->execute([$isp,$title,$content,$aid,$id,$ow])){
		return true;
	}
	return false;
}


function newParentMessage($con,$id,$title,$content){
	$stmt=$con->prepare("INSERT INTO `messages`(`isparent`, `title`, `content`, `byu`, `tou`, `owner`) VALUES (?,?,?,?,?,?)");
	$isp=0;
	$aid=1;
	$ow="parent";
	if($stmt->execute([$isp,$title,$content,$id,$aid,$ow])){
		return true;
	}
	return false;
}

function deleteMessage($con,$id){
		$stmt=$con->prepare("SELECT * FROM messages WHERE (isparent=? AND id=?)");
		$v="0";
		$arr=array();
		if( $stmt->execute([$v,$id])){
			$num=0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$arr[$num]=$row;
				$num++;
			}
		}
	for($k=0;$k<count($arr);$k++){
		$stmt=$con->prepare("DELETE FROM messages WHERE id=?");
		$a=$arr[$k]["id"];
		$stmt->execute([$a]);
	}
		$stmt=$con->prepare("DELETE FROM messages WHERE id=?");
		if ($stmt->execute([$id])){return true;}
		return false;
}

function getMySentMessages($con,$myid){
		$stmt=$con->prepare("SELECT * FROM messages WHERE (isparent=? AND owner=? AND byu=?) ORDER BY id DESC");
		$v="0";
		$o="parent";
		$arr=array();
		if( $stmt->execute([$v,$o,$myid])){
			$num=0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$arr[$num]=$row;
				$num++;
			}
		}
			return $arr;
		
}

function getMyInboxMessages($con,$myid){
		$mysnt=getMySentMessages($con,$myid);
		$arr=array();
		for($k=0;$k<count($mysnt);$k++){
			$stmt=$con->prepare("SELECT * FROM messages WHERE isparent=? AND (owner=? AND tou=?) ORDER BY id DESC");
			$v=$mysnt[$k]["id"];
			$o="teacher";
			$stmt->execute([$v,$o,$myid]);
			if($stmt->rowCount()>0){
				array_push($arr,$mysnt[$k]);
			}
		}
			$stmt=$con->prepare("SELECT * FROM messages WHERE isparent=? AND (owner=? AND tou=?) ORDER BY id DESC");
			$v="0";
			$o="teacher";
			$stmt->execute([$v,$o,$myid]);
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($arr,$row);
			}

			return $arr;
		
}
function getMessageInfo($con,$id){
				$stmt=$con->prepare("SELECT * FROM messages WHERE id=?");
			if($stmt->execute([$id])){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				return $row;
			}
			return false;
}

function getMessageChildren($con,$id){
			$stmt=$con->prepare("SELECT * FROM messages WHERE isparent=?");
			$arr=array();
			if($stmt->execute([$id])){
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					array_push($arr,$row);
				}
			}
			return $arr;	
}

function replayMessageByParent($con,$uid,$msgid,$content){
	$stmt=$con->prepare("INSERT INTO `messages`(`isparent`, `title`, `content`, `byu`, `tou`, `owner`) VALUES (?,?,?,?,?,?)");
	$aid=1;
	$ow="parent";
	$t="";
	if($stmt->execute([$msgid,$t,$content,$uid,$aid,$ow])){
		return true;
	}
	return false;	
}

function replayMessageByTeacher($con,$msgid,$content){
	$stmt=$con->prepare("INSERT INTO `messages`(`isparent`, `title`, `content`, `byu`, `tou`, `owner`) VALUES (?,?,?,?,?,?)");
	$aid=1;
	$ow="teacher";
	$t="";
	$owinf=getMessageOwnerInfo($con,$msgid);
	$uid=$owinf["id"];
	if($stmt->execute([$msgid,$t,$content,$aid,$uid,$ow])){
		return true;
	}
	return false;	
}

function getMessageOwnerInfo($con,$id){
	$inf=getMessageInfo($con,$id);
	if($inf["owner"]=="teacher"){$tinf=getParentInfoByID($con,$inf["tou"]);}else{$tinf=getParentInfoByID($con,$inf["byu"]);}
	return $tinf;
}

function isItMessageOwner($con,$id,$uid){
		$inf=getMessageInfo($con,$id);
		if (intval($inf["byu"])==intval($uid) || intval($inf["tou"])==intval($uid)){return true;}
		$child=getMessageChildren($con,$id);
		for($k=0;$k<count($child);$k++){
			if(intval($child[$k]["byu"])==intval($uid) || intval($child[$k]["tou"])==intval($uid))
			{
				return true;
			}
		}
		return false;
}


function updateParentInfo($con,$user,$nuser,$nname,$npass){
	if(!isParentExist($con,$user)){return false;}
	if(isParentExist($con,$nuser)){return false;}		
	$inf=getParentInfoByUser($con,$user);
	$id=$inf["id"];
	if(!empty($npass)){
		$stmt=$con->prepare("UPDATE parent SET username=?,name=?,pass=? WHERE id=?");
		$hpass=password_hash($npass,PASSWORD_DEFAULT);
		if($stmt->execute([$nuser,$nname,$hpass,$id])){
		$ch=getParentChild($con,$_SESSION["user"]);
		$stmt=$con->prepare("UPDATE users SET lastname=? WHERE id=?");
		$i=$ch["id"];
		$stmt->execute([$nname,$i]);
		$_SESSION["user"]=$nuser;
			return true;
		}
	}else{
		$stmt=$con->prepare("UPDATE parent SET username=?,name=? WHERE id=?");
		if($stmt->execute([$nuser,$nname,$id])){
		$ch=getParentChild($con,$_SESSION["user"]);
		$stmt=$con->prepare("UPDATE users SET lastname=? WHERE id=?");
		$i=$ch["id"];
		$stmt->execute([$nname,$i]);
		$_SESSION["user"]=$nuser;
			return true;
		}		
	}
	return false;
}


function updateStudentInfo($con,$user,$nuser,$nname,$npass){
	if(!isStudentExist($con,$user)){return false;}
	if(isStudentExist($con,$nuser)){return false;}		
	$inf=getStudentInfoByUser($con,$user);
	$id=$inf["id"];
	if(!empty($npass)){
		$stmt=$con->prepare("UPDATE users SET username=?,firstname=?,pass=? WHERE id=?");
		$hpass=password_hash($npass,PASSWORD_DEFAULT);
		if($stmt->execute([$nuser,$nname,$hpass,$id])){
		$_SESSION["user"]=$nuser;
			return true;
		}
	}else{
		$stmt=$con->prepare("UPDATE users SET username=?,firstname=? WHERE id=?");
		if($stmt->execute([$nuser,$nname,$id])){
		$_SESSION["user"]=$nuser;
			return true;
		}		
	}
	return false;
}
function updateTeacherPassword($con,$npass){
		$stmt=$con->prepare("UPDATE teacher SET password=? WHERE id=?");
		$hpass=password_hash($npass,PASSWORD_DEFAULT);
		$id=1;
		if($stmt->execute([$hpass,$id])){
			return true;
		}	
		return false;
}
function deleteStudentAttendance($con,$id){
		$stmt=$con->prepare("DELETE FROM attendance WHERE studentid=?");
		if($stmt->execute([$id])){
			return true;
		}
		return false;
}

function deleteStudentResults($con,$id){
		$stmt=$con->prepare("DELETE FROM offlineresults WHERE studentid=?");
		if($stmt->execute([$id])){
			return true;
		}
		return false;
}
function deleteParentMessages($con,$id){
	$tid=(int)$id;
	if($tid!=1){
		$stmt=$con->prepare("DELETE FROM messages WHERE (tou=? OR byu=?)");
		if($stmt->execute([$id,$id])){
			return true;
		}
		return false;
	}else{
		$stmt=$con->prepare("DELETE FROM messages WHERE (tou=? AND owner=?)");
		$ow="teacher";
		if($stmt->execute([$id,$ow])){
			$stmt=$con->prepare("DELETE FROM messages WHERE (byu=? AND owner=?)");
			$ow="parent";
			if($stmt->execute([$id,$ow])){return true;}
		}
		return false;		
		
	}
}
function deleteStudent($con,$id){
		$stmt=$con->prepare("DELETE FROM users WHERE id=?");
		if($stmt->execute([$id])){
			return true;
		}
		return false;
}
function deleteParent($con,$id){
		$stmt=$con->prepare("DELETE FROM parent WHERE id=?");
		if($stmt->execute([$id])){
			return true;
		}
		return false;	
}
function removeStudent($con,$id){
	$student=getStudentInfoById($con,$id);
//student
	deleteStudentAttendance($con,$id);
	deleteStudentResults($con,$id);
//parent
deleteParentMessages($con,$student["parentid"]);
//delete accounts
	if(deleteStudent($con,$id)&&deleteParent($con,$student["parentid"]) ){
		return true;
	}
	return false;
}

function getAttendanceAvilableDate($con){
		$stmt=$con->prepare("SELECT date FROM attendance GROUP BY date");
		$arr=array();
		if( $stmt->execute()){
			$num=0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$arr[$num]=$row;
				$num++;
			}
		}
			return $arr;	
}

function getAttendanceDayStudents($con,$da){
		$stmt=$con->prepare("SELECT * FROM attendance WHERE date=?");
		$arr=array();
		if( $stmt->execute([$da])){
			$num=0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$arr[$num]=$row;
				$num++;
			}
		}
			return $arr;		
}