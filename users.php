<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Users</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<br>
<?php
$con = mysqli_connect("localhost","root","abcd1234","mccp2_bl_p3");
if (!$con)
  {
die('Could not connect: ' . mysqli_error());
  }


$sql="SELECT * FROM users order by id ASC";
$result=mysqli_query($con,$sql);


	echo '<table border="1" class="db-table">';
		echo '<tr><th>ID</th><th>USERNAME</th><th>PASSWORD</th><th>NAME</th><th>UC-ID</th></tr>';
		while($row = mysqli_fetch_row($result)) {
			echo '<tr>';
			foreach($row as $key=>$value) {
				echo '<td align="center"><b>',$value,'</b></td>';
			}
			echo '</tr>';
		}
		echo '</table><br />';
?>

</font>
</div>
</body>
</html>