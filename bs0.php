<?php
# Les sprites permettent de réduire le temps de chargement d'une page en concatenant plusieurs image en une.
# + optimisation car - requete, pas besoin de onmouseover js
$first = imagecreatefrompng("img/playstation.png");
$second = imagecreatefrompng("img/xbox.png");
function my_merge_image($first,$second){
    $fond = imagecreate(65,30);
    imagecopymerge($fond, $first, 30, 0, 0, 0, 300, 500, 100);
    imagecopymerge($fond, $second, 0, 0, 0, 0, 300, 500, 50);
    header('Content-Type: image/png'); 
    imagepng($fond);
}
my_merge_image($first,$second);