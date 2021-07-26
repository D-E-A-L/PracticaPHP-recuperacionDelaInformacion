<?php
$resul = array('hermaniribeiro', 'Ebtsama', 'BrittoOFC', 'CheesterG', 'dsolutec', 'ExpoGanSon', 'dsolutec', 'ExpoGanSon', 'dsolutec', 'BelforFx', 'kunakrec', 'YouTube', 'Dasabuvir', 'greentechmedia', 'bardomsw', 'MdeMotion', 'iAnonymous', 'WilliamCorvera', 'MadridVen', 'Bertty17', 'SoyBobMarley', 'joseapontefelip', 'la_patilla', 'hootsuite', 'fawkestar70', 'starwars');

$file = fopen("regContenidoPag.txt", "a");
foreach($resul as $final){
fwrite($file, PHP_EOL ."$final");
}
 fclose($file);
?>