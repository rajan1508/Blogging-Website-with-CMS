<?php require_once('includes/DB.php'); ?>
<?php 

function redirect_to($newlocation){
header("Location:".$newlocation);
exit();
}
function checkUserNameExist($Username){
   global $connectingdb;
   $sql = "SELECT username FROM admins WHERE username = :userName";
   $stmt = $connectingdb->prepare($sql);
   $stmt->bindValue(':userName',$Username);
   $stmt->execute();
   $Result = $stmt->rowcount();
   if($Result==1){
   	return true;
   }
   else{
   	return false;
   }
}
function login_attempt($Username,$Password){
   global $connectingdb;
   $sql = "SELECT * FROM admins WHERE username=:userName AND password=:passWord LIMIT 1";
   $stmt = $connectingdb->prepare($sql);
   $stmt->bindValue(':userName',$Username);
   $stmt->bindValue(':passWord',$Password);
   $stmt->execute();
   $result = $stmt->rowcount();
   if($result==1){
     return $found_account = $stmt->fetch();
   }else{
      return null;
   }
}
function confirm_login(){
   if($_SESSION["UserName"]){
      return true;
   }else{
      $_SESSION["errorMessage"]="Login required!!";
      redirect_to("login.php"); 
   }
}

function totalPosts(){
   global $connectingdb;
   $sql = "SELECT count(*) FROM posts";
   $stmt = $connectingdb->query($sql);
   $totalrows = $stmt->fetch();
   $totalPosts = array_shift($totalrows);
   echo "$totalPosts";
}
function totalAdmins(){
   global $connectingdb;
   $sql = "SELECT count(*) FROM admins";
   $stmt = $connectingdb->query($sql);
   $totalrows = $stmt->fetch();
   $totaladmins = array_shift($totalrows);
   echo "$totaladmins";
}
function totalCategories(){
   global $connectingdb;
   $sql = "SELECT count(*) FROM category";
   $stmt = $connectingdb->query($sql);
   $totalrows = $stmt->fetch();
   $totalcategories = array_shift($totalrows);
   echo "$totalcategories";
}
function totalComments(){
  global $connectingdb;
  $sql = "SELECT count(*) FROM comments";
  $stmt = $connectingdb->query($sql);
  $totalrows = $stmt->fetch();
  $totalcomments = array_shift($totalrows);
  echo "$totalcomments";
}
?>