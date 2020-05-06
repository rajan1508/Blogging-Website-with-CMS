<?php require_once('includes/Functions.php'); ?>
<?php require_once('includes/DB.php'); ?>
<?php require_once('includes/sessions.php'); ?>
<?php
if(isset($_GET["id"])){
	$searchingParameter = $_GET["id"];
	global $connectingdb;
	$sql = "DELETE FROM admins WHERE id='$searchingParameter' ";
	$execute = $connectingdb->query($sql);
	if($execute){
		$_SESSION["successMessage"] = "Admin Deleted succesfully!!";
		redirect_to("admins.php");
	}else{
		$_SESSION["errorMessage"] = "OOPS!! TRY AGAIN!! ";
		redirect_to("admins.php");
	}
}

?>