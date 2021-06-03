<?php
# Les sprites permettent de réduire le temps de chargement d'une page en concatenant plusieurs image en une.
# + optimisation car - requete, pas besoin de onmouseover js
// $first = imagecreatefrompng("img/playstation.png");
// $second = imagecreatefrompng("img/xbox.png");

function my_merge_image($first,$second){
    // for($i=0;$i<60;$i+=30){
    //     $fond = imagecreate(60+$i,30);
    // }
    $fond = imagecreate(imagesx($first) + imagesx($second), imagesy($second));
    imagecopymerge($fond, $first, 30, 0, 0, 0, imagesx($first), imagesy($first), 50);
    imagecopymerge($fond, $second, 0, 0, 0, 0, imagesx($second), imagesy($second), 50);
    header('Content-Type: image/png'); 
    imagepng($fond);
}
// my_merge_image($first,$second);

function mytest($argc,$argv,$dir_path){
    $images = array_shift($argv);
    if ($argc > 1) {
        $width = 30;
        foreach($argv as $value){
           echo $value;
          }
	}else {
		echo "Veuillez insérer les images à sprite";
	}
}
// mytest($argc,$argv);
require "test.php";
function my_scandir($argv){
    array_shift($argv);
    // $test = implode(" ",$argv);
//     foreach($argv as $file){
//         if (file_exists($file)){
//             var_dump($file);
//             echo "not a directory";
//         }else{
//         echo "it's a dir$file";
//     }
// }
    $dossier = implode(" ",$argv);
    if($dossier == "."){ 
        $dir = opendir(implode(" ",$argv));
        $array = [];
            while(($file = readdir($dir)) !== false) 
        {  
        if (substr($file,-3) == "png"){
            array_push($array,$file);
        }
        }
        print_r($array);
        
        closedir($dir);
    }else{
        echo implode(' ',$argv)." ont été fusionné dans $i";
    }
}
my_scandir($argv);
