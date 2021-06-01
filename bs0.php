<?php
# Les sprites permettent de réduire le temps de chargement d'une page en concatenant plusieurs image en une.
# + optimisation car - requete, pas besoin de onmouseover js
$first = imagecreatefrompng("img/playstation.png");
$second = imagecreatefrompng("img/xbox.png");
function my_merge_image($first,$second){
    // $fond = imagecreate(500,300);
    // imagecopymerge($fond, $first, 0, 0, 0, 0, 300, 500, 30);
    imagecopymerge($first, $second, 0, 0, 0, 0, 300, 500, 50);
    header('Content-Type: image/png'); 
    imagepng($first,"image.png");
}
my_merge_image($first,$second);
