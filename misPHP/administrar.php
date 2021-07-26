<?php
	//require 'simple_html_dom.php';
	require 'conector.php';

	function registrar($link, $contenido)
	{
		conectar();
		mysql_query("INSERT INTO recuperacion(enlace,contenido) values ('$link','$contenido')");
		if (mysql_errno()) 
		{
	    	echo "No puede registrar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error."<br>";
	    }
	    else
	    {
	    	echo "Registrado con exito<br>";
	    }
	}

	function registrarContenido($link, $contenido)
	{
		conectar();
		mysql_query("INSERT INTO recuperacion(enlace,contenido) values ('$link','$contenido')");
	}

	function getContenido($link)
	{
		conectar();
		$fila=mysql_fetch_assoc(mysql_query("SELECT contenido FROM recuperacion WHERE enlace='$link'"));
		if (mysql_errno()) 
		{
	    	echo "No puede reguperar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	    }
	    else
	    {
	    	//echo "Recuperado con exito<br>";
	    	//$res=implode($fila);
	    	return $fila;
	    }
	}

	function getCantEnlace()
	{
		conectar();
		$fila=mysql_fetch_assoc(mysql_query("SELECT count(enlace) FROM recuperacion"));
		$contar = (Integer)implode($fila);
		return $contar;
	}


	function getLista2Enlace()
	{
		 conectar();
		 $array=array();
		 $consulta=mysql_query("SELECT enlace FROM recuperacion");
		 for($i=0;$i<getCantEnlace();$i++)
		 {
		 	$array[]=mysql_fetch_row($consulta);
		 }
		return $array;
	}

	function getEnlace()
	{
		$lista2=getLista2Enlace();
		$array=array();
		for($i=0;$i<sizeof($lista2);$i++)
		{
			$array[]=$lista2[$i][0];
		}return $array;
	}
?>
