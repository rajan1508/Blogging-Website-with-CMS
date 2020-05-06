<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?>
<?php confirm_login(); ?>
<?php 
$searchingParameter = $_GET["id"]; 
 global $connectingdb;
         $sql = "SELECT * FROM posts WHERE id='$searchingParameter' ";
         $stmt = $connectingdb->query("$sql");
         while ($dataRows = $stmt->fetch() ) {
         	$TitleToBeDeleted = $dataRows['title'];
         	$CategoryToBeDeleted = $dataRows['category'];
         	$ImageToBeDeleted = $dataRows['image'];
         	$PostToBeDeleted = $dataRows['post'];
         }
if(isset($_POST["submit"])){
	
           global $connectingdb; 

           $sql = "DELETE FROM posts WHERE id = '$searchingParameter' ";
		    $Execute = $connectingdb->query($sql);
       
            if($Execute){
            	$Target_path_to_delete_image = "uploads/$ImageToBeDeleted";
            	unlink($Target_path_to_delete_image);
            	$_SESSION["successMessage"] = "Post with id: ".$searchingParameter." deleted successfully.";
            	redirect_to("posts.php");
            }
            else{
            	$_SESSION["errorMessage"] = "deletion unsuccessful.Try again!!";
            	redirect_to("posts.php");
            }

	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Edit Post
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
				<h1> <i class="fas fa-trash" style="color: #27aae1;"></i> Delete Post </h1>
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

          <form class="" action="DeletePost.php?id=<?php echo $searchingParameter; ?>" method="post" enctype="multipart/form-data">
          	<div class="card bg-secondary text-light mb-3">
          		
          		<div class="card-body bg-dark">
          			<div class="form-group">
          				<label for="title"><span class="fieldinfo"> Post Title: </span></label>
          				<input disabled="true" class="form-control" type="text" name="Title" id="title" placeholder="type title here" value="<?php echo $TitleToBeDeleted?>">
          			</div>

          			<div class="form-group">
          				<span class="fieldinfo">Existing category:</span>
          				<?php echo "$CategoryToBeDeleted"; ?>       				
          			</div>
                     
                     <div class="form-group">
                     	<span class="fieldinfo">Existing Image:</span>
          				<img src="uploads/<?php echo "$ImageToBeDeleted"; ?>" width="170px" height = "80px">

                     <div class="form-group">
                     	<label for="Post"><span class="fieldinfo"> Post: </span></label>
                     	<textarea disabled="true" class="form-control" id="Post" name="postDescripton" rows="8" cols="80">
                     		<?php echo "$PostToBeDeleted"; ?>
                     	</textarea>
                     </div>

          			<div class="row" >
          				<div class="col-lg-6 mb-2">
          					<a href="Dashboard.php" class="btn btn-block btn-warning"><i class="fas fa-arrow-left">Back To Dashboard</i></a>
          				</div>
          				<div class="col-lg-6 mb-2">
          					<button type="submit" name="submit" class="btn btn-block btn-danger">
          						<i class="fas fa-trash">Delete</i>
          					</button>
          				</div>
          			</div>
          		</div>
          	</div>
          </form>

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