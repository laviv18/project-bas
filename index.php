<!DOCTYPE html>
<html>
<head>
    <title>PHP Index</title>
    <style>
        body {
            background-color: #CAFAFE; 
        }
    </style>
</head>
<body>
    <h1>Hallo, Welkom bij Bas supermarkt</h1>
    <p>Hier onder vind u een menu uit keuze</p>

    

    <?php 

echo "<a href='insertKlant.php'>Voeg nieuwe klant toe</a></br>";
echo "<a href='selectKlant.php'>Laat alle klanten zien</a></br>";
echo "<a href='insertVerkoop.php'>Voeg nieuwe verkooporders toe</a></br>";
echo "<a href='selectVerkoop.php'>Laat alle verkooporders zien</a></br>";
echo "<a href='insertInkoop.php'>Voeg nieuwe inkooporders toe</a></br>";
echo "<a href='selectArtikel.php'>Laat alle artikelen zien</a></br>";
echo "<a href='deleteInkoop.php'>Verwijder InkoopOrders</a></br>";
echo "<a href='deleteLeverancier.php'>Verwijder Leveranciers</a></br>";
echo "<a href='searchKlant.php'>Klant zoeken op ID</a></br>";
echo "<a href='updateStatus.php'>Update de verkooporder status</a></br>";

?>
    
    

</body>
</html>














