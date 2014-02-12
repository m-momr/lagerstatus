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



echo "<h2>Varer</h2>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Barnavn</th>
</tr>";

while($row = mysqli_fetch_array($resultatvarer))
  {
  echo "<tr>";
  echo "<td>" . $row['vid'] . "</td>";
  echo "<td>" . $row['navn'] . "</td>";
  echo "</tr>";
  }
echo "</table>";




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





mysqli_close($con);
?> 


