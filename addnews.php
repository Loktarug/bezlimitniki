<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
$link = mysql_connect('brokin.mysql','brokin_mysql','e7bukieg');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db_selected = mysql_select_db('brokin_mbeem');
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}


?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="description" content="<?php echo $description;?>"/>
<meta name="keywords" content="<?php echo $keywords;?>"/>

<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	window.onload = function()
	{
		CKEDITOR.replace( 'editor1' );
	};
</script>



</head>
<body>
<form action="addnews.php" method="post">

<?php
if (!$_REQUEST['step'])
{	$selectAllNews=mysql_query("SELECT * FROM `news` WHERE `id`>0");
?>
	<select size="1" name="idnews">
<?php
	for ($i=0; $i<mysql_num_rows($selectAllNews); $i++)
	{
?>
  			<option value="<?php echo mysql_result($selectAllNews,$i,'id');?>"><?php echo mysql_result($selectAllNews,$i,'name');?></option>


<?php
	}
?>
	</select><br>
	<input name="step" type="hidden" value="1">
	<input name="update" type="submit" value="Обновить"><br>
	<input name="addnew" type="submit" value="Добавить новую НОВОСТЬ!!!!! КХЕ КХЕ ВЫ КАКАШКИ!!!!">
<?php
}
elseif($_REQUEST['step']==1)
{	if ($_REQUEST['update'])
	{
		$dataNews=mysql_query("SELECT * FROM `news` WHERE id=".$_REQUEST['idnews']);
?>
		<input name="idnews" type="hidden" value="<?php echo $_REQUEST['idnews']; ?>">
		<input name="name" type="text" value="<?php echo mysql_result($dataNews,0,'name'); ?>"><br>
		<textarea name="editor1"><?php echo mysql_result($dataNews,0,'news'); ?></textarea><br>
		<input name="step" type="hidden" value="2">
		<input name="update" type="submit" value="Обновить">


<?php
	}
	elseif ($_REQUEST['addnew'])
	{
?>
		<input name="name" type="text" value=""><br>
		<textarea name="editor1"></textarea><br>
		<input name="step" type="hidden" value="2">
		<input name="addnew" type="submit" value="Добавить">


<?php
	}
}
elseif ($_REQUEST['step']==2)
{	if ($_REQUEST['update'])
	{
		mysql_query("UPDATE `news` SET `name`='".$_REQUEST['name']."', `news`='".$_REQUEST['editor1']."' WHERE id=".$_REQUEST['idnews']);
	}
	elseif ($_REQUEST['addnew'])
	{
		mysql_query("INSERT INTO  `news` (`name` ,`news`) VALUES ('".$_REQUEST['name']."', '".$_REQUEST['editor1']."')");
		echo "INSERT INTO  `news` (`name` ,`news`) VALUES ('".$_REQUEST['name']."', '".$_REQUEST['editor1']."')";
	}
}

?>

</form>


</body>
</html>
