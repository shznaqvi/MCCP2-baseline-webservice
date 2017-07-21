<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Town</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>


  <br>
  <?php
$con = mysqli_connect("localhost","root","abcd1234","mccp2_bl_p3");
if (!$con)
  {
die('Could not connect: ' . mysqli_error());
  }

$sql="SELECT * FROM town_code order by town_id ASC";
$result=mysqli_query($con,$sql);


	echo '<table border="1" width="500" class="db-table">';
		echo '<tr><th>TOWN ID</th><th>TOWN NAME</th></tr>';
		while($row = mysqli_fetch_row($result)) {
			echo '<tr>';
			foreach($row as $key=>$value) {
				echo '<td align="center"><b>',$value,'</b></td>';
			}
			echo '</tr>';
		}
		echo '</table><br />';
?>
</body>
</html>