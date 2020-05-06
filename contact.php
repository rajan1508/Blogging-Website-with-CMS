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
	<style type="text/css">
		
		html, body{
	font-size: 100%;
	font-family: 'Slabo 27px', serif;
	background:#ffffff;
	margin: 0;
}
h1,h2,h3,h4,h5,h6{
	font-family: 'Slabo 27px', serif;
	margin:0;
	letter-spacing:1px;
}
ul,label{
	margin:0;
	padding:0;
}
body a:hover{
	text-decoration:none;
}

.banner1{
	background:#003e57;
    min-height: 220px;
}

.wthree_banner1_info {
    padding: 90px;
    text-align: center;
}
.wthree_banner1_info h3{
font-size: 2.5em;
    color: #fff;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 5px;
}

.sub_para_agile{text-align: center; padding-top: 22px; font-style: italic; font-size: 20px;}

.wthree_banner1_info h3 span{
	color:#47cf73;
}
.team{
    padding: 5em 0;
	background:#f0f0f0;
}

.phpkidal_header {
    font-size: 2.5em;
    color: #262c38;
    letter-spacing: 1px;
    text-transform: uppercase;
    position: relative;
    font-weight:700;
    text-align: center;
}
h3.phpkidal_header.phpkida_agileits_header.two {
    color: #fff;
}
.phpkidal_header:after {
    border-top: 2px solid #47cf73;
    display: block;
    width: 81px;
    content: "";
    margin: 8px auto 0;
}
.agile_team_grids_top {
    margin-top: 3em;
}

.input {
	position: relative;
    z-index: 1;
    display: inline-block;
    margin:1em 0 0;
    width: 100%;
    vertical-align: top;
}

.input__field {
	position: relative;
    display: block;
    float: right;
    border: none;
    border-radius: 0;
    -webkit-appearance: none;
}

.input__field:focus {
	outline: none;
}

.input__label {
	display: inline-block;
    float: right;
    font-size:16px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.input__label-content {
	position: relative;
	display: block;
	padding: 1.6em 0;
	width: 100%;
}
/*/*/*/* Nariko */
.input--nariko {
	overflow: hidden;
	padding-top: 2em;
}

.input__field--nariko {
	width: 100%;
    background: transparent;
    opacity: 0;
    padding: 0.7em;
    z-index: 100;
    color: #212121;
    font-size:16px;
}

.input__label--nariko {
	width: 100%;
    bottom: 0;
    position: absolute;
    pointer-events: none;
    text-align: left;
    color: #666;
    padding: 0 0.5em;
    font-weight: 600;
}

.input__label--nariko::before {
	content: '';
	position: absolute;
	width: 100%;
	height: 3.5em;
	top: 100%;
	left: 0;
	background: #e3e3e3;
    border-top: 2px solid #e3e3e3;
	-webkit-transform: translate3d(0, -3px, 0);
	transform: translate3d(0, -3px, 0);
	-webkit-transition: -webkit-transform 0.4s;
	transition: transform 0.4s;
	-webkit-transition-timing-function: cubic-bezier(0.7, 0, 0.3, 1);
	transition-timing-function: cubic-bezier(0.7, 0, 0.3, 1);
}

.input__label-content--nariko {
	padding: 0.5em 0;
	-webkit-transform-origin: 0% 100%;
	transform-origin: 0% 100%;
	-webkit-transition: -webkit-transform 0.4s, color 0.4s;
	transition: transform 0.4s, color 0.4s;
	-webkit-transition-timing-function: cubic-bezier(0.7, 0, 0.3, 1);
	transition-timing-function: cubic-bezier(0.7, 0, 0.3, 1);
}

.input__field--nariko:focus,
.input--filled .input__field--nariko {
	cursor: text;
	opacity: 1;
	-webkit-transition: opacity 0s 0.4s;
	transition: opacity 0s 0.4s;
} 

.input__field--nariko:focus + .input__label--nariko::before,
.input--filled .input__label--nariko::before {
	-webkit-transition-delay: 0.05s;
	transition-delay: 0.05s;
	-webkit-transform: translate3d(0, -3.3em, 0);
	transform: translate3d(0, -3.3em, 0);
}

.input__field--nariko:focus + .input__label--nariko .input__label-content--nariko,
.input--filled .input__label-content--nariko {
	color: #6B6E6E;
	-webkit-transform: translate3d(0, -3.3em, 0) scale3d(0.81, 0.81, 1);
	transform: translate3d(0, -3.3em, 0) scale3d(0.81, 0.81, 1);
}
.agileinfo_mail_grid_left textarea{
font-size: 16px;
    color: #212121;
    outline: none;
    width: 100%;
    min-height: 174px;
    resize: none;
    margin: 3em 0;
    background: none;
    border: none;
    border-bottom: 3px solid #e3e3e3;
    padding: 1em .3em;
    font-weight: 600;
	font-family: 'Slabo 27px', serif;
}
.agileinfo_mail_grid_left textarea::-webkit-input-placeholder{
	color:#666!important;
}
.agileinfo_mail_grid_left input[type="submit"]{
	font-size:1.1em;
	color:#fff;
	outline:none;
	width:100%;
	background: #09347a;
	border:none;
	padding:.7em 0;
	text-transform:uppercase;
	font-weight:600;
	letter-spacing:1px;
}
.agileinfo_mail_grid_left input[type="submit"]:hover{
	background:#47cf73;
}
.agileinfo_mail_social_rightl,.agileinfo_mail_social_rightr{
	width: 48.52%;
	text-align:center;
}
.agileinfo_mail_social_rightl a,.agileinfo_mail_social_rightr a,.agileinfo_mail_social_right_social a{
	padding:3.5em;
	display:block;
	text-decoration:none;
}
.agileinfo_mail_social_rightl{
	float:left;
}
.agileinfo_mail_social_rightr{
	position: relative;
	bottom: 208px;
	float:right;
	margin-left:1em;
}
.phpkida_contact_facebook{
	background:#3b5998;
}
.phpkida_contact_facebook:hover{
	background:#4e72bd;
}
.phpkida_contact_twitter{
	background:#1da1f2;
}
.phpkida_contact_twitter:hover{
	background:#51b8f7;
}
.phpkida_contact_google{
	background:#dd4b39;
}
.phpkida_contact_google:hover{
	background:#f95945;
}
.phpkida_contact_instagram{
	background:#833ab4;
}
.phpkida_contact_instagram:hover{
	background:#a850e2;
}
.phpkida_contact_rss{
	background:#f26522;
}
.phpkida_contact_rss:hover{
	background:#ec763e;
}
.agileinfo_mail_social_rightl i,.agileinfo_mail_social_rightr i,.agileinfo_mail_social_right_social i{
	color:#fff;
	font-size:3em;
}
.agileinfo_mail_social_rightl p,.agileinfo_mail_social_rightr p,.agileinfo_mail_social_right_social p{
	color:#fff;
	font-size:1em;
	margin-top:.5em;
}
.agileinfo_mail_social_right:nth-child(2) {
    margin: 1em 0;
}
.agileinfo_mail_social_right_social{
	text-align:center;
}
}*


	</style>

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
				<a href="blog.php" class="nav-link">Blog</a>
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
		<div class="col-lg-8">
			
				<!-- //banner -->	
    <div class="banner1">
	    <div class="wthree_banner1_info">
				<h3><span>Contact Us</h3>
		</div>
    </div>
<!-- //banner -->	
<!-- mail -->
	<div class="team">
		<div class="container">
		<h3 class="phpkidal_header phpkida_agileits_header">Leave Mail Us</h3>
		            <p class="sub_para_agile">We will back to soon!</p>
			<div class="agile_team_grids_top">
				<div class="col-md-6 agileinfo_mail_grid_left">
					<form action="#" method="post">
						<span class="input input--nariko">
							<input class="input__field input__field--nariko" name="Name" type="text" id="input-20" placeholder=" " required="" />
							<label class="input__label input__label--nariko" for="input-20">
								<span class="input__label-content input__label-content--nariko">Your Name</span>
							</label>
						</span>
						<span class="input input--nariko">
							<input class="input__field input__field--nariko" name="Email" type="email" id="input-21" placeholder=" " required="" />
							<label class="input__label input__label--nariko" for="input-21">
								<span class="input__label-content input__label-content--nariko">Your Email</span>
							</label>
						</span>
						<span class="input input--nariko">
							<input class="input__field input__field--nariko" name="Subject" type="text" id="input-22" placeholder=" " required="" />
							<label class="input__label input__label--nariko" for="input-22">
								<span class="input__label-content input__label-content--nariko">Your Subject</span>
							</label>
						</span>
						<textarea name="Message" placeholder="Your Message..." required=""></textarea>
						<input type="submit" value="Send">
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>

<!-- mail end -->


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