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
  $insertSQL = sprintf("INSERT INTO Site (s_name, s_lat, s_lon, s_addr1, s_addr2, s_tel1, s_tel2, s_fax, s_contact, s_mobile) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['textfield'], "text"),
                       GetSQLValueString($_POST['textfield2'], "double"),
                       GetSQLValueString($_POST['textfield3'], "double"),
                       GetSQLValueString($_POST['textfield4'], "text"),
                       GetSQLValueString($_POST['textfield5'], "text"),
                       GetSQLValueString($_POST['textfield6'], "text"),
                       GetSQLValueString($_POST['textfield7'], "text"),
                       GetSQLValueString($_POST['textfield8'], "text"),
                       GetSQLValueString($_POST['textfield9'], "text"),
                       GetSQLValueString($_POST['textfield10'], "text"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());

  $insertGoTo = "site_add.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>實施點 客戶新增資料1</title>
<style type="text/css">
body {
	background-color: #CCC;
}
</style>
<link href="../mycss.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <p>客戶名稱：
    <label for="textfield"></label>
    <input name="textfield" type="text" id="textfield" size="60" />
  </p>
  <p>緯度:
    <label for="textfield2"></label>
    <input type="text" name="textfield2" id="textfield2" />
  </p>
  <p> 經度:
    <input type="text" name="textfield3" id="textfield3" />
  </p>
  <p> 登記住址:
    <input name="textfield4" type="text" id="textfield4" size="70" />
  </p>
  <p> 實際住址:
    <input name="textfield5" type="text" id="textfield5" size="70" />
  </p>
  <p> 電話:
    <input type="text" name="textfield6" id="textfield6" />
  </p>
  <p> 電話二:
    <input type="text" name="textfield7" id="textfield7" />
  </p>
  <p> 傳真:
    <input type="text" name="textfield8" id="textfield8" />
  </p>
  <p> 聯絡人:
    <input type="text" name="textfield9" id="textfield9" />
  </p>
  <p> 聯絡人手機:
    <input type="text" name="textfield10" id="textfield10" />
  </p>
  <p>
    <input type="reset" name="button" id="button" value="重設" />
    <input type="submit" name="button2" id="button2" value="送出" />
  </p>
  <p>&nbsp;</p>
  <p><a href="index.php" target="_self">回到主頁</a></p>
<input type="hidden" name="MM_insert" value="form1" />
</form>
</body>
</html>