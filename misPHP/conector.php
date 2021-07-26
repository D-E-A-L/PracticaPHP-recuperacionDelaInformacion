<?php
	function conectar()
	{
		$host="localhost";
		$uss="root";
		$pass="";
		$db="recu";
		mysql_connect($host,$uss,$pass);
		mysql_select_db($db); 
		/*if (mysql_errno()) 
		{
	    	echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error."<br>";
	    }
	    else
	    {
	    	echo "conectado con exito"."<br>";
	    }*/
	}

?>