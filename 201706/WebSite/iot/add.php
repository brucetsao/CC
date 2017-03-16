<?php
   	include("connect.php");
   	
   	$link=Connection();

	$temp1=$_POST["light"];


	$query = "INSERT INTO `lightdata` (`data`) VALUES ('".$temp1."')"; 
   	
   	mysql_query($query,$link);
	mysql_close($link);
 echo $temp1 ;
  // 	header("Location: index.php");
?>
