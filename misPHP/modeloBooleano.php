<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<?php

		//$b = regPag("../txt/prueba.txt");
        
		$v = $_POST["cb1"];

		function regPag($u)//registrar paginas en un arreglo
		{
			$ur = fopen($u, 'r');
			$a = array();
			$c = 0;
			while ($li = fgets($ur)) 
			{
				$a[] = $li;
				$c++;
			}
			fclose($ur);
			return $a;
		}

		function normaliza ($cadena)//normalizacion de cadena
		{
	    	$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
	    	$modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
	   	 	$cadena = utf8_decode($cadena);
	    	$cadena = strtr($cadena, utf8_decode($originales), $modificadas);
	    	$cadena = strtolower($cadena);
	    	return utf8_encode($cadena);
		}

		function buscP1($x, $a)//con el metodo preg_match
		{
			$correcion = "/".$x."/i";
			if (preg_match($correcion, $a)) 
	    	{
	    		//echo "HAY COINCIDENCIA";
	    		return 1;
	    	}
	    	else 
		    {
	        	//echo "NO HAY COINCIDENCIA";
	        	return 0;
		    }
		}

		function separarPalabra($ca)//si tiene espacios separar en un arreglo con las palabras separadas como elementos del arreglo
		{
			$arr1 = array();
			$ver = strpos($ca, " ");
			if(strpos($ca, " ") == TRUE)
			{
				$arr1 = explode(" ", $ca);
				return $arr1;
			}
			else
			{
				$arr1[]=$ca;
				return $arr1;
			}		
		}

		function cerosUnos($e, $a1)//funcion que registra el resultado binario de la sub-busqueda
		{
			set_time_limit(40);
			//$a1 = regPag("../txt/prueba.txt");
			//$a = separarPalabra($e);
			$paraResultado = array();
			//$resultado = array();
			for($i = 0; $i < sizeof($e); $i++)
			{
				$pBuscar = $e[$i];
				for($j = 0; $j < sizeof($a1); $j++)
				{				
					
					$paraResultado[$e[$i]][] = buscP1($e[$i],strip_tags(file_get_contents($a1[$j])));
				}
			}return $paraResultado;
		}

		function resultadoConO($e, $a1)//resultado con el operador OR
		{
			//$a1 = regPag("../txt/prueba.txt");
			$res = cerosUnos($e, $a1);
			//$arreglo1 = separarPalabra($e);
			for($i = 0; $i < sizeof($e); $i++)
			{	
				for($j = 0; $j < sizeof($res[$e[$i]]); $j++)
				{
					if($res[$e[$i]][$j] == 1)
					{
						echo "<b>".$e[$i]."<br>";
						echo "<a href=".$a1[$j].">".$a1[$j]."</a><br><br>";
					}
				}
			}
		}

		function resultadoConY($e,$a1)//resultado con el operador AND
		{
			//$a1 = regPag("../txt/prueba.txt");
			$res = cerosUnos($e, $a1);
			//$arreglo1 = separarPalabra($e);
			for($i = 0; $i < sizeof($e); $i++)
			{
				for($j = 0; $j < sizeof($res[$e[$i]]); $j++)
				{
					if(($res[$e[$i]][$j] == 1) && ($res[$e[$i+1]][$j] == 1))
					{
						print_r($e);
						echo "<br>";
						echo "<a href=".$a1[$j].">".$a1[$j]."</a><br><br>";
					}
				}
			}
		}

		function resultadoBooleano($e)//muestra el resultado booleano
		{
			$a1 = regPag("../txt/prueba.txt");
			//$a1 = regPag("../txt/ListaDocumentos.txt");
			$b1 = separarPalabra($e);
			//$arreglo1 = separarPalabra($e);
			//resultadoConO($b1,$a1);
			resultadoConY($b1,$a1);
		}

		/*function registrarPalabras($a)
		{
			$arreglo = array();
			$archivo = fopen("../txt/regContenidoPag.txt", "w");
			for($i=0; $i < sizeof($a); $i++)
			{
				$contenido  = explode(" ",substr((strip_tags(file_get_contents($a[$i]))),0,-500);
				//$arreglo = array($a[$i] => $contenido);
				$arreglo[$a[$i]][] = $contenido;
				fwrite($archivo, $arreglo[$a[$i]]);
			}
			echo "registrado<br>";
			fclose($archivo);
		}*/

		echo "<br><br><br>";

		resultadoBooleano($v);
		//cerosUnos("hola animal",$b);

	?>
</body>
</html>