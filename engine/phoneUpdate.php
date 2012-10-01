<?php

	include_once ("dbOperations.php");
	$query = "TRUNCATE TABLE `phones`";
	mysql_query($query);
	
	for ($i=1; $i<4; $i++)
	{
	
		$pagelocation ="http://2255757.ru/numbers/numbers_".$i.".php";
		$file = file_get_contents($pagelocation);
		$file = unserialize(base64_decode($file));
		
		if(is_array($file) && count($file) != 0)
		foreach($file as $key => $_file)
		{
			$number               = preg_replace("@[^0-9/-]+@i", '', $_file[0]);
			$numberint           = preg_replace("@[^0-9]+@i", '', $_file[0]);
			$cost                      = $_file[1];
			$typeOfNumber         = $_file[2];
			$reconstructed     = $_file[3];
			$agency            = $_file[4];
			$_c[$cost]              = $cost;
			$query = "INSERT INTO `phones` (`operator`, `number`, `numberint`, `cost`, `typeOfNumber`, `reconstructed`, `agency`) VALUES ('".$i."', '".$number."', '".$numberint."', '".$cost."', '".$typeOfNumber."', '".$reconstructed."', '".$agency."')";
			print $query."<br>";
			mysql_query($query);
		}
	}
?>