<?php
$con=mysqli_connect("localhost","root","donald2k","lagerstatus");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$resultatstatus = mysqli_query($con,"SELECT * FROM status");

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
  echo "<td>" . $row['sid'] . "</td>";
  echo "<td>" . $row['barid'] . "</td>";
  echo "<td>" . $row['vareid'] . "</td>";
  echo "<td>" . $row['ant'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

echo "<h2>Legg til utvalg</h2>";


echo "<h2>Fjern utvalg</h2>";




?>


