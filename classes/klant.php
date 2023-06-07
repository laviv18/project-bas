<?php

include_once 'classes/Database.php';

class Klant extends Database{
	public $KlantId;
	public $Klantnaam;
	public $klantemail;
	public $klantadres;
	public $klantpostcode;
	public $klantwoonplaats;


	
	// Methods
	
	public function setObject($klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats){
		//self::$conn = $db;
		
		$this->klantnaam = $klantnaam;
		$this->klantemail = $klantemail;
		$this->klantadres = $klantadres;
		$this->klantpostcode = $klantpostcode;
		$this->klantwoonplaats = $klantwoonplaats;
	}

		
	/**
	 * Summary of getKlant
	 * @return mixed
	 */
	public function getKlant(){
		// query: is een prepare en execute in 1 zonder placeholders
		$lijst = self::$conn->query("select * from 	klanten")->fetchAll();
		return $lijst;
	}

	// Get klant
	public function getKlanten($klantnaam){

		$sql = "select * from acteurs where klantnaam = '$klantnaam'";
		$query = self::$conn->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
	
	public function dropDownKlant($row_selected = -1){
	
		// Haal alle klanten op uit de database mbv de method getKlanten()
		$lijst = $this->getKlanten();
		
		echo "<label for='klanten'>Choose a klant:</label>";
		echo "<select name='klantnr'>";
		foreach ($lijst as $row){
			if($row_selected == $row["klantnaam"]){
				echo "<option value='$row[klantnaam]' selected='selected'> $row[klantemail] $row[klantadres]</option>\n";
			} else {
				echo "<option value='$row[klantnaam]'> $row[VOORNAAM] $row[ACHTERNAAM]</option>\n";
			}
		}
		echo "</select>";
	}

 /**
  * Summary of showTable
  * @param mixed $lijst
  * @return void
  */
	public function showTable($lijst){

		$txt = "<table border=1px>";
		foreach($lijst as $row){
			$txt .= "<tr>";
			$txt .=  "<td>" . $row["NR"] . "</td>";
			$txt .=  "<td>" . $row["VOORNAAM"] . "</td>";
			$txt .=  "<td>" . $row["ACHTERNAAM"] . "</td>";
			
			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='update_acteur.php?nr=$row[NR]' >       
                <button name='update'>Wzg</button>	 
            </form> </td>";


			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='delete.php?nr=$row[NR]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	// Delete acteur
 /**
  * Summary of deleteActeur
  * @param mixed $nr
  * @return bool
  */
	public function deleteActeur($nr){

		$sql = "delete from acteurs where NR = '$nr'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
      return ($stmt->rowCount() == 1) ? true : false;
	}

	public function updateActeur2($nr, $naam, $achternaam){

		$sql = "update acteurs 
			set VOORNAAM = '$naam', ACHTERNAAM = '$achternaam' 
			WHERE NR = '$nr'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;				
	}
	
	public function updateActeurSanitized($nr, $voornaam, $achternaam){

		$sql = "update acteurs 
			set VOORNAAM = :voornaam, ACHTERNAAM = :achternaam 
			WHERE NR = :nr";
			
		// PDO sanitize automatisch in de prepare
		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'voornaam' => $voornaam,
			'achternaam'=> $achternaam,
			'nr'=> $nr
		]);  
	}
	public function updateActeur(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		$sql = "update acteurs 
			set VOORNAAM = :voornaam, ACHTERNAAM = :achternaam 
			WHERE NR = :nr";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute((array)$this);
		return ($stmt->rowCount() == 1) ? true : false;		
	}
	
	/**
	 * Summary of BepMaxNr
	 * @return int
	 */
	private function BepMaxNr() : int {
		
	// Bepaal uniek nummer
	$sql="SELECT MAX(klantid)+1 FROM  klanten";
	return  (int) self::$conn->query($sql)->fetchColumn();
}
	
	public function insertKlant(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		
		//
		$this->KlantId = $this->getKlanten();
		
		$sql = "INSERT INTO klanten (KlantId,KlantNaam, KlantEmail, KlantAdres, KlantPostcode, KlantWoonplaats )
		VALUES (:KlantId, :Klantnaam, :KlantEmail, :KlantAdres :KlantPostcode, :KlantWoonplaats)";

		$stmt = self::$conn->prepare($sql);
		return $stmt->execute((array)$this);
			
	}
	
	/**
	 * Summary of insertActeur2
	 * @param mixed $voornaam
	 * @param mixed $achternaam
	 * @return void
	 */
	public function insertKlant2($KlantNaam, $KlantEmail, $KlantAdres, $KlantPostcode, $KlantWoonplaats){
		
		// query
		$this->KlantId = $this->BepMaxNr();
		$sql = "INSERT INTO klanten (klantid,klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats )
		VALUES (:KlantId, :KlantNaam, :KlantEmail, :KlantAdres, :KlantPostcode, :KlantWoonplaats)";
		
		
		// Prepare
		$stmt = self::$conn->prepare($sql);
		
		// Execute
		$stmt->execute([
			'KlantId'=>$this->KlantId,
			'KlantNaam'=>$KlantNaam,
			'KlantEmail'=>$KlantEmail,
			'KlantAdres'=>$KlantAdres,
			'KlantPostcode'=>$KlantPostcode,
			'KlantWoonplaats'=>$KlantWoonplaats
		]);			
	}
} 
?>