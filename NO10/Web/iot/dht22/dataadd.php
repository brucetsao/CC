<?php require_once('../Connections/connect.php');
require_once('../Connections/connSQL.php');
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
 
   	
   	$link=Connection();		//產生mySQL連線物件
	
	//$mac=$_GET["mac"];
$mac=f0038ce7a8e4;
	mysql_select_db($database_connSQL, $connSQL);
	$query_RecGateway = sprintf("SELECT * FROM Gateway WHERE g_mac2 = %s ORDER BY g_sensorid ASC", GetSQLValueString($mac, "text"));
	$RecGateway = mysql_query($query_RecGateway, $connSQL) or die(mysql_error());
	$row_RecGateway = mysql_fetch_assoc($RecGateway);
	
	do { 

	if($row_RecGateway['g_sensorid']=='1')
 		$voltage1=$row_RecGateway['g_voltage'];
	elseif($row_RecGateway['g_sensorid']=='2')
 		$voltage2=$row_RecGateway['g_voltage'];
	elseif($row_RecGateway['g_sensorid']=='3')
 		$voltage3=$row_RecGateway['g_voltage'];
	elseif($row_RecGateway['g_sensorid']=='4')
 		$voltage4=$row_RecGateway['g_voltage'];
	elseif($row_RecGateway['g_sensorid']=='5')
 		$voltage5=$row_RecGateway['g_voltage'];
	elseif($row_RecGateway['g_sensorid']=='6')
 		$voltage6=$row_RecGateway['g_voltage'];
	elseif($row_RecGateway['g_sensorid']=='7')
 		$voltage7=$row_RecGateway['g_voltage'];
	elseif($row_RecGateway['g_sensorid']=='8')
 		$voltage8=$row_RecGateway['g_voltage'];
	}while ($row_RecGateway = mysql_fetch_assoc($RecGateway));
	
    /*echo $voltage1;
	echo $voltage2;
	echo $voltage3;
	echo $voltage4;
	echo $voltage5;
	echo $voltage6;
	echo $voltage7;
	echo $voltage8;*/
	
	
	$current1=$_GET["current1"];
	$current2=$_GET["current2"];
	$current3=$_GET["current3"];
	$current4=$_GET["current4"];
	$current5=$_GET["current5"];
	$current6=$_GET["current6"];
	$current7=$_GET["current7"];
	$current8=$_GET["current8"];			
	
	$power1=(string)((double)$voltage1*(double)$current1);
	$power2=(string)((double)$voltage2*(double)$current2);
	$power3=(string)((double)$voltage3*(double)$current3);
	$power4=(string)((double)$voltage4*(double)$current4);
	$power5=(string)((double)$voltage5*(double)$current5);
	$power6=(string)((double)$voltage6*(double)$current6);
	$power7=(string)((double)$voltage7*(double)$current7);
	$power8=(string)((double)$voltage8*(double)$current8);
	
	
	
	
	$tablename1="S".$mac."1";
	$tablename2="S".$mac."2";
	$tablename3="S".$mac."3";
	$tablename4="S".$mac."4";
	$tablename5="S".$mac."5";
	$tablename6="S".$mac."6";
	$tablename7="S".$mac."7";
	$tablename8="S".$mac."8";
	$yymmdd=getYMD();
	$hhii=getHI();
	
	
    $query = "INSERT INTO $tablename1 (mac,voltage,current,power,yymmdd,hhii) VALUES ('".$mac."',".$voltage1.",".$current1.",".$power1.",".$yymmdd.",".$hhii.")"; 
    echo $query ;
	mysql_query($query,$link);
	
    $query = "INSERT INTO $tablename2 (mac,voltage,current,power,yymmdd,hhii) VALUES ('".$mac."',".$voltage2.",".$current2.",".$power2.",".$yymmdd.",".$hhii.")";  
    echo $query ;
	mysql_query($query,$link);
	
	$query = "INSERT INTO $tablename3 (mac,voltage,current,power,yymmdd,hhii) VALUES ('".$mac."',".$voltage3.",".$current3.",".$power3.",".$yymmdd.",".$hhii.")"; 
	echo $query ;
	mysql_query($query,$link);
  	
    $query = "INSERT INTO $tablename4 (mac,voltage,current,power,yymmdd,hhii) VALUES ('".$mac."',".$voltage4.",".$current4.",".$power4.",".$yymmdd.",".$hhii.")"; 
	echo $query ;
	mysql_query($query,$link);

    $query = "INSERT INTO $tablename5 (mac,voltage,current,power,yymmdd,hhii) VALUES ('".$mac."',".$voltage5.",".$current5.",".$power5.",".$yymmdd.",".$hhii.")"; 
	echo $query ;
	mysql_query($query,$link);
    $query = "INSERT INTO $tablename6 (mac,voltage,current,power,yymmdd,hhii) VALUES ('".$mac."',".$voltage6.",".$current6.",".$power6.",".$yymmdd.",".$hhii.")"; 
	echo $query ;
	mysql_query($query,$link);
    $query = "INSERT INTO $tablename7 (mac,voltage,current,power,yymmdd,hhii) VALUES ('".$mac."',".$voltage7.",".$current7.",".$power7.",".$yymmdd.",".$hhii.")"; 
	echo $query ;
	mysql_query($query,$link);
    $query = "INSERT INTO $tablename8 (mac,voltage,current,power,yymmdd,hhii) VALUES ('".$mac."',".$voltage8.",".$current8.",".$power8.",".$yymmdd.",".$hhii.")"; 
	echo $query ;
	mysql_query($query,$link);
	mysql_close($link);		///關閉Query
	mysql_free_result($RecGateway);
	
 
function getYMD(){
	$today = getdate();
	date("Y/m/d H:i");  //日期格式化
	$year=$today["year"]; //年 
	$month=$today["mon"]; //月
	$day=$today["mday"];  //日
 
	if(strlen($month)=='1')$month='0'.$month;
	if(strlen($day)=='1')$day='0'.$day;
	$today=$year.$month.$day;
	//echo "今天日期 : ".$today;
 
	return $today;
}
function getHI(){
	$today = getdate();
	date("Y/m/d H:i");  //日期格式化
	$hours=$today["hours"]; //時
	$minutes=$today["minutes"]; //分
 
	if(strlen($hours)=='1')$hours='0'.$hours;
	if(strlen($minutes)=='1')$minutes='0'.$minutes;
	$today=$hours.$minutes;
	//echo "今天日期 : ".$today;
 
	return $today;
}
?>
