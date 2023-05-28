<?php

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
		
	include_once 'classes/database.php';
		
		$klant = new Klant;
		//$acteur->setObject(0, $_POST['voornaam'], $_POST['achternaam']);
		//$acteur->insertActeur();
		$Klant->insertKlant($_POST['KlantNaam'], $_POST['KlantEmail'], $_POST['KlantAdres'], $_POST['KlantPostcode'], $_POST['KlantWoonplaats']);
			
		echo "<script>alert('Klant: $_POST[KlantNaam] $_POST[KlantEmail] $_POST[KlantAdres] $_POST[KlantPostcode] $_POST[KlantWoonplaats] is toegevoegd')</script>";
		echo "<script> location.replace('index.php'); </script>";
			
	} 

?>

<!DOCTYPE html>
<html>
<body>

	<h1>CRUD Klant</h1>
	<h2>Klant Toevoegen</h2>
	<form method="post">
	<label for="nv">KlantNaam:</label>
   <input type="text" id="nv" name="KlantNaam" placeholder="KlantNaam" required/>
   <br>   
   <label for="an">KlantEmail:</label>
   <input type="text" id="an" name="KlantEmail" placeholder="KlantEmail" required/>
   <br>
   <label for="ad">KlantAdres:</label>
   <input type="text" id="ad" name="KlantAdres" placeholder="KlantAdres" required/>
   <br>
   <label for="kp">KlantPostcode:</label>
   <input type="text" id="kp" name="KlantPostcode" placeholder="KlantPostcode" required/>
   <br>
   <label for="kw">KlantWoonplaats:</label>
   <input type="text" id="kw" name="KlantWoonplaats" placeholder="KlantWoonplaats" required/>
   <br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='index.php'>Terug</a>

</body>
</html>