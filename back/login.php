<?php
	$c = mysqli_connect("localhost","root","");
	if($c)
	{
		mysqli_select_db($c,"event_db");
		$a = "insert into userlogin values('naman','Admin123')";
		if(mysqli_query($c,$a))
		{
			echo"Row inserted...";
		}
		else
		{
			echo mysqli_error($c);
		}
	}
?>