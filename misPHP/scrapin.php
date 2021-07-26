<?php
require "simple_html_dom.php";

$url = "https://stackoverflow.com/questions/3399960/simple-php-screen-scraping-function";

$html= file_get_html( $url );
$posts = $html->find("body");
print_r($posts);

foreach ($spots as $post) 
{
    $link = $psot->find("div ", 0);
    $url  = $link ->attr ["href"];
    $title = $link->innertext;

    $imagen = $post -> find("div[class=post-body] img", 0)->attr["src"];

    echo $tittle."\n".$url."\n".$imagen."\n\n";
}*
/*preg_match_all("|<[^>]+>(.*)</[^>]+>|U",
    "<b>ejemplo: </b><div align=\"left\">esto es una prueba</div>",
    $salida, PREG_SET_ORDER);
echo $salida[0][0] . ", " . $salida[1][0] . "\n";
echo $salida[0][1] . ", " . $salida[1][1] . "\n";*/

/*function Obtener_contenidos($url,$inicio='',$final){
$source = @file_get_contents($url)or die('se ha producido un error');
$posicion_inicio = strpos($source, $inicio) ;
$posicion_final = strpos($source, $final) ;
$found_text = substr($source, $posicion_inicio, $posicion_final);
return $inicio . $found_text .$final;
}
$url = 'http://www.lostiempos.com'; /// pagina web del contenido
echo Obtener_contenidos($url,'<body ','</body>');
// Obtener_contenidos(url,ancla inicio,ancla final);
/*$url = "http://www.lostiempos.com";
$html = file_get_contents($url);

preg_match_all('/<body </body>/', $html, $matches);

print_r($matches);*/

/*function fetchHTML( $url )
  {

  $content = file_get_contents($url);

  $html=new DomDocument();
  $body=$html->getelementsbytagname('body');
  foreach($body as $b)
  {
    $content=$b->textContent;
    break; 
  }//hmm, is there a better way to do that?
  return $content;
}*/

//echo fetchHTML("https://stackoverflow.com/questions/3399960/simple-php-screen-scraping-function");


?>