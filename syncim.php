<?php
ini_set('max_execution_time', 0); 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	$con = mysqli_connect("localhost","root","abcd1234","mccp2_bl_p3");	if (!$con)
	  {
	die('Could not connect: ' . mysqli_error());
	//echo "Syncing...";
	
  }else {syncIMs();
	  //echo "Server Request ".$_SERVER["REQUEST_METHOD"];
  }
	}

function syncIMs(){
	$sql = "";
	global $con;
	$value = file_get_contents("php://input");
	$value = preg_replace('/[\x00-\x1F\x7F]/', '', $value);

	//$value = stripslashes($value);
	$value = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($value));
	$value = str_replace("\0", "", $value);
	$value = str_replace("'", " ", $value);

	$today = date("Y-m-d H:i:s");
	$file = 'im.json';
	
	file_put_contents($file, $today." - ".$value."\r\n", FILE_APPEND | LOCK_EX);

	$value = json_decode($value,true);
	
switch (json_last_error()) {
        case JSON_ERROR_NONE:
			$data[] = array(
				'status' => 'json_last_error()'
			);
			break;
        case JSON_ERROR_DEPTH:
            $data[] = array(
				'status' => 'json_last_error()'
			);
			break;
        case JSON_ERROR_STATE_MISMATCH:
            $data[] = array(
				'status' => 'json_last_error()'
			);
			break;
        case JSON_ERROR_CTRL_CHAR:
            $data[] = array(
				'status' => 'json_last_error()'
			);
			break;
        case JSON_ERROR_SYNTAX:
            $data[] = array(
				'status' => 'json_last_error()'
			);
			break;
        case JSON_ERROR_UTF8:
            $data[] = array(
				'status' => 'json_last_error()'
			);
			break;
        default:
            $data[] = array(
				'status' => 'json_last_error()'
			);
			break;
    }
	
 
if(json_last_error() === JSON_ERROR_NONE){
	$jCount = count($value);
	$rCount = 0;
	
	foreach($value as $row){
	$imFrmno=$row['imFrmno'];
	//echo $row['imFrmNo'];
	$imChid=$row['imChid'];
	$im=$row['im'];
	$im = json_decode($im, true);
	$DeviceId=$row['DeviceId'];

	$bcg=$im['bcg'];
	$bcgscar=$im['bcgscar'];
	$bcgsrc=$im['bcgsrc'];
	$DataC=$im['DataC'];
	$FormId=$im['FormId'];
	$FrmDT=$im['FrmDT'];
	$FrmNo=$im['FrmNo'];
	$ima=$im['ima'];
	$imaf=$im['imaf'];
	$imb=$im['imb'];
	$imc=$im['imc'];
	$imd=$im['imd'];
	$imddoc=$im['imddoc'];
	$imed=$im['imed'];
	$imem=$im['imem'];
	$imey=$im['imey'];
	$imf=$im['imf'];
	$img=$im['img'];
	$imh=$im['imh'];
	$imi=$im['imi'];
	$imj=$im['imj'];
	$imjb=$im['imjb'];
	$imk=$im['imk'];
	$imma=$im['imma'];
	$immd=$im['immd'];
	$m_1=$im['m_1'];
	$m_1src=$im['m_1src'];
	$m_2=$im['m_2'];
	$m_2src=$im['m_2src'];
	$opv_0=$im['opv_0'];
	$opv_0src=$im['opv_0src'];
	$opv_1=$im['opv_1'];
	$opv_1src=$im['opv_1src'];
	$opv_2=$im['opv_2'];
	$opv_2src=$im['opv_2src'];
	$opv_3=$im['opv_3'];
	$opv_3src=$im['opv_3src'];
	$p_1=$im['p_1'];
	$p_1src=$im['p_1src'];
	$p_2=$im['p_2'];
	$p_2src=$im['p_2src'];
	$p_3=$im['p_3'];
	$p_3src=$im['p_3src'];
	$pcv_1=$im['pcv_1'];
	$pcv_1src=$im['pcv_1src'];
	$pcv_2=$im['pcv_2'];
	$pcv_2src=$im['pcv_2src'];
	$pcv_3=$im['pcv_3'];
	$pcv_3src=$im['pcv_3src'];

	
	$sql = "INSERT INTO ims2 (
	bcg
,bcgscar
,bcgsrc
,DataC
,DeviceId
,UID
,FrmDT
,FrmNo
,ima
,imaf
,imb
,imc
,imChid
,imd
,imddoc
,imed
,imem
,imey
,imf
,imFrmno
,img
,imh
,imi
,imj
,imjb
,imk
,imma
,immd
,m_1
,m_1src
,m_2
,m_2src
,opv_0
,opv_0src
,opv_1
,opv_1src
,opv_2
,opv_2src
,opv_3
,opv_3src
,p_1
,p_1src
,p_2
,p_2src
,p_3
,p_3src
,pcv_1
,pcv_1src
,pcv_2
,pcv_2src
,pcv_3
,pcv_3src

	) VALUES (
	
	'$bcg'
,'$bcgscar'
,'$bcgsrc'
,'$DataC'
,'$DeviceId'
,'$FormId'
,'$FrmDT'
,'$FrmNo'
,'$ima'
,'$imaf'
,'$imb'
,'$imc'
,'$imChid'
,'$imd'
,'$imddoc'
,'$imed'
,'$imem'
,'$imey'
,'$imf'
,'$imFrmno'
,'$img'
,'$imh'
,'$imi'
,'$imj'
,'$imjb'
,'$imk'
,'$imma'
,'$immd'
,'$m_1'
,'$m_1src'
,'$m_2'
,'$m_2src'
,'$opv_0'
,'$opv_0src'
,'$opv_1'
,'$opv_1src'
,'$opv_2'
,'$opv_2src'
,'$opv_3'
,'$opv_3src'
,'$p_1'
,'$p_1src'
,'$p_2'
,'$p_2src'
,'$p_3'
,'$p_3src'
,'$pcv_1'
,'$pcv_1src'
,'$pcv_2'
,'$pcv_2src'
,'$pcv_3'
,'$pcv_3src'
	);";
	//echo $ucname;
	mysqli_query($con, $sql) or die (mysqli_error($con));
					$rCount= $rCount+1;
}
	}
	mysqli_close($con);
	//echo "Succcess!";
	
	$encoded = $jCount." Received - ".$rCount." inserted Succcessfully";
header('Content-type: application/json');
exit($encoded);
}