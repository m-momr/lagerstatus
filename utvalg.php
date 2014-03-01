<?php
$con=mysqli_connect("localhost","root","donald2k","lagerstatus");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$resultatbarer = mysqli_query($con,"SELECT * FROM barer");
$resultatvarer = mysqli_query($con,"SELECT * FROM varer");
$resultatstatus = mysqli_query($con,"SELECT * FROM status");


// START POST WORK

if ($_POST['nyttvalg']){
	$var_barid=$_POST['barid'];
	$var_vareid=$_POST['vareid'];
	
	echo "DEBUG: " . $var_barid . $var_vareid;
	
	
}


// END POST WORK



echo "<h2>Status</h2>";
echo "<table border='1'>
<tr>
<th>SID</th>
<th>barid</th>
<th>vareid</th>
<th>ant</th>
</tr>";

while($row = mysqli_fetch_array($resultatstatus))
  {
  echo "<tr>";
  echo "<td>" . $row['sid'] . $row_['barnavn'] . "</td>";
  echo "<td>" . $row['barid'] . "</td>";
  echo "<td>" . $row['vareid'] . "</td>";
  echo "<td>" . $row['ant'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

echo "<h2>Legg til utvalg</h2>";
echo"
<form method=\"post\">
<input type=\"hidden\" name=\"nyttvalg\" value=\"1\">
BARID: <select name=\"barid\">";

while($row = mysqli_fetch_array($resultatbarer)){
	echo "<option value=" . $row['bid'] . ">" . $row['bid'] . "</option>";

}

echo"
VAREID: <input type=\"text\" value=\"0\" name=\"vareid\">
<input type=\"submit\" value=\"Legg Til\">:
</form>";

echo "<h2>Fjern utvalg</h2>";




?>


