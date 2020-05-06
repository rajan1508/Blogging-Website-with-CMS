<?php

require 'includes/config.php';
require 'includes/aboutPage.class.php';
require 'includes/vcard.class.php';

$profile = new AboutPage($info);

if(array_key_exists('json',$_GET)){
	$profile->generateJSON();
	exit;
}
else if(array_key_exists('vcard',$_GET)){
	$profile->downloadVcard();
	exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Online info page of <?php echo $profile->fullName()?>. Learn more about me and download a vCard." />

        <title>About Us</title>
        
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
            <style type="text/css">
                /*-------------------------
    Simple reset
--------------------------*/


*{
    margin:0;
    padding:0;
}


/*-------------------------
    General Styles
--------------------------*/


html{
    background-color: #556B2F;
}

body{
    color:#fcfcfc;
    font:14px/1.3 'Segoe UI Light',Arial, sans-serif;
    min-height: 800px;
    padding-top:10px;
    background:url('../img/bg_center.jpg') center center no-repeat;
}

section{
    display:block;
    position: relative;
  bottom:100px;
}



/*----------------------------
        Headers
-----------------------------*/


header{
    display: block;
    margin-bottom: 12px;
}

h1{
    font-size:64px;
    font-weight:normal;
    margin-bottom: 12px;    
    line-height:1;
    text-shadow:2px 2px 0 rgba(22,22,22,0.5);
}

h2{
    color: #990000;
    font-size: 18px;
    font-weight: bold;
    text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1);
    padding: 15px 0;
}


/*----------------------------
        Content Area
-----------------------------*/


#infoPage img{
    float:left;
    margin-left:-200px;
    
    -moz-box-shadow: 2px 2px 0 #303030;
    -webkit-box-shadow: 2px 2px 0 #303030;  
    box-shadow: 2px 2px 0 #303030;
}

#infoPage{
    width:500px;
    margin:200px auto 0;
    padding: 0 0 100px 200px;
    border-bottom:1px solid #333;
}

a.grayButton{
    padding:6px 12px 6px 30px;
    position:relative;

    background-color:#fcfcfc;
    background:-moz-linear-gradient(left top -90deg, #fff, #ccc);
    background:-webkit-linear-gradient(left top -90deg, #fff, #ccc);
    background:linear-gradient(left top -90deg, #fff, #ccc);
    
    -moz-box-shadow: 1px 1px 1px #333;
    -webkit-box-shadow: 1px 1px 1px #333;
    box-shadow: 1px 1px 1px #333;
    
    -moz-border-radius:18px;
    -webkit-border-radius:18px;
    border-radius:18px;
    
    font-size:11px;
    color:#444;
    text-shadow:1px 1px 0 #fff;
    display:inline-block;
    margin-right:10px;
    
    -moz-transition:0.25s;
    -webkit-transition:0.25s;
    transition:0.25s;
}

a.grayButton:hover{
    text-decoration:none !important;
    box-shadow:0 0 5px #2b99ff;
}

a.grayButton:before{
    background:url('../img/icons.png') no-repeat;
    height: 18px;
    left: 4px;
    position: absolute;
    top: 6px;
    width: 20px;
    content: '';
}

a.grayButton.twitter:before{
    background-position:0 -20px;
}
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

		<section id="infoPage" style="background-color:  #99ffff;color: black;">
	
    		<img src="images/profile.jpg" alt="Rajan Pandey" width="180" height="200" />

            <header>
                <h1 style="color: #e600e6; font-weight: bold;">Rajan Pandey</h1>
                <h2>Freelancer<br>FullStack Web Developer</h2>
            </header>
            
            <p style="font-size: 1.5em;">I am a <span style="color: red; font-weight: bold;">FullStack Web  Developer</span> and <span style="color: #ff0000; font-weight: bold;">Freelancer</span> living in New Delhi,India.<br> I enjoy designing and coding web applications, Cricket, surfing and music.<br>

Follow me on Facebook.</p>
   
		</section>

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
          
    </body>
</html>
