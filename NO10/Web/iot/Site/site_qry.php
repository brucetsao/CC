<?php require_once('../Connections/connect.php'); ?>
<?php
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

$colname_Recordset1 = "-1";
if (isset($_GET['sid'])) {
  $colname_Recordset1 = $_GET['sid'];
}
mysql_select_db($database_connect, $connect);
$query_Recordset1 = sprintf("SELECT * FROM Site WHERE s_id = %s ORDER BY s_name ASC", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>實施點 客戶資料查詢</title>
</head>

<body>
<p><a href="index.php" target="_self">回到主頁</a></p>
<form id="form1" name="form1" method="post" action="">
  <p>客戶號碼：
    <label for="textfield2"></label>
  <?php echo $row_Recordset1['s_id']; ?></p>
  客戶名稱：
    <label for="textfield"><?php echo $row_Recordset1['s_name']; ?></label>
  <p>緯度:
    <label for="textfield2"></label>
  <?php echo $row_Recordset1['s_lat']; ?></p>
  <p> 經度:  <?php echo $row_Recordset1['s_lon']; ?></p>
  <p> 登記住址:  <?php echo $row_Recordset1['s_addr1']; ?></p>
  <p> 實際住址:  <?php echo $row_Recordset1['s_addr2']; ?></p>
  <p> 電話:  <?php echo $row_Recordset1['s_tel1']; ?></p>
  <p> 電話二:  <?php echo $row_Recordset1['s_tel2']; ?></p>
  <p> 傳真:  <?php echo $row_Recordset1['s_fax']; ?></p>
  <p> 聯絡人:  <?php echo $row_Recordset1['s_contact']; ?></p>
  <p> 聯絡人手機:  <?php echo $row_Recordset1['s_mobile']; ?></p>
  <p>更新時間：<?php echo $row_Recordset1['s_update']; ?></p>
  <p>&nbsp;</p>
  <p><a href="index.php" target="_self">回到主頁</a></p>
  <p>&nbsp;</p>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
