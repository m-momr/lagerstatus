<?php
$con=mysqli_connect("localhost","root","donald2k","lagerstatus");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//////////////////////// POST WORK //////////////////////
// Dersom barnavn eksisterer i POST
if ($_POST['barnavn']){
	//query for om navnet eksisterer
	$var1=$_POST['barnavn'];
	$query="SELECT navn FROM barer WHERE navn=\"$var1\" LIMIT 1";
	$res1=mysqli_query($con, $query);
	
	if($row = $res1->fetch_row()){ //$row[0] $row[1] skaper row-arrawy med linjer over resultat
		echo "Baren eksisterer allerede";
		}

	else{	
	        // IKKE ' ' rundt tabellnavn, " " rundt verdi-variabel
	        $query="INSERT INTO barer (navn) VALUES (\"$var1\")";
	        mysqli_query($con, $query);
		echo "$var1 har blitt lagt til";
		}
}


if ($_POST['slettebar']){
	if($_POST['heltsikker'] === 'sikker'){
		$var1=$_POST['slettebar'];
		mysqli_query($con,"DELETE FROM barer WHERE bid=\"$var1\"");
		echo "BAR: " . $var1 . "SLETTET";
	}

}

if ($_POST['redigerebar']){
	$var1=$_POST['redigerebar'];
	echo "Fors√ker √•redigere Bar: " . $var1;
	$res1=mysqli_query($con,"SELECT * FROM barer WHERE bid=\"$var1\"");
	if($row = mysqli_fetch_array($res1) ){
		echo "Baren eksisterer";
		echo "ID: " . $row['bid'] . "Navn: " . $row['navn'];
		echo"<h3>Redigere</h3>
		<form method=\"post\">
		<input type=\"hidden\" name=\"bid\" value={$row['bid']}>
		Navn: <input type=\"text\" value={$row['navn']} name=\"nyttnavn\">
		<input type=\"submit\" name= testa2 value=\"Lagre endring\">
		</form>";		

		
		}
	else{
		echo "Baren esksisterer IKKE ! !";
		}

}
//HENGER SAMMEN MED redigerevar POST INFO
if ($_POST['nyttnavn']){
	$var1=$_POST['nyttnavn'];
	$var2=$_POST['bid'];
	echo $var1;
	mysqli_query($con,"UPDATE barer SET navn=\"$var1\" WHERE bid=\"$var2\"");
	


}


//////////////////////// POST WORK ///////////////////////


// oversikt over eksisterende barer
$resultatbarer = mysqli_query($con,"SELECT * FROM barer");

echo "<a href "."><h2>Barer</h2></a>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Barnavn</th>
</tr>";

while($row = mysqli_fetch_array($resultatbarer))
  {
  echo "<tr>";
  echo "<td>" . $row['bid'] . "</td>";
  echo "<td>" . $row['navn'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

// Form for √• legge til barer
echo "<h2>Legg til bar</h2>";
echo"
<form method=\"post\">
Navn: <input type=\"text\" name=\"barnavn\">
<input type=\"submit\" value=\"Legg til\">
</form>";

// Form for √ •slette barer
echo "<h2>Slette bar</h2>";
echo"
<form method=\"post\">
ID: <input type=\"text\" name=\"slettebar\">
Er du helt sikker?<input type=\"checkbox\" name=\"heltsikker\" value=\"sikker\">
<input type=\"submit\" value=\"SLETT BAR\">
</form>";

// Form for √• redigere barer
echo "<h2>Redigere bar</h2>";
echo"
<form method=\"post\">
ID: <input type=\"text\" name=\"redigerebar\">
<input type=\"submit\" value=\"Rediger\">
</form>";


?>




