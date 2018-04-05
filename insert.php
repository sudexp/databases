<?php
// Palautetaan takaisin pääsivulle
header("refresh:2;url=index.php");
// Tietokantayhteys
include "connect.php";
// Muuttujat
$enimi = $_POST['enimi'];
$snimi = $_POST['snimi'];
//Kyselyn muodostaminen
$query = "insert into ASIAKAS (etunimi,sukunimi,osoite,puhelinnumero,asiakasnumero) values ('$etunimi','$sukunimi','$osoite','$puhelinnumero','$asiakasnumero')";
mysqli_query($con,$query) or die("henkilön lisääminen kantaan ei onnistunut");
mysqli_close($con);
echo "Henkilö lisätty onnistuneesti tietokantaan!";
?>