<?php require_once('../Connections/connect.php');

 
   	
   	$link=Connection();		//產生mySQL連線物件

	$temp1=$_GET["field1"];		//取得POST參數 : field1
	$temp2=$_GET["field2"];		//取得POST參數 : field2
	

	$query = "INSERT INTO barcodedata (deviceid,bcode) 
	VALUES ('".$temp1."','".$temp2."')"; 
	//組成新增到dhtdata資料表的SQL語法


  	echo $query ;

	mysql_query($query,$link);			//執行SQL語法
	mysql_close($link);		//關閉Query
	 

?>
