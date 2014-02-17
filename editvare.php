<?php
$con=mysqli_connect("localhost","root","donald2k","lagerstatus");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//////////////////////// POST WORK //////////////////////
// Dersom hidden "nybar"  eksisterer i POST (
// hidden name må også ha en verdi for å bli catchet $_POST
if ($_POST['nyvare']){
	//query for om navnet eksisterer
	$var_barnavn=$_POST['varenavn'];
	$query="SELECT navn FROM varer WHERE navn=\"$var_barnavn\" LIMIT 1";
	$res1=mysqli_query($con, $query);
	
	if($row = $res1->fetch_row()){ //$row[0] $row[1] skaper row-arrawy med linjer over resultat
		echo "Varen eksisterer allerede";
		}

	else{	
	        // IKKE ' ' rundt tabellnavn, " " rundt verdi-variabel
	        $var_barnavn=$_POST['varenavn'];
	        $var_lokasjon=$_POST['alkoholprosent'];
	        $var_frivillige=$_POST['literperenhet'];
	        $var_ansvarlig=$_POST['enhetperkasse'];
	        $var_bilde=$_POST['bilde'];

		$query="INSERT INTO varer (navn, alkoholprosent, literperenhet, enhetperkasse, bilde) 
		VALUES (\"$var_barnavn\",\"$var_lokasjon\",\"$var_frivillige\",\"$var_ansvarlig\",\"$var_bilde\")";
	
	        mysqli_query($con, $query);
		echo "$var1 har blitt lagt til";
		}
}


if ($_POST['slettbar']){
	if($_POST['heltsikker'] === 'sikker'){
		$var1=$_POST['varenavn'];
		mysqli_query($con,"DELETE FROM varer WHERE vid=\"$var1\"");
		echo "VARE: " . $var1 . "SLETTET";
	}

}
// Redigere bar
if ($_POST['redigerbar']){
	$var1=$_POST['barnavn'];
	echo "Fors�ker åredigere Bar: " . $var1;
	$res1=mysqli_query($con,"SELECT * FROM varer WHERE vid=\"$var1\"");
	if($row = mysqli_fetch_array($res1) ){
		echo "Baren eksisterer";
		echo "DEBUG : ID: " . $row['vid'] . "Navn: " . $row['navn'];
		echo "<h3>Redigere</h3>
		<form method=\"post\">
		<input type=\"hidden\" name=\"oppdatertinfo\" value=\"1\">
		<input type=\"hidden\" name=\"vid\" value={$row['vid']}>
		Navn: <input type=\"text\" value={$row['navn']} name=\"varenavn\"><br>
		Alkoholprosent: <input type=\"text\" value={$row['alkoholprosent']} name=\"alkoholprosent\"><br>
		Liter pr. enhet: <input type=\"text\" value={$row['literperenhet']} name=\"literperenhet\"><br>
		Enhet pr. kasse: <input type=\"text\" value={$row['enhetperkasse']} name=\"enhetperkasse\"><br>
		Bilde: <input type=\"text\" value={$row['bilde']} name=\"bilde\"><br>

		<input type=\"submit\" value=\"Lagre endring\">
		</form>";		

		
		}
	else{
		echo "Varen esksisterer IKKE ! !";
		}

}
//HENGER SAMMEN MED redigerevar POST INFO
if ($_POST['oppdatertinfo']){
	
	$var_bid=$_POST['vid'];

        $var_barnavn=$_POST['varenavn'];
        $var_lokasjon=$_POST['alkoholprosent'];
        $var_frivillige=$_POST['literperenhet'];
        $var_ansvarlig=$_POST['enhetperkasse'];
        $var_bilde=$_POST['bilde'];

	mysqli_query($con,"UPDATE varer SET navn=\"$var_barnavn\", alkoholprosent=\"$var_lokasjon\",
	literperenhet=\"$var_frivillige\", enhetperkasse=\"$var_ansvarlig\", bilde=\"$var_bilde\"  WHERE vid=\"$var_bid\"");
	


}


//////////////////////// POST WORK ///////////////////////


// oversikt over eksisterende barer
$resultatbarer = mysqli_query($con,"SELECT * FROM varer");

echo "<a href "."><h2>Varer</h2></a>";
echo "<table border='1'>
<tr>
<th>VID</th>
<th>Varenavn</th>
<th>Alkoholprosent</th>
<th>Liter pr. enhet</th>
<th>Enheter pr. kasse</th>
<th>Bilde</th>
</tr>";

while($row = mysqli_fetch_array($resultatbarer))
  {
  echo "<tr>";
  echo "<td>" . $row['vid'] . "</td>";
  echo "<td>" . $row['navn'] . "</td>";
  echo "<td>" . $row['alkoholprosent'] . "</td>";
  echo "<td>" . $row['literperenhet'] . "</td>";
  echo "<td>" . $row['enhetperkasse'] . "</td>";
  echo "<td>" . $row['bilde'] . "</td>";

  echo "</tr>";
  }
echo "</table>";



// Form for å legge til barer
echo "<h2>Legg til vare</h2>";
echo"
<form method=\"post\">
<input type=\"hidden\" name=\"nyvare\" value=\"1\"> 
Navn: <input type=\"text\" value=\"varenavn\" name=\"varenavn\"><br>
Alkoholprosent <input type=\"text\"  value=\"0\" name=\"alkoholprosent\"><br>
Liter pr. enhet <input type=\"text\"  value=\"0\" name=\"literperenhet\"><br>
Enheter pr. kasse <input type=\"text\"  value=\"0\" name=\"enhetperkasse\"><br>
Bilde: <input type=\"text\"  value=\"0\" name=\"bilde\"><br>
<input type=\"submit\" value=\"Legg til\">
</form>";

// Form for � �slette barer
echo "<h2>Slette vare</h2>";
echo"
<form method=\"post\">
<input type=\"hidden\" name=\"slettbar\" value=\"1\"> 
ID: <input type=\"text\" name=\"varenavn\">
Er du helt sikker?<input type=\"checkbox\" name=\"heltsikker\" value=\"sikker\">
<input type=\"submit\" value=\"SLETT BAR\">
</form>";

// Form for å redigere barer
echo "<h2>Redigere vare</h2>";
echo"
<form method=\"post\">
<input type=\"hidden\" name=\"redigerbar\" value=\"1\"> 
ID: <input type=\"text\" name=\"barnavn\">
<input type=\"submit\" value=\"Rediger\">
</form>";


?>




