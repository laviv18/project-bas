<?php

if(isset($_POST["verwijderen"])){
	include 'classes/Verkoop.php';
	

	$verkoop = new verkoop;
	

	$verkoop->deleteVerkoop($_GET["verkOrdId"]);
	echo '<script>alert("VerkoopOrder verwijderd")</script>';
	echo "<script> location.replace('index.php'); </script>";
}
?>