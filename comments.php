<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?>
<?php $_SESSION["trackingURL"] = $_SERVER["PHP_SELF"];
confirm_login(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Comments
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
				<h1> <i class="fas fa-comments" style="color: #27aae1;"></i> Manage Comments </h1>
			</div>
		</div>
	</div>
</header>

<!---header ends---->

<br>
<section class="container py-2 mb-4">
<div class="row" style="min-height: 30px;">
	<div class="col-lg-12" style="min-height: 300px;">
		<?php  
         echo errorMessage();
         echo successMessage();
         ?>
		<h2>Un-approved Comments</h2>
		<table class="table table-striped table-hover">
			<thead class="thead-dark">
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Date&Time</th>
					<th>Comment</th>
					<th>Approve</th>
					<th>Delete</th>
					<th>Detail</th>
				</tr>
			</thead>
		
		<?php

         global $connectingdb;
         $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
         $execute = $connectingdb->query($sql);
         $srNo = 0;
         while ($datarows = $execute->fetch()) {
         	$commentId = $datarows["id"];
         	$commentorName = $datarows["name"];
         	$dateTime = $datarows["datetime"];
         	$commentContent = $datarows["comment"];
         	$commentPostId = $datarows["post_id"];
         	$srNo++;
           
		?>
		<tbody>
			<tr>
				<td><?php echo htmlentities($srNo); ?></td>
				<td><?php echo htmlentities($commentorName); ?></td>
				<td><?php echo htmlentities($dateTime); ?></td>
				<td><?php echo htmlentities($commentContent); ?></td>
				<td style="min-width: 140px;"><a href="approveComments.php?id= <?php echo $commentId; ?>" class="btn btn-success" >Approve</a> </td>
				<td><a href="deleteComments.php?id= <?php echo $commentId; ?>" class="btn btn-danger" >Delete</a> </td>
				<td style="min-width: 140px;"><a class="btn btn-primary" href="FullPost.php?id=<?php echo $commentPostId; ?>" target="_blank" >Live Preview</a></td>
			</tr>
		</tbody>
	<?php } ?>
	</table>
    
    <h2>Approved Comments</h2>
		<table class="table table-striped table-hover">
			<thead class="thead-dark">
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Date&Time</th>
					<th>Comment</th>
					<th>Revert</th>
					<th>Delete</th>
					<th>Detail</th>
				</tr>
			</thead>
		
		<?php

         global $connectingdb;
         $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
         $execute = $connectingdb->query($sql);
         $srNo = 0;
         while ($datarows = $execute->fetch()) {
         	$commentId = $datarows["id"];
         	$commentorName = $datarows["name"];
         	$dateTime = $datarows["datetime"];
         	$commentContent = $datarows["comment"];
         	$commentPostId = $datarows["post_id"];
         	$srNo++;
           
		?>
		<tbody>
			<tr>
				<td><?php echo htmlentities($srNo); ?></td>
				<td><?php echo htmlentities($commentorName); ?></td>
				<td><?php echo htmlentities($dateTime); ?></td>
				<td><?php echo htmlentities($commentContent); ?></td>
				<td style="min-width: 140px;"><a href="DisApproveComments.php?id= <?php echo $commentId; ?>" class="btn btn-warning" >Dis-Approve</a> </td>
				<td><a href="deleteComments.php?id= <?php echo $commentId; ?>" class="btn btn-danger" >Delete</a> </td>
				<td style="min-width: 140px;"><a class="btn btn-primary" href="FullPost.php?id=<?php echo $commentPostId; ?>" target="_blank" >Live Preview</a></td>
			</tr>
		</tbody>
	<?php } ?>
	</table>

	</div>
</div>	
</section>


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