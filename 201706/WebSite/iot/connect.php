<?php

	function Connection(){
		$server="127.0.0.1";		//mySQL伺服器網址
		$user="root";			//使用者名稱
		$pass="";				//使用者密碼
		$db="iot";				//連線資料庫名稱
	   	
		$connection = mysql_connect($server, $user, $pass);		//用上述資料進行mySQL連線

		if (!$connection) {		//如果連線失敗
	    	die('MySQL ERROR: ' . mysql_error());		//失敗訊息
		}
		
		mysql_select_db($db) or die( 'MySQL ERROR: '. mysql_error() );		//切換到iot預設資料庫

		return $connection;			//回傳連線
	}
?>
