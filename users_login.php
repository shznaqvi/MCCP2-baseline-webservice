<?php
$con = mysqli_connect("localhost","root","abcd1234","mccp2_bl_p3");
if (!$con)
  {
die('Could not connect: ' . mysqli_error());
  }


$sql="SELECT * FROM users order by id ASC";
$result=mysqli_query($con,$sql);

$json = array();
while($row = mysqli_fetch_array ($result))     
{
    $logins = array(
        'username' => $row['username'],
        'password' => $row['password']
    
    );
    array_push($json, $logins);
}

$jsonstring = json_encode($json);
echo $jsonstring;

die();

	
?>