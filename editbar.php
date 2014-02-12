<?php

$con=mysqli_connect("localhost","root","donald2k","lagerstatus");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
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


// Dersom barnavn eksisterer i POST
if ($_POST['barnavn']){
	echo $_POST['barnavn'];}
else{
	echo "NEI";}



?>
