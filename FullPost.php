<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?> 
<?php 
$searchingParameter = $_GET["id"]??"4" ; 
?>
<?php  
if(isset($_POST["Submit"])){
	$Name = $_POST["commenterName"]; 
	$Email = $_POST["commenterEmail"];
	$Comment = $_POST["commenterThoughts"];

	date_default_timezone_set("Asia/Kolkata");
	$currentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S",$currentTime);

	if(empty($Name)||empty($Email)||empty($Comment)){
		$_SESSION["errorMessage"] = "this field can't be empty";
		redirect_to("FullPost.php?id = {$searchingParameter}");
	}
	elseif (strlen($Comment)>500) {
		$_SESSION["errorMessage"] = "Comment length should be smaller than 500 characters";
		redirect_to("FullPost.php?id = {$searchingParameter}");
	}
	else{
		 //query to insert comment

		   $sql = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
		   $sql.= "VALUES(:dateTime,:Name,:Email,:Comment,'pending','OFF',:PostIdFromURL)";
		   $stmt = $connectingdb->prepare($sql);
		   $stmt->bindValue(':dateTime',$DateTime);
		   $stmt->bindValue(':Name',$Name);
		   $stmt->bindValue(':Email',$Email);
		   $stmt->bindValue(':Comment',$Comment);
		   $stmt->bindValue('PostIdFromURL',$searchingParameter);
		   $Execute = $stmt->execute();
           
       
            if($Execute){
            	$_SESSION["successMessage"] = " commented successfully.";
            	redirect_to("FullPost.php?id=$searchingParameter ");
            }
            else{
            	$_SESSION["errorMessage"] = "insertion unsuccessful.Try again!!";
            	redirect_to("FullPost.php?id=$searchingParameter ");
            }



	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Blog Page
	</title>

	<link rel="stylesheet" href="https:stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style1.css">
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
             }else{
               $PostIdFromURL = $_GET["id"]??"4";
               if(!isset($PostIdFromURL)){
               	$_SESSION["errorMessage"] = "Bad Request !!";
               	redirect_to("Blog.php");
               }
               $sql = "SELECT * FROM posts WHERE id = '$PostIdFromURL'";
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
             		<small class="text-muted">Category: <span class="text-dark"><?php echo htmlentities($Category); ?> </span>
                    written by: <span class="text-dark"><?php echo htmlentities($Admin); ?></span> On 
                    <span class="text-dark"><?php echo htmlentities($DateTime); ?></span>
                    </small> 
             		
             		<hr>
             		<p><?php echo nl2br($PostText); ?></p>             		
             	</div>
             </div>
         <?php } ?>
         <!--- comment area starts --->

        <!--- fetching comments --->
        <span class="fieldinfo">Comments</span>
        <br><br>
         <?php
         global $connectingdb;
         $sql = "SELECT * FROM comments WHERE post_id='$searchingParameter' AND status='ON' ";
         $stmt = $connectingdb->query($sql);
         while ($datarows = $stmt->fetch()) {
         	$commenterName = $datarows['name'];
         	$commentDate = $datarows['datetime'];
         	$commentContent = $datarows['comment'];
         
          ?>
          <div>
          	
          	<div style="background-color: #F6F7F9;" class="media commentBlock">
          		<div class="media-body ml-2">
          			<h6 class="lead"><?php echo $commenterName; ?></h6>
          			<p class="small"><?php echo $commentDate; ?></p>
          			<p> <?php echo $commentContent; ?> </p>
          		</div>
          	</div>
          </div>
          <hr>
         <?php } ?>
        <!--- fetching comments ends --->
            <div class="">
            <form class="" action="FullPost.php?id=<?php echo $searchingParameter; ?>" method="post">
            		<div class="card mb-3">
            			<div class="card-header">
            				<h5 class="fieldinfo">Share your thoughts about this post</h5>
            			</div>
            			<div class="card-body">
            				<div class="form-group">
            					<div class="input-group">
            						<div class="input-group-prepend">
            							<span class="input-group-text"><i class="fas fa-user"></i></span>
            						</div>
            						<input class="form-control" type="text" name="commenterName" placeholder="Name" value="">
            					</div>
            				</div>

            				<div class="form-group">
            					<div class="input-group">
            						<div class="input-group-prepend">
            							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
            						</div>
            						<input class="form-control" type="email" name="commenterEmail" placeholder="Email" value="">
            					</div>
            				</div>
                             <div class="form-group">
                             	<textarea class="form-control" cols="80" rows="5" name="commenterThoughts"></textarea>
                             </div>
                             <div>
                                <button name="Submit" type="submit" class="btn btn-primary">Submit</button>
                            </div>

            			</div>
            		</div>
            	</form>
            </div>
         <!---- comment area ends --->

            </div>
			<!---- Main Area End----->
		
		<!---- Side Area Start -->
        <div class="col-sm-4 bg-warning" >
            <div class="card mt-2 bg-dark text-white">
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

	<script src="https:use.fontawesome.com/79de14b5ce.js"></script>
<script src="https:code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https:cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https:stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(#year).text(new new Date().getFullYear());
</script>
</body>
</html>