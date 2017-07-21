<?php
$con = mysqli_connect("localhost","root","abcd1234","mccp2_bl_p3");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql="SELECT * FROM town_code order by town_id ASC";
$result=mysqli_query($con,$sql);

$json = array();
while($row = mysqli_fetch_array ($result))     
{
    $logins = array(
        'town id' => $row['town_id'],
        'town name' => $row['town_name']
    
    );
    array_push($json, $logins);
}

$jsonstring = json_encode($json);
echo $jsonstring;

die();
?>