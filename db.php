<?php
mysql_connect('brokin.mysql','brokin_mysql','e7bukieg');
mysql_select_db('brokin_insurance');
$num=2;
for ($i=144; $i<1800; $i+=143)
{	for ($j=$i; $j<$i+143; $j++)
	{
		$update="UPDATE `tarrifs` SET `idTarrif` = '".$num."' WHERE `id`=".$j;
		echo $update.";<br>";
		mysql_query($update);
	}
	$num++;
}


?>