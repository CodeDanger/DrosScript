<?php
include("../functions.php");
session_start();
if (isset($_SESSION["loggedin"]) && password_verify("admin",$_SESSION["loggedin"])){
	header("Location: dashboard.php");
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


	<title>Teacher Portal</title>

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
				<a href="index.php" class="navbar-brand mx-auto d-block text-center order-0 order-md-1 w-25">Teacher Portal</a>
				<div class="navbar-collapse collapse dual-nav w-50 order-2">
					<ul class="nav navbar-nav ml-auto">
						<li class="nav-item"><a class="nav-link" href="#mrkhaled facebook link here"><i class="fab fa-facebook-f"></i></a></li>
						<li class="nav-item"><a class="nav-link" href="#mrkhaled twitter link here"><i class="fab fa-twitter"></i></a></li>
					</ul>
				</div>
			</div>
		</nav>

  </div>
  <button type="button" id="warn" class="btn btn-primary" style="display:none;" data-toggle="modal" data-target="#modal">
</button>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLongTitle">Warning</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-danger">
        <?php
			if(!empty($_GET["warning"])){
				echo $_GET["warning"];
			}
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
	if(!empty($_GET["warning"])){
		echo "<script>$('#warn').click();</script>";
	}
?>

	<div class="content bg-dark text-center">
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<form class="jumbotron" method="POST" action="login.php">
						<h1>Welcome</h1>
						  <div class="form-group">
							<label for="userid"><?php echo $siteowner;?></label>
							<small id="userid" class="form-text text-muted">And His Assistants</small>
						  </div>
						  <div class="form-group">
							<label for="pass">Password</label>
							<input type="password" name="pass" class="form-control" id="pass" placeholder="Enter Password The Teacher Enter Password Only">
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