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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO Node (site_id, s_mac, s_name, s_type, s_start, s_end, s_used) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['select'], "int"),
                       GetSQLValueString($_POST['textfield'], "text"),
                       GetSQLValueString($_POST['textfield2'], "text"),
                       GetSQLValueString($_POST['select2'], "text"),
                       GetSQLValueString($_POST['textfield3'], "date"),
                       GetSQLValueString($_POST['textfield4'], "date"),
                       GetSQLValueString(isset($_POST['checkbox']) ? "true" : "", "defined","1","0"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());

  $insertGoTo = "node_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_connect, $connect);
$query_site_qry = "SELECT * FROM Site ORDER BY s_name ASC";
$site_qry = mysql_query($query_site_qry, $connect) or die(mysql_error());
$row_site_qry = mysql_fetch_assoc($site_qry);
$totalRows_site_qry = mysql_num_rows($site_qry);

mysql_select_db($database_connect, $connect);
$query_devicetype = "SELECT * FROM DeviceType ORDER BY s_name ASC";
$devicetype = mysql_query($query_devicetype, $connect) or die(mysql_error());
$row_devicetype = mysql_fetch_assoc($devicetype);
$totalRows_devicetype = mysql_num_rows($devicetype);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>裝置資料編修</title>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <p>客戶編號:
    <label for="select"></label>
    <select name="select" id="select">
      <?php
do {  
?>
      <option value="<?php echo $row_site_qry['s_id']?>"><?php echo $row_site_qry['s_name']?></option>
      <?php
} while ($row_site_qry = mysql_fetch_assoc($site_qry));
  $rows = mysql_num_rows($site_qry);
  if($rows > 0) {
      mysql_data_seek($site_qry, 0);
	  $row_site_qry = mysql_fetch_assoc($site_qry);
  }
?>
    </select>
  </p>
  <p>裝置MAC:
    <label for="textfield"></label>
    <input name="textfield" type="text" id="textfield" size="12" maxlength="12" />
  </p>
  <p>裝置名稱:
    <input type="text" name="textfield2" id="textfield2" />
  </p>
  <p>裝置型態:
    <label for="select2"></label>
    <select name="select2" id="select2">
      <?php
do {  
?>
      <option value="<?php echo $row_devicetype['s_id']?>"><?php echo $row_devicetype['s_name']?></option>
      <?php
} while ($row_devicetype = mysql_fetch_assoc($devicetype));
  $rows = mysql_num_rows($devicetype);
  if($rows > 0) {
      mysql_data_seek($devicetype, 0);
	  $row_devicetype = mysql_fetch_assoc($devicetype);
  }
?>
    </select>
  </p>
  <p>開始啟用時間
    <input type="text" name="textfield3" id="textfield3" />
  </p>
  <p>結束使用時間
    <input type="text" name="textfield4" id="textfield4" />
  </p>
  <p>是否使用
    <input name="checkbox" type="checkbox" id="checkbox" value="1" checked="checked" />
    <label for="checkbox"></label>
  </p>
  <p>
    <input type="reset" name="button" id="button" value="重設" />
    <input type="submit" name="button2" id="button2" value="送出" />
  </p>
  <p><a href="node_list.php" target="_self">回到主頁</a></p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</body>
</html>
<?php
mysql_free_result($site_qry);

mysql_free_result($devicetype);
?>
