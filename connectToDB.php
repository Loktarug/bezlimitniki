<?php
$link = mysql_pconnect('ibolit.mysql','ibolit_mysql','2d7yzjjz') or die('Could not connect: ' . mysql_error());

if (!$link)
{
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db('ibolit_db');
if (!$db_selected)
{
    die ('Can\'t use foo : ' . mysql_error());
}
?>