<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?>
<?php
if(isset($_GET["id"])){
	$searchingParameter = $_GET["id"];
	global $connectingdb;
	$sql = "DELETE FROM comments WHERE id='$searchingParameter' ";
	$execute = $connectingdb->query($sql);
	if($execute){
		$_SESSION["successMessage"] = "Comment Deleted succesfully!!";
		redirect_to("comments.php");
	}else{
		$_SESSION["errorMessage"] = "OOPS!! TRY AGAIN!! ";
		redirect_to("comments.php");
	}
}

?>