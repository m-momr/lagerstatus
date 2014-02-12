<?php

$con=mysqli_connect("localhost","root","donald2k","lagerstatus");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// enklerer å jobbe med var1
$var1=$_POST['barnavn'];

// Dersom barnavn eksisterer i POST
if ($var1){
	//query for om navnet eksisterer
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


// oversikt over eksisterende barer
$resultatbarer = mysqli_query($con,"SELECT * FROM barer");

echo "<h2>Barer</h2>";
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

// Form for å legge til barer
echo "<h2>Legg til bar</h2>";
echo"
<form method=\"post\">
Name: <input type=\"text\" name=\"barnavn\"><br>
<input type=\"submit\" value=\"Legg til\">
</form>";

// Form for å



?>
