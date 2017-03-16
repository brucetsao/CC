<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_iotcnn = "localhost";
$database_iotcnn = "iot";
$username_iotcnn = "root";
$password_iotcnn = "";
$iotcnn = mysql_pconnect($hostname_iotcnn, $username_iotcnn, $password_iotcnn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>