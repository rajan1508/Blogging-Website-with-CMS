<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?> 
<?php 
$_SESSION["trackingURL"] = $_SERVER["PHP_SELF"];
confirm_login(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Posts
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
				<h1> <i class="fas fa-blog" style="color: #27aae1;"></i> Blog Posts </h1>
			</div>
			<div class="col-lg-3">
				<a href="addNewPost.php" class="btn btn-block btn-primary mb-2">
					<i class="fas fa-edit"></i>Add New Post
				</a>
			</div>
			<div class="col-lg-3">
				<a href="categories.php" class="btn btn-block btn-info mb-2">
					<i class="fas fa-folder-plus"></i>Add New Category
				</a>
			</div>
			<div class="col-lg-3">
				<a href="admins .php" class="btn btn-block btn-warning mb-2">
					<i class="fas fa-user-plus"></i>Add New Admin
				</a>
			</div>
			<div class="col-lg-3">
				<a href="comments.php" class="btn btn-block btn-success mb-2">
					<i class="fas fa-check"></i>Approve Comments
				</a>
			</div>
		</div>
	</div>
</header>

<!---header ends---->

<!----Main Area ---->
<section class="container py-2 mb-4">
	<div class="row">
		<div class="col-lg-12">
			<?php  
         echo errorMessage();
         echo successMessage();
         ?>
			<table class="table table-striped table-hover">
				<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Category</th>
					<th>Date&Time</th>
					<th>Author</th>
					<th>Banner</th>
					<th>Comments</th>
					<th>Action</th>
					<th>Live Preview</th>
				</tr></thead>
				<?php
                 global $connectingdb;
                 $sql = "SELECT * FROM posts";
                 $stmt = $connectingdb->query($sql);
                 $sr = 0;
                 while($datarows = $stmt->fetch()){
                 $Id = $datarows["id"];
                 $DateTime = $datarows["datetime"];
                 $PostTitle = $datarows["title"];
                 $Category = $datarows["category"];
                 $Admin = $datarows["author"];
                 $Image = $datarows["image"];
                 $PostText = $datarows["post"];
                 $sr++;
				?>
				<tbody>
				<tr>
					<td><?php echo $sr;  ?></td>
					<td>
					<?php 
                     if(strlen($PostTitle)>18){
                     	$PostTitle = substr($PostTitle,0,18).'..';
                     }
					 echo $PostTitle;  ?>
					 </td>

					<td>
					<?php 
                     if(strlen($Category)>8){
                     	$Category = substr($Category,0,8).'..';
                     }
					echo $Category ?>
					</td>					
					<td>
					<?php
                       if(strlen($DateTime)>11){
                     	$DateTime = substr($DateTime,0,11).'..';
                     }
					  echo $DateTime ?>
					  </td>
					<td>
					<?php 
                     if(strlen($Admin)>6){
                     	$Admin = substr($Admin,0,6).'..';
                     }
					echo $Admin ?>
					</td>
					<td>
					<img src="uploads/<?php echo $Image ?>" width ="100px" height="50px">
					</td>
					
					<td>
         		 			
         		 				<?php
         		 				global $connectingdb;
         		 				$sql1 = "SELECT COUNT(*) FROM comments WHERE post_id='$Id' AND status='ON' ";
         		 				$stmt1 = $connectingdb->query($sql1);
         		 				$rowsTotal = $stmt1->fetch();
         		 				$total = array_shift($rowsTotal);
         		 				if($total>0){
                                     ?>
         		 					<span class="badge badge-success">
         		 						<?php
         		 					echo $total;
         		 					    ?>
         		 					</span>
         		 					<?php
         		 				}
         		 				
         		 				?>
         		 			<?php
         		 				global $connectingdb;
         		 				$sql2 = "SELECT COUNT(*) FROM comments WHERE post_id='$Id' AND status='OFF' ";
         		 				$stmt2 = $connectingdb->query($sql2);
         		 				$rowsTotal = $stmt2->fetch();
         		 				$total = array_shift($rowsTotal);
         		 				if($total>0){
                                     ?>
         		 					<span class="badge badge-danger">
         		 						<?php
         		 					echo $total;
         		 					    ?>
         		 					</span>
         		 					<?php
         		 				}
         		 				
         		 				?>
         		 		</td>
					<td><a href="EditPost.php?id=<?php echo $Id; ?>" class="btn btn-warning"><span>Edit</span></a>
						<a href="DeletePost.php?id=<?php echo $Id; ?>" class="btn btn-danger"><span>Delete</span></a></td>
					<td><a href="FullPost.php?id=<?php echo $Id; ?>" target = "_blank" class="btn btn-primary"><span>Live Preview</span></a></td>
				</tr></tbody>
				<?php } ?>
			</table>
		</div>
	</div>
</section>
<!---- Main Area Ends -->

 <!-- footer-starts -->

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