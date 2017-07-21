<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Cluster</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
  <br>
<?php
$con = mysqli_connect("localhost","root","abcd1234","mccp2_bl_p3");
if (!$con)
  {
die('Could not connect: ' . mysqli_error());
  }


$sql="SELECT C.Cluster, C.cl_name, UC.uc_name, T.town_name  FROM cluster_code C Inner Join town_code T on C.town_id = T.town_id inner join uc_code UC on C.ids=UC.uc_id order by town_name, uc_name";
$result=mysqli_query($con,$sql);
var_dump($result);


	echo '<table border="1">';
		echo '<tr><th>ClusterCode</th><th>Cluster Name</th><th>UC Name</th><th>Town</th></font></tr>';
		while($row = mysqli_fetch_row($result)) {
			echo '<tr>';
			foreach($row as $key=>$value) {
				echo '<td align="center"><b>',$value,'</b></td>';
			}
			echo '</tr>';
		}
		echo '</table><br />';
?>


  </font></div>

</body>
</html>