<?php require_once('../Connections/connect.php');

 
   	
   	$link=Connection();		//產生mySQL連線物件
	
    
	$voltage1=$_GET["voltage1"];
	$voltage2=$_GET["voltage2"];
	$voltage3=$_GET["voltage3"];
	$voltage4=$_GET["voltage4"];
	$voltage5=$_GET["voltage5"];
	$voltage6=$_GET["voltage6"];
	$voltage7=$_GET["voltage7"];
	$voltage8=$_GET["voltage8"];
    	
	$current1=$_GET["current1"];
	$current2=$_GET["current2"];
	$current3=$_GET["current3"];
	$current4=$_GET["current4"];
	$current5=$_GET["current5"];
	$current6=$_GET["current6"];
	$current7=$_GET["current7"];
	$current8=$_GET["current8"];			
	
	$power1=$_GET["power1"];
	$power2=$_GET["power2"];
	$power3=$_GET["power3"];
	$power4=$_GET["power4"];
	$power5=$_GET["power5"];
	$power6=$_GET["power6"];
	$power7=$_GET["power7"];
	$power8=$_GET["power8"];
	
	$mac=$_GET["mac"];
	
	
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
