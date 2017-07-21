	<?php
$con = mysqli_connect("localhost","root","abcd1234","mccp2_bl_p3");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql="SELECT * FROM uc_code order by ids ASC";
$result=mysqli_query($con,$sql);

$json = array();
while($row = mysqli_fetch_array ($result))     
{
    $logins = array(
        'ids' => $row['ids'],
        'uc_id' => $row['uc_id'],
		'town_id' => $row['town_id'],
		'uc_name' => $row['uc_name']
    
    );
	
    array_push($json, $logins);
}

$jsonstring = json_encode($json);

echo $jsonstring;
die();
?>