<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?>
<?php  
if(isset($_SESSION["UserId"])){
  redirect_to("Dashboard.php");
}

if(isset($_POST["Submit"])){
 $Username = $_POST["Username"];
 $Password = $_POST["Password"];
 if(empty($Username) || empty($Password)){
 	$_SESSION["errorMessage"] = "All field must be filled out!!";
		redirect_to("login.php");
 }else{
 	$found_account = login_attempt($Username,$Password);
 	if($found_account){
 		$_SESSION["UserId"] = $found_account["id"];
 		$_SESSION["UserName"] = $found_account["username"];
 		$_SESSION["AdminName"] =$found_account["aname"];

 		$_SESSION["successMessage"] = "Welcome! ".$_SESSION["UserName"];
    if($_SESSION["trackingURL"]){
 		redirect_to($_SESSION["trackingURL"]);
  } else{
    redirect_to("Dashboard.php");
  }
 	}
 	else{
 		$_SESSION["errorMessage"] = "Incorrect Username or Password!";
		redirect_to("login.php");
 	}
 }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Login
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
		
		</div>
		
	</div>
</nav>
<div style="height: 10px;background: #27aae1;"></div>

<!--- NAVBAR ENDS --->

<!--- header--->

<header class="bg-dark text-white py-3">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
			</div>
		</div>
	</div>
</header>

<!---header ends---->
 
 <!---main area start --->
  
  <section class=" container py-2 mb-4">
  	<div class="row">
  		<div class="offset-sm-3 col-sm-6" style="min-height: 400px;">
  			<br><br>
  			<?php  
         echo errorMessage();
         echo successMessage();
         ?>
  		<div class="card text-light bg-secondary">
  			<div class="card-header">
  			  <h4>welcome back</h4>
  			</div>
  			   <div class="card-body bg-dark">
  			   
  			   <form class=" " action="login.php" method="post">
  			   	 <div class="form-group ">  			  
  			   	 	<label for="username"><span class="fieldinfo"> Username:</span></label>
  			   	 	<div class="input-group mb-3">
  			   	 		<div class="input-group-prepend">
  			   	 			<span class="input-group-text text-white bg-info">
  			   	 				<i class="fas fa-user"></i>
  			   	 			</span>
  			   	 		</div>
  			   	 		<input type="text" class="form-control" name="Username" id="username">
  			   	 	</div>
  			   	 </div>
  			   	 <div class="form-group ">  			  
  			   	 	<label for="password"><span class="fieldinfo"> Password:</span></label>
  			   	 	<div class="input-group mb-3">
  			   	 		<div class="input-group-prepend">
  			   	 			<span class="input-group-text text-white bg-info">
  			   	 				<i class="fas fa-lock"></i>
  			   	 			</span>
  			   	 		</div>
  			   	 		<input type="password" class="form-control" name="Password" id="password">
  			   	 	</div>
  			   	 </div>
  			   	 <input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">
  			   </form>
  			</div>
  		</div>
  	    </div>
  	</div>
  </section>

 <!----main area ends --->
<!-- footer -->

<footer class="bg-dark text-white">
  <div class="container">
    <div class="row">
      <div class="col">
      <p class="lead text-center"> Created by |Rajan Pandey| <span id="year"> </span> &copy; --All rights reserved </p>
    </div></div>
    <div class="text-center small"> <a href="#" style="color: white; text-decoration: none; cursor: pointer;">
      This site  MyBlog.com is a blogging website and have all the rights reserved. No one is allowed to distribute the copies other than <br> &trade; MyBlog.com
    </a></div>
  </div>
</footer>

   <!-- footer ends -->

	<script src="https://use.fontawesome.com/79de14b5ce.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(#year).text(new new Date().getFullYear());
</script>
</body>
</html>