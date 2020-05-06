<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Blog Page
	</title>
	<style type="text/css">
		.heading{
	font-family: Bitter,Georgia,"Times New Roman",Times,Serif;
	font-weight: bold;
	color: #005E90;
	}
	.heading:hover{
	color: #0090DB;
	}
	</style>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/all.css">

</head>
<body>
	<!-- NAVBAR--->
<div style="height: 10px;background: #27aae1;"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container" >
		<a href="blog.php?Page=1" class="navbar-brand">MYBLOG.COM</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarcollapseCMS">
		<ul class="navbar-nav mr-auto">
			
			<li class="nav-item">
				<a href="blog.php?Page=1" class="nav-link">Home</a>
			</li>
			<li class="nav-item">
				<a href="blog.php?page=1" class="nav-link">Blog</a>
			</li>
			<li class="nav-item">
				<a href="aboutus.php" class="nav-link">About Us</a>
			</li>
			<li class="nav-item">
				<a href="contact.php" class="nav-link">Contact Us</a>
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
<div class="container ">
	<div class="row mt-4">
		<!--- Main Area Start --->
		<div class="col-sm-8" >
			
			<?php  
              echo errorMessage();
              echo successMessage();
            ?>
             <?php 
             global $connectingdb;

             // sql query when search button is active

             if(isset($_GET["searchButton"])){
             	$Search = $_GET["search"];
             	$sql = "SELECT * FROM posts 
             	        WHERE datetime LIKE :search 
             	        OR title LIKE :search
             	        OR category LIKE :search
             	        OR post LIKE :search";
             	$stmt = $connectingdb->prepare($sql);
             	$stmt->bindvalue(':search','%'.$Search.'%');
             	$stmt->execute();
             }
             //query when pagination is active i.e blog.php?page=1
             else if(isset($_GET["Page"])){
                    $Page = $_GET["Page"];
                    if($Page<1){
                    	$showPostFrom=0;
                    }else{ 
                    $showPostFrom = (($Page*4)-4);
                }
                    $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $showPostFrom,4";
                    $stmt = $connectingdb->query($sql);
             }
             //query when category is active i.e blog.php?category=...
             elseif (isset($_GET["category"])) {
             	$Category = $_GET["category"];
             	$sql = "SELECT * FROM posts WHERE category ='$Category' ORDER BY id desc ";
             	$stmt = $connectingdb->query($sql);

             }
              //the default sql query
             else{
               $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 0,3";
               $stmt = $connectingdb->query($sql);
           }
               
                while($datarows = $stmt->fetch()){
                 $PostId = $datarows["id"];
                 $DateTime = $datarows["datetime"];
                 $PostTitle = $datarows["title"];
                 $Category = $datarows["category"];
                 $Admin = $datarows["author"];
                 $Image = $datarows["image"];
                 $PostText = $datarows["post"];
             
             ?>
             

 
             <div class="card">
             	<img src="uploads/<?php echo $Image; ?>" style="max-height: 450px; " class="img-fluid card-img-top">
             	<div class="card-body">
             		<h4 class="card-title"> <?php echo htmlentities($PostTitle); ?> </h4>
             		<small>written by <a href="Profile.php?username=<?php echo $Admin; ?> "><?php echo htmlentities($Admin); ?></a> on <?php echo htmlentities($DateTime); ?></small> 
             		<span style="float: right;" class="badge badge-dark text-light">Comments 
             			<?php
             			global $connectingdb;
         		 				$sql2 = "SELECT COUNT(*) FROM comments WHERE post_id=' $PostId' AND status='ON' ";
         		 				$stmt2 = $connectingdb->query($sql2);
         		 				$rowsTotal = $stmt2->fetch();
         		 				$total = array_shift($rowsTotal);
                                echo $total;
         		 			     ?>
         		 			    
         		 			     </span>
             		<hr>
             		<p><?php 
             		if(strlen($PostText)>150){
             			$PostText = substr($PostText,0,150)."......";
             		}
             		echo htmlentities($PostText); 
             		?></p>

             		<a href="FullPost.php?id=<?php echo $PostId; ?>">
             			<span style="float: right;" class="btn btn-info">Read More >></span>
             		</a>
             	</div>
             </div>
         <?php } ?>
         <!------Pagination---->
         <nav>
         	<ul class="pagination pagination-lg">
         		<!-- creating backward button -->
         	<?php
         	if(isset($Page) AND !empty($Page)){
         	if($Page>1){ ?>
         	<li class="page-item">
         			<a href="blog.php?Page=<?php echo $Page-1; ?>" class="page-link">&laquo;</a>
         	</li>
         	<?php } }?>
         		<?php
         		global $connectingdb;
         		$sql = "SELECT COUNT(*) FROM posts";
         		$stmt = $connectingdb->query($sql);
         		$rowPagination = $stmt->fetch();
         		$totalPosts = array_shift($rowPagination);
         		// echo $totalPosts."<br>";
         		$postPagination = ceil($totalPosts/4);
         		// echo $postPagination;
         		for ($i=1; $i <= $postPagination ; $i++) {
         		if(isset($Page)) {
         			if ($i==$Page) { ?>
         				<li class="page-item active">
         			<a href="blog.php?Page=<?php echo $i; ?>" class="page-link" ><?php echo $i; ?></a>
         		</li>
         		<?php		
         			}
         			else{
         		?>
         		<li class="page-item">
         			<a href="blog.php?Page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
         		</li>
         	<?php } } } ?>

         	<!-- creating forward button -->
         	<?php
         	if(isset($Page) AND !empty($Page)){
         	if($Page+1 <= $postPagination){ ?>
         	<li class="page-item">
         			<a href="blog.php?Page=<?php echo $Page+1; ?>" class="page-link">&raquo;</a>
         	</li>
         	<?php } }?>

         		
         	</ul>
         </nav>

            </div>
			<!---- Main Area End----->
		
		<!---- Side Area Start -->
		<div class="col-sm-4" >
			<div class="card mt-2">
			<div class="card-body">
				<img src="images/blog.jpg" class="d-block img-fluid mb-3">
				<div class="text-center">Blogging platform
			The first thing you should do is find the best blog site. There are many of these, with all kinds of different features, but I use and recommend self-hosted WordPress.org. It’s one of the biggest and easiest blogging sites and it allows you to design your blog with ease. Simplicity is key here.

			Web host and a domain name
			Free blogs have tons of limitations and downsides, but self-hosting a blog on your domain allows you to fully own your blog. That’s why you should seriously consider hosting a blog on your own domain. I tested Bluehost, a web hosting company that provides you with a free domain name, and I recommend them to all new bloggers.</div>
			</div>				
			</div>

			<br>
			<div class="card">
				<div class="card-header bg-dark text-light">
					<h2 class="lead">Sign Up!</h2>
				</div>
				<div class="card-body">
					<button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button">Join the Forum</button>
					<button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button">Login</button>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="enter your email" name="">
						<div class="input-group-append">
							<button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now!</button>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="card">
				<div class="card-header bg-primary text-light">
					<h2 class="lead">Categories</h2>
				</div>
					<div class="card-body">
						<?php
						global $connectingdb;
						$sql = "SELECT * FROM category ORDER BY ID desc";
						$stmt = $connectingdb->query($sql);
						while ($datarows = $stmt->fetch()) {
						 	$categoryId = $datarows["id"];
						 	$categoryName = $datarows["title"];
						   
						?> 
						<a href="blog.php?category=<?php echo $categoryName; ?>"><span class="heading"><?php echo $categoryName ?></span></a><br>
					<?php } ?>
					</div>
				
			</div>
			<br>

			<div class="card">
				<div class="card-header bg-info text-white">
					<h2 class="lead">Recent Posts</h2>
				</div>
				<div class="card-body">
					<?php 
					global $connectingdb;
					$sql = "SELECT * FROM posts ORDER BY id LIMIT 0,5";
					$stmt = $connectingdb->query($sql);
					while ($datarows = $stmt->fetch()) {
					 	$Id = $datarows["id"];
					 	$Title = $datarows["title"];
					 	$DateTime=$datarows["datetime"];
					 	$Image=$datarows["image"];
					  ?>
					 <div class="media">
					 	<img src="uploads/<?php echo htmlentities($Image); ?>" class="d-block img-fluid align-self-start" width="100px" height="100px">
					 	<div class="media-body ml-2">
					 		<a href="FullPost.php?id=<?php echo htmlentities($Id); ?>" target="_blank"><h6><?php echo $Title; ?></h6></a>
					 		<p class="small"><?php echo htmlentities($DateTime); ?></p>
					 		</div>
					 </div>
					 <hr>
					<?php } ?>
				</div>
			</div>
		</div>
		<!---- Side Area End--->
	</div>
</div>


<!---header ends---->

<br>


<!-- FOOTER --->

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
<div style=" height: 10px;background: #27aae1;"></div>

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