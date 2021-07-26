<DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<img src="../img/BusquedasCholoVectorial.png" height="150px" width="400px"><br>
	<?php
		require 'simple_html_dom.php';
		require 'administrar.php';
        
		//v = $_POST["cb1"];

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

		function regbd($ruta)
		{
			$array = regPag($ruta);
			for($i=0;$i<sizeof($array);$i++)
			{
				$contenido = trim((file_get_html($array[$i])->plaintext)," "); 
				registrar($array[$i],$contenido);
			}
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
	    		return 1;
	    	}
	    	else 
		    {
	        	return 0;
		    }
		}

		function buscarPalabra($palabra, $texto)
		{
			$res=substr_count($texto, $palabra);
			if($res>0)
			{
				return $res;
			}
			else
			{
				return $res=0;
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

		function sumarBusqueda($e)//entrada un arreglo de las palabras a buscar
		{
			$array=array(); 
			$enlace=getEnlace();
			for($i=0;$i<sizeof($e);$i++)
			{
				//$pBuscar = $e[$i];
				for($j=0;$j<sizeof($enlace);$j++)
				{
					$array[$e[$i]][]=buscarPalabra($e[$i],implode(getContenido($enlace[$j])));
				}
			}
			return $array;
		}

		function sumatoriaBusqueda($palabraBuscada)//entrada un arreglo de las palabras a buscar
		{
			$array=sumarBusqueda($palabraBuscada);
			$suma = 0;
			$arreglo1=array();
			for($i=0;$i<sizeof($palabraBuscada);$i++)
			{
				for($j=0;$j<sizeof($array[$palabraBuscada[$i]]);$j++)
				{
					$suma=$suma+$array[$palabraBuscada[$i]][$j];
				}$arreglo1[$palabraBuscada[$i]][]=$suma;
			}
			return $arreglo1;
		}

		function matrizConFormula($e, $sumatoriaBusqueda)//entrada un arreglo de las palabras a buscar, y un arreglo de la sumatoria de los valores de las palabras encontradas
		{
			$array=array(); 
			$enlace=getEnlace();
			$resFormula=0;
			$cantDoc=getCantEnlace();
			for($i=0;$i<sizeof($e);$i++)
			{
				//$pBuscar = $e[$i];
				for($j=0;$j<sizeof($enlace);$j++)
				{
					$comprobacion = buscarPalabra($e[$i],implode(getContenido($enlace[$j])));
					if($comprobacion>0)
					{
						$resFormula = abs($sumatoriaBusqueda[$e[$i]][0]*log($cantDoc/$comprobacion));
					}
					elseif ($comprobacion ==0)
					{
						$resFormula=0;
					}

					$array[$e[$i]][]=$resFormula;
				}
			}
			return $array;
		}

		function primeraVerificacion($palabra)//resultado con el operador OR
		{
			$arregloPalabrasBuscadas=separarPalabra($palabra);
			$enlace=getEnlace();			
			$Lista2resultado=matrizConFormula($arregloPalabrasBuscadas,sumatoriaBusqueda($arregloPalabrasBuscadas));
			for($i = 0; $i < sizeof($arregloPalabrasBuscadas); $i++)
			{	
				for($j = 0; $j < sizeof($Lista2resultado[$arregloPalabrasBuscadas[$i]]); $j++)
				{
					if($Lista2resultado[$arregloPalabrasBuscadas[$i]][$j] > 0)
					{
						echo "<b><a href=".$enlace[$j].">".$arregloPalabrasBuscadas[$i]."</a><br>";
						echo $enlace[$j]."<br><br>";
					}
				}
			}
		}

		function segundaVerificacion($palabra)//resultado con el operador AND
		{
			$arregloPalabrasBuscadas=separarPalabra($palabra);
			$enlace=getEnlace();			
			$Lista2resultado=matrizConFormula($arregloPalabrasBuscadas,sumatoriaBusqueda($arregloPalabrasBuscadas));
			for($i = 0; $i < sizeof($arregloPalabrasBuscadas); $i++)
			{	
				for($j = 0; $j < sizeof($Lista2resultado[$arregloPalabrasBuscadas[$i]]); $j++)
				{
					if(($Lista2resultado[$arregloPalabrasBuscadas[$i]][$j] > 0) && ($Lista2resultado[$arregloPalabrasBuscadas[$i]][$j] > 0))
					{
						echo "<b><a href=".$enlace[$j].">".$arregloPalabrasBuscadas[$i]."</a><br>";
						echo $enlace[$j]."<br><br>";
					}
				}
			}
		}

		function modeloVectorial($palabras)
		{
			primeraVerificacion($palabras);
			//segundaVerificacion($palabras);
		}



		/*echo "<br><br><br>";
		//$b=implode(getContenido());
		$array=sumarBusqueda(separarPalabra("hola animal"));
		$a=sumatoriaBusqueda(separarPalabra("hola animal"));
		$cc=matrizConFormula(separarPalabra("hola animal"),$a);
		var_dump($array);
		echo "<br>";
		var_dump($a);
		echo "<br>";
		var_dump($cc);
		echo "<br>";*/
		print_r(file_get_html("http://www.lavanguardia.com/natural/20180312/441448325068/animales-granja-abejas-perros-mas-humanos-matan-ano.html"));
	?>
</body>
</html>