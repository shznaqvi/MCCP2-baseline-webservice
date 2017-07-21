<?php
include_once '..\dbconfig.php';

$table = "forms2";

// To GET
// ***
//
// $sql="SELECT * FROM $table";
// $result=mysqli_query($con,$sql);


$value = file_get_contents("php://input");
$value = preg_replace('/[\x00-\x1F\x7F]/', '', $value);

//$value = stripslashes($value);
$value = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($value));
$value = str_replace("\0", "", $value);
$value = str_replace("'", " ", $value);

$today = date("Y-m-d H:i:s");
$file = '$table.json';

file_put_contents($file, $today." - ".$value."\r\n", FILE_APPEND | LOCK_EX);
$value = json_decode($value,true);

if ($value === null && json_last_error() !== JSON_ERROR_NONE) {
	$data[] = array('status' => 'json_last_error()');
} 
else 
{
	$jCount = count($value);
	$rCount = 0;
	foreach($value as $row){
		
		
		$row=flatten($row);
		$array_keys = array_keys($row);
		$array_values = array_values($row);
		
		/* $queryCreateTable = "CREATE TABLE IF NOT EXISTS $table (
									colID int(11) unsigned NOT NULL auto_increment,
									colDate TIMESTAMP NULL DEFAULT now(), ";
	
	foreach($array_keys as $key){						
		$queryCreateTable .= $key." TEXT NOT NULL, ";
	}

		$queryCreateTable .= "PRIMARY KEY (colID), UNIQUE KEY ID_UNIQUE (colID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
var_dump($queryCreateTable);
		$con->query($queryCreateTable); */
		$sql = "INSERT INTO $table(".implode(",",$array_keys).") VALUES(".implode(",",$array_values).")";
		if(mysqli_query($con, $sql)){
			$json[] = array("status" => 1, "id" => $row['_id']);
		}else{
			$json[] = array("status" => 0, "id" => $row['_id']);
		}
		$rCount= $rCount+1;
	}
} 
mysqli_close($con);

header('Content-Type: application/json');
echo json_encode($json);

function flatten($array) {
    $result = array();
    foreach($array as $key=>$value) {
        if(is_array($value)) {
            $result = $result + flatten($value);
        }
        else {
            $result[$key] = $value;
        }
    }
    return $result;
}
	

?>