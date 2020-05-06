<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?>
<?php 
$_SESSION["trackingURL"] = $_SERVER["PHP_SELF"];
confirm_login(); ?>
<?php  
if(isset($_POST["submit"])){
	$Username = $_POST["Username"];
	$Name = $_POST["Name"]; 
	$Password = $_POST["Password"]; 
	$confirmPassword = $_POST["ConfirmPassword"];
	$Admin = $_SESSION["UserName"];
	date_default_timezone_set("Indian/Reunion");
	$currentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S",$currentTime);

	if(empty($Username || $Password || $confirmPassword)){
		$_SESSION["errorMessage"] = "this field can't be empty";
		redirect_to("admins.php");
	}
	elseif (strlen($Password)<4) {
		$_SESSION["errorMessage"] = "Password must be greater than 4 characters";
		redirect_to("admins.php");
	}
	elseif ($Password !== $confirmPassword) {
		$_SESSION["errorMessage"] = "Password must be matched with confirmPassword";
		redirect_to("admins.php");
	}
	elseif (checkUserNameExist($Username)) {
		$_SESSION["errorMessage"] = "Username exists!!. Try another one.";
		redirect_to("admins.php");
	}
	else{
		global $connectingdb;
		   $sql = "INSERT INTO admins(datetime,username,password,aname,addedby)";
		   $sql.= "VALUES(:datetime,:username,:password,:aname,:adminName)";
		   $stmt = $connectingdb->prepare($sql);
		   $stmt->bindValue(':datetime',$DateTime);
		   $stmt->bindValue(':username',$Username);
		   $stmt->bindValue(':password',$Password);
		   $stmt->bindValue(':aname',$Name);
		   $stmt->bindValue(':adminName',$Admin);
		   
		   $Execute = $stmt->execute();
       
            if($Execute){
              $_SESSION["successMessage"] ="New admin with username ".$Username." added successfully.";
            	redirect_to("admins.php");
            }
            else{
            	$_SESSION["errorMessage"] = "insertion unsuccessful.Try again!!";
            	redirect_to("admins.php");
            }

	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Admin Page
	</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link rel="stylesheet" type="text/css" href="css/Style1.css">

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
				<a href="MyProfile.php" class="nav-link">  <span class="glyphicon glyphicon-triangle-right"></span> <i class="fas fa-user"></i> My Profile</a>
			</li>
			<li class="nav-item">
				<a href="Dashboard.php" class="nav-link">Dashboard</a>
			</li>
			<li class="nav-item">
				<a href="Posts.php" class="nav-link">Posts</a>
			</li>
			<li class="nav-item">
				<a href="Categories.php" class="nav-link">Categories</a>
			</li>
			<li class="nav-item">
				<a href="Admins.php" class="nav-link">Manage Admins</a>
			</li>
			<li class="nav-item">
				<a href="Comments.php" class="nav-link">Comments</a>
			</li>
			<li class="nav-item">
				<a href="Blog.php?page=1" class="nav-link">Live Blog</a>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item">
               <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</li>
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
			<div class="col-md-12">
				<h1> <i class="fas fa-user" style="color: #27aae1;"></i> Manage Admin </h1>
			</div>
		</div>
	</div>
</header>

<!---header ends---->
<!---- main area ---->

<section class="container py-2 mb-4">
	<div class="row" >
		<div class="offset-lg-1 col-lg-10" style="min-height: 400px;" > 
         <?php  
         echo errorMessage();
         echo successMessage();
         ?>

          <form class="" action="admins.php" method="post">
          	<div class="card bg-secondary text-light mb-3">
          		<div class="card-header">
          			<h1> Add New Admin </h1>
          		</div>
          		<div class="card-body bg-dark">
          			<div class="form-group">
          				<label for="Username"><span class="fieldinfo"> Username: </span></label>
          				<input class="form-control" type="text" name="Username" id="Username"  >
          			</div>
          			<div class="form-group">
          				<label for="Name"><span class="fieldinfo"> Name: </span></label>
          				<input class="form-control" type="text" name="Name" id="Name"  >
          				<small class=" text-muted">optional</small>
          			</div>
          			<div class="form-group">
          				<label for="password"><span class="fieldinfo"> Password: </span></label>
          				<input class="form-control" type="password" name="Password" id="Password"  >
          			</div>
          			<div class="form-group">
          				<label for="confirmPassword"><span class="fieldinfo"> confirmPassword: </span></label>
          				<input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword"  >
          			</div>
          			<div class="row" >
          				<div class="col-lg-6 mb-2">
          					<a href="Dashboard.php" class="btn btn-block btn-warning"><i class="fas fa-arrow-left">Back To Dashboard</i></a>
          				</div>
          				<div class="col-lg-6 mb-2">
          					<button type="submit" name="submit" class="btn btn-block btn-success">
          						<i class="fas fa-check">Publish</i>
          					</button>
          				</div>
          			</div>
          		</div>
          	</div>
          </form>

             <h2>Existing Admins</h2>
		<table class="table table-striped table-hover">
			<thead class="thead-dark">
				<tr>
					<th>No.</th>
					<th>Date&Time</th>
					<th>Username</th>
					<th>Admin Name</th>
					<th>Added by</th>
					<th>Action</th>
				</tr>
			</thead>
		
		<?php

         global $connectingdb;
         $sql = "SELECT * FROM admins ORDER BY id desc";
         $execute = $connectingdb->query($sql);
         $srNo = 0;
         while ($datarows = $execute->fetch()) {
         	$AdminId = $datarows["id"];
         	$dateTime = $datarows["datetime"];
         	$AdminName = $datarows["aname"];
         	$AdminUserName = $datarows["username"];
         	$AddedBy = $datarows["addedby"];
         	$srNo++;
           
		?>
		<tbody>
			<tr>
				<td><?php echo htmlentities($srNo); ?></td>
				<td><?php echo htmlentities($dateTime); ?></td>
				<td><?php echo htmlentities($AdminUserName); ?></td>
				<td><?php echo htmlentities($AdminName); ?></td>
				<td><?php echo htmlentities($AddedBy); ?></td>
				<td><a href="deleteAdmin.php?id= <?php echo $AdminId; ?>" class="btn btn-danger" >Delete</a> </td>
			</tr>
		</tbody>
	<?php } ?>
	</table>

		</div>
	</div>
	
</section>


<!---- main area ends --- >

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