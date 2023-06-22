<?php

if(isset($_POST["verwijderen"])){
	include 'classes/Klant.php';
	
	$klant = new Klant;
	
	$klant->deleteKlant($_GET["klantId"]);
	echo '<script>alert("Klant verwijderd")</script>';
	echo "<script> location.replace('index.php'); </script>";
}
?>