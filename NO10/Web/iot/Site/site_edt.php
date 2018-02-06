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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE Site SET s_name=%s, s_lat=%s, s_lon=%s, s_addr1=%s, s_addr2=%s, s_tel1=%s, s_tel2=%s, s_fax=%s, s_contact=%s, s_mobile=%s WHERE s_id=%s",
                       GetSQLValueString($_POST['textfield'], "text"),
                       GetSQLValueString($_POST['textfield2'], "double"),
                       GetSQLValueString($_POST['textfield3'], "double"),
                       GetSQLValueString($_POST['textfield4'], "text"),
                       GetSQLValueString($_POST['textfield5'], "text"),
                       GetSQLValueString($_POST['textfield6'], "text"),
                       GetSQLValueString($_POST['textfield7'], "text"),
                       GetSQLValueString($_POST['textfield8'], "text"),
                       GetSQLValueString($_POST['textfield9'], "text"),
                       GetSQLValueString($_POST['textfield10'], "text"),
                       GetSQLValueString($_POST['hiddenField'], "int"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($updateSQL, $connect) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['sid'])) {
  $colname_Recordset1 = $_GET['sid'];
}
mysql_select_db($database_connect, $connect);
$query_Recordset1 = sprintf("SELECT * FROM Site WHERE s_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>實施點 客戶資料編修</title>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <p>客戶名稱：
    <label for="textfield"></label>
    <input name="textfield" type="text" id="textfield" value="<?php echo $row_Recordset1['s_name']; ?>" size="60" />
  </p>
  <p>緯度:
    <label for="textfield2"></label>
    <input name="textfield2" type="text" id="textfield2" value="<?php echo $row_Recordset1['s_lat']; ?>" />
  </p>
  <p> 經度:
    <input name="textfield3" type="text" id="textfield3" value="<?php echo $row_Recordset1['s_lon']; ?>" />
  </p>
  <p> 登記住址:
    <input name="textfield4" type="text" id="textfield4" value="<?php echo $row_Recordset1['s_addr1']; ?>" size="70" />
  </p>
  <p> 實際住址:
    <input name="textfield5" type="text" id="textfield5" value="<?php echo $row_Recordset1['s_addr2']; ?>" size="70" />
  </p>
  <p> 電話:
    <input name="textfield6" type="text" id="textfield6" value="<?php echo $row_Recordset1['s_tel1']; ?>" />
  </p>
  <p> 電話二:
    <input name="textfield7" type="text" id="textfield7" value="<?php echo $row_Recordset1['s_tel2']; ?>" />
  </p>
  <p> 傳真:
    <input name="textfield8" type="text" id="textfield8" value="<?php echo $row_Recordset1['s_fax']; ?>" />
  </p>
  <p> 聯絡人:
    <input name="textfield9" type="text" id="textfield9" value="<?php echo $row_Recordset1['s_contact']; ?>" />
  </p>
  <p> 聯絡人手機:
    <input name="textfield10" type="text" id="textfield10" value="<?php echo $row_Recordset1['s_mobile']; ?>" />
  </p>
  <p>
    <input type="reset" name="button" id="button" value="重設" />
    <input type="submit" name="button2" id="button2" value="送出" />
  </p>
  <p>
    <input name="hiddenField" type="hidden" id="hiddenField" value="<?php echo $row_Recordset1['s_id']; ?>" />
  </p>
  <p><a href="index.php" target="_self">回到主頁</a></p>
  <p>&nbsp;</p>
<input type="hidden" name="MM_update" value="form1" />
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
