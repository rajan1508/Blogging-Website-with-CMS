<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?>
<?php
if(isset($_GET["id"])){
	$searchingParameter = $_GET["id"];
	global $connectingdb;
	$Admin = $_SESSION["AdminName"];
	$sql = "UPDATE comments SET status ='OFF',approvedby='$Admin' WHERE id='$searchingParameter' ";
	$execute = $connectingdb->query($sql);
	if($execute){
		$_SESSION["successMessage"] = "Comment DisApproved succesfully!!";
		redirect_to("comments.php");
	}else{
		$_SESSION["errorMessage"] = "OOPS!! TRY AGAIN!! ";
		redirect_to("comments.php");
	}
}

?>