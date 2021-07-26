<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<?php

		set_time_limit(300);
        $nombreArchivo = "";		
 
		function buscarEnArchivos($path, $cadenaBuscar)
		{
            /*$diccPala = array();
            $valor=0;*/
    		$d=dir($path);
    		# recorremos todo el directorio
    		while (false !== ($archivo = $d->read()))
    		{
        # revisamos que sea un archivo y no una carpeta o archivo de sistema
        		if($archivo!="." && $archivo!="..")
        		{
            		if(is_dir($path.$archivo))
            		{
                		buscarEnArchivos($path.$archivo."/", $cadenaBuscar);//buscar en todas las subcarpetas
            		}
            		elseif(mime_content_type($path.$archivo)=="text/html")//Si el archivo es del tipo text/html para buscar en su interior
            		{
                		$contenido=strtolower(file_get_contents($path.$archivo));//contenido del archivo
                # revisamos si existe la palabra a buscar en el contenido del archivo
                		if(strpos($contenido, $cadenaBuscar)!==false)
                		{
                    		echo "se ha encontrado la palabra '".$cadenaBuscar."' en el archivo <strong>".$archivo."</strong><br>";
                            /*$dicPala = array(
                                $cadenaBuscar => );
                            $nombreArchivo = $archivo;
                            return $valor=1;*/
                		}//$dicPala = array($cadenaBuscar => , valor);
            		}
        		}
    		}
    	$d->close();
	}
	?>
</body>
</html>