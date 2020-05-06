<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?>
<?php $_SESSION["trackingURL"] = $_SERVER["PHP_SELF"]; ?>
<?php  
if(isset($_POST["submit"])){
	$Categorytitle = $_POST["Title"]; 
	$admin = $_SESSION["UserName"];
	date_default_timezone_set("Indian/Reunion");
	$currentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S",$currentTime);
	if(empty($Categorytitle)){
		$_SESSION["errorMessage"] = "this field can't be empty";
		redirect_to("categories.php");
	}
	elseif (strlen($Categorytitle)<3) {
		$_SESSION["errorMessage"] = "title length must be greater than 2 characters";
		redirect_to("categories.php");
	}
	elseif (strlen($Categorytitle)>49) {
		$_SESSION["errorMessage"] = "title length must be less than 50 characters";
		redirect_to("categories.php");
	}
	else{
		   global $connectingdb;
		   $sql = "INSERT INTO category(title,autor,datetime)";
		   $sql.= "VALUES(:categoryName,:adminName,:datetime)";
		   $stmt = $connectingdb->prepare($sql);
		   $stmt->bindValue(':categoryName',$Categorytitle);
		   $stmt->bindValue(':adminName',$admin);
		   $stmt->bindValue(':datetime',$DateTime);
		   $Execute = $stmt->execute();
       
            if($Execute){

            	$_SESSION["successMessage"] = "category inserted successfully.";
            	redirect_to("categories.php");
            }
            else{
            	// echo var_dump($Execute);
            	// $_SESSION["errorMessage"] = "insertion unsuccessful.Try again!!";
            	// redirect_to("categories.php");
            	 print_r($stmt->errorInfo());
            }

	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		CATEGORIES
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
				<h1> <i class="fas fa-edit" style="color: #27aae1;"></i> Manage Categories </h1>
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

          <form class="" action="categories.php" method="post">
          	<div class="card bg-secondary text-light mb-3">
          		<div class="card-header">
          			<h1> Add New Category</h1>
          		</div>
          		<div class="card-body bg-dark">
          			<div class="form-group">
          				<label for="title"><span class="fieldinfo"> Category Title: </span></label>
          				<input class="form-control" type="text" name="Title" id="title" placeholder="type title here" >
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

           <h2>Existing Categories</h2>
		<table class="table table-striped table-hover">
			<thead class="thead-dark">
				<tr>
					<th>No.</th>
					<th>Date&Time</th>
					<th>Category Name</th>
					<th>Creator Name</th>
					<th>Action</th>
				</tr>
			</thead>
		
		<?php

         global $connectingdb;
         $sql = "SELECT * FROM category ORDER BY id desc";
         $execute = $connectingdb->query($sql);
         $srNo = 0;
         while ($datarows = $execute->fetch()) {
         	$categoryId = $datarows["id"];
         	$categoryName = $datarows["title"];
         	$dateTime = $datarows["datetime"];
         	$creatorName = $datarows["autor"];
         	$srNo++;
           
		?>
		<tbody>
			<tr>
				<td><?php echo htmlentities($srNo); ?></td>
				<td><?php echo htmlentities($dateTime); ?></td>
				<td><?php echo htmlentities($categoryName); ?></td>
				<td><?php echo htmlentities($creatorName); ?></td>
				<td><a href="deleteCategory.php?id= <?php echo $categoryId; ?>" class="btn btn-danger" >Delete</a> </td>
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