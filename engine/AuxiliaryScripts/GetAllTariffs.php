<?php
	include ("../dbOperations.php");
	
	/////////////////////////
	//OLD PRINT MEGAFON TARIFFS//
	/////////////////////////
	/*$getData = mysql_query($select_all_megafon_tariffs_preview);
	$quantity = mysql_num_rows($getData);
	print "<table>";
	print "<tr>";
	print "<td> Раздел </td><td> Подраздел </td>";
	for ($j=0; $j<13; $j++)
		print "<td> ".mysql_result($getData, $i+143*$j, 'th.name')."</td>";
		
	print "</tr>\n";
	for ($i=0; $i<143; $i++)
	{
		print "<tr>";
		print "<td> ".mysql_result($getData, $i, 's.name')."</td><td> ".mysql_result($getData, $i, 'ss.name')."</td>";
		for ($j=0; $j<13; $j++)
			print "<td> ".mysql_result($getData, $i+143*$j, 't.name')."</td>";
			
		print "</tr>\n";
	}
	print "</table>";*/
	
	/////////////////////
	//OLD PRINT MTS TARIFFS//
	/////////////////////
	/*$getData = mysql_query($select_all_mts_tariffs_preview);
	$quantity = mysql_num_rows($getData);
	print "<table>";
	print "<tr>";
	print "<td> Раздел </td><td> Подраздел </td>";
	for ($j=0; $j<13; $j++)
		print "<td> ".mysql_result($getData, $i+193*$j, 'th.name')."</td>";
		
	print "</tr>\n";
	for ($i=0; $i<193; $i++)
	{
		print "<tr>";
		print "<td> ".mysql_result($getData, $i, 's.name')."</td><td> ".mysql_result($getData, $i, 'ss.name')."</td>";
		for ($j=0; $j<13; $j++)
			print "<td> ".mysql_result($getData, $i+193*$j, 't.name')."</td>";
			
		print "</tr>\n";
	}
	print "</table>";*/
	
	/////////////////////////
	//OLD PRINT BEELINE TARIFFS//
	/////////////////////////
	/*$getData = mysql_query($select_all_beeline_tariffs_preview);
	$quantity = mysql_num_rows($getData);
	print "<table>";
	print "<tr>";
	print "<td> Раздел </td><td> Подраздел </td>";
	for ($j=0; $j<12; $j++)
		print "<td> ".mysql_result($getData, $i+63*$j, 'th.name')."</td>";
		
	print "</tr>\n";
	for ($i=0; $i<63; $i++)
	{
		print "<tr>";
		print "<td> ".mysql_result($getData, $i, 's.name')."</td><td> ".mysql_result($getData, $i, 'ss.name')."</td>";
		for ($j=0; $j<12; $j++)
			print "<td> ".mysql_result($getData, $i+63*$j, 't.name')."</td>";
			
		print "</tr>\n";
	}
	print "</table>";*/
	
	
	/////////////////////
	//PRINT ALL TARIFFS//
	/////////////////////
	$result = mysql_query($select_all_tariffs);
	$quantity = mysql_num_rows($result);
	print "<table>";
	print "<tr>";
	print "<td> Раздел </td><td> Подраздел </td>";
	for ($j=0; $j<30; $j++)
		print "<td> ".mysql_result($result, $i+348*$j, 'th.name')."</td>";
		
	print "</tr>\n";
	for ($i=0; $i<348; $i++)
	{
		print "<tr>";
		print "<td> ".mysql_result($result, $i, 'ts.name')."</td><td> ".mysql_result($result, $i, 'tss.name')."</td>";
		for ($j=0; $j<30; $j++)
			print "<td> ".mysql_result($result, $i+348*$j, 'tf.name')."</td>";
			
		print "</tr>\n";
	}
	print "</table>";


?>