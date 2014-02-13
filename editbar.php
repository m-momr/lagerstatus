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
if ($_POST['nybar']){
	//query for om navnet eksisterer
	$var_barnavn=$_POST['barnavn'];
	$query="SELECT navn FROM barer WHERE navn=\"$var_barnavn\" LIMIT 1";
	$res1=mysqli_query($con, $query);
	
	if($row = $res1->fetch_row()){ //$row[0] $row[1] skaper row-arrawy med linjer over resultat
		echo "Baren eksisterer allerede";
		}

	else{	
	        // IKKE ' ' rundt tabellnavn, " " rundt verdi-variabel
	        $var_barnavn=$_POST['barnavn'];
	        $var_lokasjon=$_POST['lokasjon'];
	        $var_frivillige=$_POST['frivillige'];
	        $var_ansvarlig=$_POST['ansvarlig'];
	        $var_bilde=$_POST['bilde'];

		$query="INSERT INTO barer (navn, lokasjon, frivillige, ansvarlig, bilde) 
		VALUES (\"$var_barnavn\",\"$var_lokasjon\",\"$var_frivillige\",\"$var_ansvarlig\",\"$var_bilde\")";
	
	        mysqli_query($con, $query);
		echo "$var1 har blitt lagt til";
		}
}


if ($_POST['slettbar']){
	if($_POST['heltsikker'] === 'sikker'){
		$var1=$_POST['barnavn'];
		mysqli_query($con,"DELETE FROM barer WHERE bid=\"$var1\"");
		echo "BAR: " . $var1 . "SLETTET";
	}

}
// Redigere bar
if ($_POST['redigerbar']){
	$var1=$_POST['barnavn'];
	echo "Fors�ker åredigere Bar: " . $var1;
	$res1=mysqli_query($con,"SELECT * FROM barer WHERE bid=\"$var1\"");
	if($row = mysqli_fetch_array($res1) ){
		echo "Baren eksisterer";
		echo "DEBUG : ID: " . $row['bid'] . "Navn: " . $row['navn'];
		echo "<h3>Redigere</h3>
		<form method=\"post\">
		<input type=\"hidden\" name=\"oppdatertinfo\" value=\"1\">
		<input type=\"hidden\" name=\"bid\" value={$row['bid']}>
		Navn: <input type=\"text\" value={$row['navn']} name=\"barnavn\">
		Lokasjon: <input type=\"text\" value={$row['lokasjon']} name=\"lokasjon\">
		Frivillige: <input type=\"text\" value={$row['frivillige']} name=\"frivillige\">
		Ansvarlig: <input type=\"text\" value={$row['ansvarlig']} name=\"ansvarlig\">
		Bilde: <input type=\"text\" value={$row['bilde']} name=\"bilde\">

		<input type=\"submit\" name= testa2 value=\"Lagre endring\">
		</form>";		

		
		}
	else{
		echo "Baren esksisterer IKKE ! !";
		}

}
//HENGER SAMMEN MED redigerevar POST INFO
if ($_POST['oppdatertinfo']){
	
	$var_bid=$_POST['bid'];

        $var_barnavn=$_POST['barnavn'];
        $var_lokasjon=$_POST['lokasjon'];
        $var_frivillige=$_POST['frivillige'];
        $var_ansvarlig=$_POST['ansvarlig'];
        $var_bilde=$_POST['bilde'];

	mysqli_query($con,"UPDATE barer SET navn=\"$var_barnavn\", lokasjon=\"$var_lokasjon\",
	frivillige=\"$var_frivillige\", ansvarlig=\"$var_ansvarlig\", bilde=\"$var_bilde\"  WHERE bid=\"$var_bid\"");
	


}


//////////////////////// POST WORK ///////////////////////


// oversikt over eksisterende barer
$resultatbarer = mysqli_query($con,"SELECT * FROM barer");

echo "<a href "."><h2>Barer</h2></a>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Barnavn</th>
<th>Lokasjon</th>
<th>Ant. Frivillige</th>
<th>Ansvarlig</th>
<th>Bilde</th>
</tr>";

while($row = mysqli_fetch_array($resultatbarer))
  {
  echo "<tr>";
  echo "<td>" . $row['bid'] . "</td>";
  echo "<td>" . $row['navn'] . "</td>";
  echo "<td>" . $row['lokasjon'] . "</td>";
  echo "<td>" . $row['frivillige'] . "</td>";
  echo "<td>" . $row['ansvarlig'] . "</td>";
  echo "<td>" . $row['bilde'] . "</td>";

  echo "</tr>";
  }
echo "</table>";

// Form for å legge til barer
echo "<h2>Legg til bar</h2>";
echo"
<form method=\"post\">
<input type=\"hidden\" name=\"nybar\" value=\"1\"> 
Navn: <input type=\"text\" name=\"barnavn\">
Lokasjon: <input type=\"text\" name=\"lokasjon\">
Frivillige: <input type=\"text\" name=\"frivillige\">
Ansvarlig: <input type=\"text\" name=\"ansvarlig\">
Bilde: <input type=\"text\" name=\"bilde\">
<input type=\"submit\" value=\"Legg til\">
</form>";

// Form for � �slette barer
echo "<h2>Slette bar</h2>";
echo"
<form method=\"post\">
<input type=\"hidden\" name=\"slettbar\" value=\"1\"> 
ID: <input type=\"text\" name=\"barnavn\">
Er du helt sikker?<input type=\"checkbox\" name=\"heltsikker\" value=\"sikker\">
<input type=\"submit\" value=\"SLETT BAR\">
</form>";

// Form for å redigere barer
echo "<h2>Redigere bar</h2>";
echo"
<form method=\"post\">
<input type=\"hidden\" name=\"redigerbar\" value=\"1\"> 
ID: <input type=\"text\" name=\"barnavn\">
<input type=\"submit\" value=\"Rediger\">
</form>";


?>




