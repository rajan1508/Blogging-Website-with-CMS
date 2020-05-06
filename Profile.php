<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?>
<?php
if(isset($_GET["username"])){
$searchingparamater = $_GET["username"];}
else{
	$searchingparamater ="tom_cook";
}
global $connectingdb;
$sql = "SELECT aname,aheadline,abio,aimage FROM admins WHERE username=:userName";
$stmt = $connectingdb->prepare($sql);
$stmt->bindValue(':userName',$searchingparamater);
$stmt->execute();
$result=$stmt->rowcount();
if($result==1){
	while ( $datarows = $stmt->fetch() ){
		$ExistingName = $datarows["aname"];
		$ExistingBio = $datarows["abio"];
		$ExistingImage = $datarows["aimage"];
		$ExistingHeadline = $datarows["aheadline"];
	}
}
// else{
// 	$_SESSION["errorMessage"] =  "Bad request!!";
// 	redirect_to("blog.php");
// }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Profile
	</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/all.css">

</head>
<body>
	<!-- NAVBAR--->
<div style="height: 10px;background: #27aae1;"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container" >
		<a href="" class="navbar-brand">MYBLOG.COM</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarcollapseCMS">
		<ul class="navbar-nav mr-auto">
			
			<li class="nav-item">
				<a href="blog.php" class="nav-link">Home</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">About Us</a>
			</li>
			<li class="nav-item">
				<a href="blog.php" class="nav-link">Blog</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">Contact Us</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">Features</a>
			</li>
			
		</ul>
		<ul class="navbar-nav ml-auto">
			<form class="form-inline mr-2 d-none d-sm-block" action="blog.php">
				<div class="form-group">
					<input class="form-control mr-2" type="text" name="search" placeholder="search here" value="">
					<button  class="btn btn-primary" name="searchButton">GO</button>
				</div>
			</form>
		</ul>	
		</div>
		
	</div>
</nav>
<div style="height: 10px;background: #27aae1;"></div>

<!--- NAVBAR ENDS --->

<!--- header--->

<header class="bg-dark text-white py-3">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1> <i class="fas fa-text-user text-success mr-2" style="color: #27aae1;"></i> <?php echo       $ExistingName; ?> </h1>
				<h3> <?php echo $ExistingHeadline; ?></h3>
			</div>
		</div>
	</div>
</header>

<!---header ends---->

<section class="container py-2 mb-4">
	<div class="row">
		<div class="col-md-3">
			<img src="images/<?php echo $ExistingImage; ?>" class="d-block img-fluid mb-3 rounded-circle">
		</div>
		<div class="col-md-9 " style="min-height: 300px;">
			<div class="card">
				<div class="card-body">
					<p class="lead">  <?php echo $ExistingBio; ?></p>
				</div>
			</div>
		</div>
	</div>
</section>



<!-- FOOTER --->
<?php require_once("footer.php") ?>

<!-- footer ends --->

	<script src="https://use.fontawesome.com/79de14b5ce.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(#year).text(new new Date().getFullYear());
</script>
</body>
</html>