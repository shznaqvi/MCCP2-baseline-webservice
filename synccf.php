<?php
ini_set('max_execution_time', 0); 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	$con = mysqli_connect("localhost","root","abcd1234","mccp2_bl_p3");	if (!$con)
	  {
	die('Could not connect: ' . mysqli_error());
	//echo "Syncing...";
	
  }else {syncCfs();
	  //echo "Server Request ".$_SERVER["REQUEST_METHOD"];
  }
	}

function syncCfs(){
	$sql = "";
	global $con;
	$value = file_get_contents("php://input");
	$value = preg_replace('/[\x00-\x1F\x7F]/', '', $value);

	//$value = stripslashes($value);
	$value = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($value));
	$value = str_replace("\0", "", $value);
	$value = str_replace("'", " ", $value);

	$today = date("Y-m-d H:i:s");
	$file = 'cf.json';
	
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
	$rCount = 0;
	foreach($value as $row){
	$cfFrmno=$row['cfFrmno'];
	$cfChid=$row['cfChid'];
	$cf=$row['cf'];
	$cf = json_decode($cf, true);
	$cf_Q2_3=$cf['cf_Q2_3'];
	$FormId=$cf['FormId'];
	$cf_Q2_2=$cf['cf_Q2_2'];
	$cf_Q2_5=$cf['cf_Q2_5'];
	$FrmDT=$cf['FrmDT'];
	$cf_Q2_4=$cf['cf_Q2_4'];
	$DataC=$cf['DataC'];
	$cf_Q2_6=$cf['cf_Q2_6'];
	$cf_Q1=$cf['cf_Q1'];
	$cf_Q2=$cf['cf_Q2'];
	$cf_Q3=$cf['cf_Q3'];
	$cf_Q4=$cf['cf_Q4'];
	$cf_Q2_1=$cf['cf_Q2_1'];


	$deviceid=$row['DeviceId'];


	
	//$sql = "INSERT INTO `forms`(`MC_FRMNO`, `MC_101`, `MC_101TIME`, `MC_102`, `MC_103`, `MC_104`, `MC_105`, `MC_106`, `MC_107`, `MC_108`, `MC_109`, `MC_110`, `MC_110X`, `MC_201NM`, `MC_201GNDR`, `MC_201TYPE`, `MC_201AGE`, `MC_201EDU`, `MC_201OCU`, `MC_202NM`, `MC_202GNDR`, `MC_202AGE`, `MC_202EDU`, `MC_202OCU`, `MC_203TOT`, `MC_203M`, `MC_203F`, `MC_204M`, `MC_204F`, `MC_204T`, `MC_205YY`, `MC_205MM`, `MC_206`, `MC_207_1W`, `MC_207_1M`, `MC_207_2W`, `MC_207_2M`, `MC_207_3W`, `MC_207_3M`, `MC_401`, `MC_402_1`, `MC_402_2`, `MC_402_3`, `MC_402_4`, `MC_402_5`, `MC_402_6`, `MC_402_7`, `MC_402_8`, `MC_402_9`, `MC_402_10`, `MC_402_88`, `MC_403`, `MC_404_1`, `MC_404_2`, `MC_404_3`, `MC_404_4`, `MC_404_5`, `MC_404_6`, `MC_404_7`, `MC_404_8`, `MC_404_9`, `MC_404_99`, `MC_404_88`, `MC_404_X1`, `MC_404_X2`, `MC_404_X3`, `MC_405_1`, `MC_405_2`, `MC_405_3`, `MC_405_4`, `MC_405_5`, `MC_405_99`, `MC_405_88`, `MC_405A1`, `MC_405A2`, `MC_405A3`, `MC_405A4`, `MC_405A99`, `MC_405A88`, `MC_406`, `MC_407_1`, `MC_407_2`, `MC_407_3`, `MC_407_4`, `MC_407_5`, `MC_407_6`, `MC_407_88`, `MC_408`, `MC_409`, `MC_409_88`, `MC_410`, `MC_410_88`, `MC_411`, `MC_410A`, `MC_410B1`, `MC_410B2`, `MC_410B3`, `MC_410B4`, `MC_410B5`, `MC_41099`, `MC_412`, `MC_410BX`, `MC_413_1`, `MC_413_2`, `MC_413_3`, `MC_413_4`, `MC_413_5`, `MC_413_6`, `MC_413_7`, `MC_413_88`, `MC_414`, `MC_415`, `MC_415X`, `MC_501`, `MC_501_88`, `MC_502`, `MC_503ALHW`, `MC_503AFCV`, `MC_503ALHS`, `MC_503ANGO`, `MC_503AX`, `MC_503BLHW`, `MC_503BFCV`, `MC_503BLHS`, `MC_503BNGO`, `MC_503BX`, `MC_503CLHW`, `MC_503CFCV`, `MC_503CLHS`, `MC_503CNGO`, `MC_503CX`, `MC_503DLHW`, `MC_503DFCV`, `MC_503DLHS`, `MC_503DNGO`, `MC_503DX`, `MC_503ELHW`, `MC_503EFCV`, `MC_503ELHS`, `MC_503ENGO`, `MC_503EX`, `MC_503FLHW`, `MC_503FFCV`, `MC_503FLHS`, `MC_503FNGO`, `MC_503FX`, `MC_503GLHW`, `MC_503GFCV`, `MC_503GLHS`, `MC_503GNGO`, `MC_503GX`, `MC_503XLHW`, `MC_503XFCV`, `MC_503XLHS`, `MC_503XNGO`, `MC_503GXX`, `MC_504W`, `MC_504_W88`, `MC_504R`, `MC_504_F88`, `MC_505`, `MC_506`, `MC_507`, `MC_508`, `MC_508_88`, `MC_509`, `MC_509_88`, `MC_510`, `MC_510_88`, `MC_511`, `MC_512_1`, `MC_512_2`, `MC_512_3`, `MC_512_4`, `MC_512_5`, `MC_512_6`, `MC_512_7`, `MC_512_8`, `MC_512_88`, `MC_513`, `MC_513_88`, `MC_514`, `MC_515`, `MC_516`, `MC_517`, `MC_518`, `MC_519_1`, `MC_519_2`, `MC_519_3`, `MC_519_4`, `MC_519_5`, `MC_520`, `MC_521_1`, `MC_521_2`, `MC_521_3`, `MC_521_4`, `MC_521_5`, `MC_522_2`, `MC_522_3`, `MC_522_4`, `MC_522_5`, `MC_522_6`, `MC_522_7`, `MC_522_8`, `MC_522_9`, `MC_522_88`, `MC_523`, `MC_524ACR`, `MC_524CAN`, `MC_525_1`, `MC_525_2`, `MC_525_3`, `MC_525_4`, `MC_525_5`, `MC_525_6`, `MC_525_7`, `MC_525_7X`, `MC_525_8`, `MC_525_9`, `MC_525_10`, `MC_525_11`, `MC_525_12`, `MC_525_13`, `MC_525_14`, `MC_525_15`, `MC_525_16`, `MC_525_17`, `MC_525_18`, `MC_525_19`, `MC_525_20`, `MC_601`, `MC_602`, `MC_603_1`, `MC_603_2`, `MC_603_3`, `MC_603_4`, `MC_603_5`, `MC_603_X1`, `MC_604_1`, `MC_604_2`, `MC_604_3`, `MC_604_4`, `MC_604_5`, `MC_604_6`, `MC_604_7`, `MC_604_8`, `MC_604_9`, `MC_604_10`, `MC_604_11`, `MC_604_12`, `MC_605_1`, `MC_605_2`, `MC_605_3`, `MC_605_4`, `MC_605_5`, `MC_606`, `MC_607_1`, `MC_607_2`, `MC_607_3`, `MC_607_4`, `MC_607_5`, `MC_607_6`, `MC_607_7`, `MC_607_8`, `MC_607A`, `MC_607B`, `MC_607BX`, `MC_608_M1`, `MC_608_M2`, `MC_608_M3`, `MC_608_M4`, `MC_608_M5`, `MC_609`, `MC_610`, `MC_DC`, `MC_DCDT`, `MC_TL`, `MC_TLDT`, `MC_SP`, `MC_SPDT`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24],[value-25],[value-26],[value-27],[value-28],[value-29],[value-30],[value-31],[value-32],[value-33],[value-34],[value-35],[value-36],[value-37],[value-38],[value-39],[value-40],[value-41],[value-42],[value-43],[value-44],[value-45],[value-46],[value-47],[value-48],[value-49],[value-50],[value-51],[value-52],[value-53],[value-54],[value-55],[value-56],[value-57],[value-58],[value-59],[value-60],[value-61],[value-62],[value-63],[value-64],[value-65],[value-66],[value-67],[value-68],[value-69],[value-70],[value-71],[value-72],[value-73],[value-74],[value-75],[value-76],[value-77],[value-78],[value-79],[value-80],[value-81],[value-82],[value-83],[value-84],[value-85],[value-86],[value-87],[value-88],[value-89],[value-90],[value-91],[value-92],[value-93],[value-94],[value-95],[value-96],[value-97],[value-98],[value-99],[value-100],[value-101],[value-102],[value-103],[value-104],[value-105],[value-106],[value-107],[value-108],[value-109],[value-110],[value-111],[value-112],[value-113],[value-114],[value-115],[value-116],[value-117],[value-118],[value-119],[value-120],[value-121],[value-122],[value-123],[value-124],[value-125],[value-126],[value-127],[value-128],[value-129],[value-130],[value-131],[value-132],[value-133],[value-134],[value-135],[value-136],[value-137],[value-138],[value-139],[value-140],[value-141],[value-142],[value-143],[value-144],[value-145],[value-146],[value-147],[value-148],[value-149],[value-150],[value-151],[value-152],[value-153],[value-154],[value-155],[value-156],[value-157],[value-158],[value-159],[value-160],[value-161],[value-162],[value-163],[value-164],[value-165],[value-166],[value-167],[value-168],[value-169],[value-170],[value-171],[value-172],[value-173],[value-174],[value-175],[value-176],[value-177],[value-178],[value-179],[value-180],[value-181],[value-182],[value-183],[value-184],[value-185],[value-186],[value-187],[value-188],[value-189],[value-190],[value-191],[value-192],[value-193],[value-194],[value-195],[value-196],[value-197],[value-198],[value-199],[value-200],[value-201],[value-202],[value-203],[value-204],[value-205],[value-206],[value-207],[value-208],[value-209],[value-210],[value-211],[value-212],[value-213],[value-214],[value-215],[value-216],[value-217],[value-218],[value-219],[value-220],[value-221],[value-222],[value-223],[value-224],[value-225],[value-226],[value-227],[value-228],[value-229],[value-230],[value-231],[value-232],[value-233],[value-234],[value-235],[value-236],[value-237],[value-238],[value-239],[value-240],[value-241],[value-242],[value-243],[value-244],[value-245],[value-246],[value-247],[value-248],[value-249],[value-250],[value-251],[value-252],[value-253],[value-254],[value-255],[value-256],[value-257],[value-258],[value-259],[value-260],[value-261],[value-262],[value-263],[value-264],[value-265],[value-266],[value-267],[value-268],[value-269],[value-270],[value-271],[value-272],[value-273],[value-274],[value-275],[value-276],[value-277],[value-278],[value-279],[value-280])";
	$sql = "INSERT INTO cfs2 (cfFrmNo, cfChid, 
cf_Q2_3,
UID,
cf_Q2_2,
cf_Q2_5,
FrmDT,
cf_Q2_4,
DataC,
cf_Q2_6,
cf_Q1,
cf_Q2,
cf_Q3,
cf_Q4,
cf_Q2_1,
 DeviceId) VALUES ('$cfFrmno', '$cfChid', 
'$cf_Q2_3',
'$FormId',
'$cf_Q2_2',
'$cf_Q2_5',
'$FrmDT',
'$cf_Q2_4',
'$DataC',
'$cf_Q2_6',
'$cf_Q1',
'$cf_Q2',
'$cf_Q3',
'$cf_Q4',
'$cf_Q2_1',
 '$deviceid');";
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