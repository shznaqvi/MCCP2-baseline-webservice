<?php

$con = mysqli_connect("localhost","root","abcd1234","mccp2_bl_p3");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql="SELECT * FROM cluster_code order by cluster ASC";

$result=mysqli_query($con,$sql);
$json = array();


while($row = mysqli_fetch_array ($result))     
{
    $logins = array(
        'ClusterID' => $row['ClusterID'],		
		'cluster' => $row['cluster'],
        'ids' => $row['ids'],
		'town_id' => $row['town_id'],
		//'cl_name' => $row['cl_name']    
    'cl_name' => preg_replace('/[^A-Za-z0-9\-]/', ' ', $row['cl_name']) 
	);
	//echo $row['ClusterID'];
    array_push($json, $logins);
	//var_dump($logins);
}





$jsonstring = json_encode($json);
echo $jsonstring;
die();








?>