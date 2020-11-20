<?php
include('../functions.php');
session_start();
if (!isset($_SESSION["loggedin"]) || !password_verify("admin",$_SESSION["loggedin"])){
	header("Location: index.php");
	exit();
}
$con=connect();
$msglist=getInboxList($con);
?>

<!DOCTYPE html>
<html >

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.compatibility.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.compatibility.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


	<title>Teacher Panel</title>

  <link href="../css/sb-admin.css" rel="stylesheet">
</head>

<body id="page-top">

 
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php"><?php echo $siteowner;?></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
     
     
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="settings.php">Settings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Quizs</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="newoffline.php">Add Quiz</a>		   
          <a class="dropdown-item" href="offlineresult.php">Set Results</a>		   
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Groups</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown2">
          <a class="dropdown-item" href="addgroup.php">Add Group</a>
          <a class="dropdown-item" href="removegroup.php">Remove Group</a>
		</div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Students</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown3">
		          <h6 class="dropdown-header">Student:</h6>
          <a class="dropdown-item" href="addstudent.php">Add</a>
          <a class="dropdown-item" href="removestudent.php">Remove</a>
          <a class="dropdown-item" href="setgroup.php">Set Group</a>
		</div>
      </li>
	  	  
	  <li class="nav-item">
        <a class="nav-link" href="attendance.php">
          <i class="fas fa-fw fa-folder"></i>
          <span>Attendance</span></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="message.php">
          <i class="fas fa-envelope fa-fw"></i>
          <span>Messages Center</span></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="../Logout.php">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>
    </ul>
    <div id="content-wrapper" class="">

      <div class="container-fluid">

     
     
	 <div class="container-fluid justify-content-center text-center">
			<div class="container">
				<div class="row bg-dark text-light p-2 my-3">
					<div class="col-12" >
					  <h1> Message Center</h1>
					 <div class="text-left">
						<a class="btn btn-primary" href="newmsg.php">New Message</a>
					 </div>
					</div>
					<div class="col-3 my-2" >
							<div class="row">
								<div class="col-12 py-2 border-bottom border-white">
									Category
								</div>
								<div class="col-12 py-2">
									<a href="message.php" class="btn text-light <?php if(empty($_GET["sent"])){echo 'bg-white text-dark';}?>">Inbox</a>
								</div>
								<div class="col-12 py-2">
									<a href="message.php?sent=true" class="btn text-light <?php if(!empty($_GET["sent"])){echo 'bg-white text-dark';}?>">Sent</a>
								</div>
							</div>
					  </div>
					<div class="col-9 my-4"  >
					  <div class=" bg-light"style="color:blue;">
						Messages
						  </div>
						<div class="card mb-3">
						  <div class="card-header">
							<i class="fas fa-table"></i>
							<?php if(empty($_GET["sent"])){echo "Inbox";}else {echo "Sent";}?></div>
						  <div class="card-body">
							<div class="table-responsive">
							  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
								  <tr>
									<th>ID</th>
									<th>Title</th>
									<th>Read</th>
									<th>Action</th>
								  </tr>
								</thead>
								<tfoot>
								  <tr>
									<th>ID</th>
									<th>Title</th>
									<th>Read</th>
									<th>Action</th>
								  </tr>
								</tfoot>
								<tbody>
								  <?php
								if(empty($_GET["sent"])){
									 $msglist=getInboxList($con);
									 for ($k=0;$k<count($msglist);$k++){
										 echo'<tr>
											<td>'.$msglist[$k]["id"].'</td>
											<td>'.$msglist[$k]["title"].'</td>
											<td><a class="btn btn-primary" href="viewmsg.php?id='.$msglist[$k]["id"].'">Open</a></td>
											<td><a class="btn btn-danger" href="deletemsg.php?id='.$msglist[$k]["id"].'">Delete</a></td>
										  </tr>';
									  }
								}else{
									 $msglist=getSentList($con);
									 for ($k=0;$k<count($msglist);$k++){
										 echo'<tr>
											<td>'.$msglist[$k]["id"].'</td>
											<td>'.$msglist[$k]["title"].'</td>
											<td><a class="btn btn-primary" href="viewmsg.php?id='.$msglist[$k]["id"].'">Open</a></td>
											<td><a class="btn btn-danger" href="deletemsg.php?id='.$msglist[$k]["id"].'">Delete</a></td>
										  </tr>';
									  }									
								}
								 ?>
								</tbody>
							  </table>
							</div>
						  </div>
						  <div class="card-footer small text-muted"></div>
						</div>
					</div>
				  </div>
				</div>
			</div>

	 </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright ©2019 Ali Metwally +201011860707</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../Logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>


  <script src="../vendor/chart.js/Chart.min.js"></script>

  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
  
  <script src="js/sb-admin.min.js"></script>

  <script src="../js/demo/datatables-demo.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>

</body>

</html>
<?php
	
$con=null;