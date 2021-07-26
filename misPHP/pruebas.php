<?php
	require 'simple_html_dom.php';
		require 'administrar.php';

		$html = file_get_contents("https://es.wikipedia.org/wiki/Wikipedia:Portada");
		//$html = file_get_contents("https://es.wikipedia.org/wiki/Wikipedia:Portada");

//Generar el DOM
$dom = new DOMDocument;

$dom->loadHTML($html, LIBXML_COMPACT | LIBXML_HTML_NOIMPLIED | LIBXML_NONET);

//Obtener todos los tags <B>
$b_nodelist = $dom->getElementsByTagName('body');

//Bucle para cada <b>
foreach ($b_nodelist as $b) 
{

    //Obtener el contenido de texto del tag
    $texto = $b->textContent;
    echo $texto;

    //echo "\n\nContenido del B:\n" . $texto;    // => contenido
}
//echo trim((file_get_html("https://es.wikipedia.org/wiki/Wikipedia:Portada")->plaintext)," "); 

//evitar problemas de codificación
        /*header('Content-Type: text/html; charset=utf-8');   
        // la url
        $urlCT = "https://es.wikipedia.org/wiki/Wikipedia:Portada";
        
        $ch = curl_init($urlCT);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $cl = curl_exec($ch);
        
        // Los elementos Dom de la página que vas a reccorrer
        $dom = new DOMDocument();
        @$dom->loadHTML($cl);
        
        // La ruta del elemento
        $xpath = new DOMXpath($dom); */


?>