<?php
include("functions.php");
$imgs=getDirFiles("img/carousel");
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

<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

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


	<title><? echo $siteowner;?> Home</title>

  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">

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
				<a href="index.php" class="navbar-brand mx-auto d-block text-center order-0 order-md-1 w-25"><?php echo $siteowner;?></a>
				<div class="navbar-collapse collapse dual-nav w-50 order-2">
					<ul class="nav navbar-nav ml-auto">
						<li class="nav-item"><a class="nav-link" href="#mrkhaled facebook link here"><i class="fab fa-facebook-f"></i></a></li>
						<li class="nav-item"><a class="nav-link" href="#mrkhaled twitter link here"><i class="fab fa-twitter"></i></a></li>
					</ul>
				</div>
			</div>
		</nav>

  </div>
  
	<div class="content bg-light">
  
<div id="section1" class="container-fluid text-center" >
  <h1 class="border-bottom border-dark text-center bg-dark text-light">Chimstry Course</h1>
	

<div id="demo" class="carousel slide carousel-dark" data-ride="carousel">
  <ul class="carousel-indicators">
  <?php
		for ($k=0;$k<count($imgs);$k++){
			if($k==0){
			echo '<li data-target="#demo" data-slide-to="'.$k.'" class="active bg-dark"></li>
			';
			}else{
			echo '<li data-target="#demo" data-slide-to="'.$k.'" class="bg-dark"></li>
			';				
			}
		}
   ?>
  </ul>
  <div class="carousel-inner">
	<?php
		for ($k=0;$k<count($imgs);$k++){
			if ($k==0){
			echo'<div class="carousel-item active">
					<img src="img/carousel/'.$imgs[$k].'" alt="img" width="1100" height="500" style="max-height:500px;">
				</div>
				';
			}else{
			echo'<div class="carousel-item">
					<img src="img/carousel/'.$imgs[$k].'" alt="img" width="1100" height="500" style="max-height:500px;">
				</div>
				';				
			}
		
		}
	?>
  </div>
  
  <a class="carousel-control-prev bg-dark" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon text-dark"></span>
  </a>
  <a class="carousel-control-next bg-dark" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

	
  </div>
<div id="section2" class="container-fluid text-center " style="background:#ffffff;">
  <h1 class="border-bottom border-dark text-center bg-dark text-light my-5">Login</h1>
	
	<div class="row p-3 mx-3">
		<div class="col btn btn-primary mx-3" onclick="window.location.href='student/'">
			Student
		</div>
		<div class="col btn btn-success mx-3" onclick="window.location.href='parent/'">
			Parent
		</div>
		<div class="col btn btn-danger mx-3" onclick="window.location.href='teacher/'">
			Teacher
		</div>
	</div>
			<button class="btn btn-success" onclick="window.location.href='knowledgebase.php'">Go To Knowledge Base</button> 
	
  </div>
  

  <div id="section4" class="container-fluid text-center" >
  <h1 class="border-bottom border-dark text-center bg-dark text-light my-5">Contact Us</h1>
	<div class="row">
		<div class="col">
			<i class="fas fa-envelope p-2 fa-5x"></i>
			<br/>
			Contact Us By Mail <br/>
			<h4>youremail@mail.com</h4>
		</div>
		<div class="col">
			<i class="fas fa-phone p-2 fa-5x"></i>
			<br/>
			Contact Us By Phone <br/>
			<h4>002010...35</h4>
		</div>
	</div>
	
  </div>

	</div>
	<div class="footer text-center bg-success text-light">
		
		Copyright @2019 Ali Metwally
	
	</div>
</div>
  <script src="vendor/chart.js/Chart.min.js"></script>

  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
  
  <script src="js/sb-admin.min.js"></script>

  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
<?php
	
$con=null;