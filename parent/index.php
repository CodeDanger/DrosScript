<?php
include("../functions.php");
session_start();
session_regenerate_id();
if (isset($_SESSION["loggedin"]) && password_verify("parent",$_SESSION["loggedin"])){
	header("Location: dashboard.php");
	exit();
}
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


	<title>Parent Portal</title>

  <link href="../css/sb-admin.css" rel="stylesheet">
  <link href="../css/main.css" rel="stylesheet">

</head>

<body id="page-top">
<div class="wrapper">
  <div class="header">
		<nav class="navbar navbar-dark navbar-expand-md bg-success justify-content-between">
			<div class="container-fluid">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-nav">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="navbar-collapse collapse dual-nav w-50 order-1 order-md-0">
					<ul class="navbar-nav">

					</ul>
				</div>
				<a href="index.php" class="navbar-brand mx-auto d-block text-center order-0 order-md-1 w-25">Parent Portal</a>
				<div class="navbar-collapse collapse dual-nav w-50 order-2">
					<ul class="nav navbar-nav ml-auto">
						<li class="nav-item"><a class="nav-link" href="#mrkhaled facebook link here"><i class="fab fa-facebook-f"></i></a></li>
						<li class="nav-item"><a class="nav-link" href="#mrkhaled twitter link here"><i class="fab fa-twitter"></i></a></li>
					</ul>
				</div>
			</div>
		</nav>

  </div>
  
	<div class="content bg-dark text-center">
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<form class="jumbotron" method="POST" action="login.php">
						<h1><?php echo $siteowner;?></h1>
						  <div class="form-group">
							<label for="userid">Username</label>
							<input type="text"  name="user" class="form-control" id="userid" aria-describedby="userid" placeholder="Enter Username Like Xymms88 ...etc">
							<small id="userid" class="form-text text-muted">Make Sure You Are Not Sharing Your Password</small>
						  </div>
						  <div class="form-group">
							<label for="pass">Password</label>
							<input type="password" name="pass" class="form-control" id="pass" placeholder="Enter Password">
						  </div>
						  <button type="submit" name="submit" class="btn btn-success">Login</button>
						</form>
						  <button onclick="window.location.href='../'" class="btn btn-primary my-2">Back To Home</button>

					</div>
				</div>
			</div>
	</div>
	<div class="footer text-center bg-success text-light">
		
		Copyright @2019 Ali Metwally
	
	</div>
</div>
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
  
  <script src="../js/sb-admin.min.js"></script>

  <script src="../js/demo/datatables-demo.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>

</body>

</html>
<?php
	
$con=null;