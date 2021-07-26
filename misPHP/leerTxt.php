<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<?php
		function contar($txt)
		{
			//$a =array();
			$c = 0;
			$file = fopen($txt, "r")/* or exit("Unable to open file!")*/;
			while(!feof($file))
			{
				//echo fgets($file)."<br><hr>";	
				fgets($file);
				$c++;			
				//$arreglo[$c] = (Srting)(fgets($file));
				//$c++;
			}
			fclose($file);echo $c;
		}
		
		echo contar("coleccionPaginas.txt")."<br><hr>";
		echo fgets(fopen("coleccionPaginas.txt", "r"))."<br><hr>";
		//echo strlen(fgets(fopen("coleccionPaginas.txt", "r")))."<br><hr>";
		$a = strlen(fgets(fopen("coleccionPaginas.txt", "r")))-2;
		echo $a."<br><hr>";
		//echo "<br><hr>".regArr("coleccionPaginas.txt")."<br><hr>";
	?>
</body>
</html>