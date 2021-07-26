<?php
	require 'simple_html_dom.php';
	$contenido = file_get_html('http://www.lostiempos.com')->plaintext; 

	echo $contenido;
?>