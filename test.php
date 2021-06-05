<?php
// function spriter($files) {
//     //function Generate Sprite
//   $width = 0;
//   $imgwidth = 30;
//   $imgheight = 30;
//   foreach ($files as $file) {
//       $width += $imgwidth;
//   }

//   $dest = imagecreatetruecolor($width, $imgheight);

//   $pos = 0;
//   foreach ($files as $file){
//     $source = imagecreatefrompng($file);
    
//     imagecopy($dest, $source, $pos, 0, 0, 0, $imgwidth, $imgheight);

//     $pos += $imgwidth;
//     }
//       imagepng($dest,"sprite.png");

    //function Generate Css
      $fichier = fopen('style.css', "c");
//     fwrite($fichier, "html{\nposition: relative;\nheight: 30px;\nwidth: 30px;\n}\n.image{\nbackground: url('sprite.png') no-repeat;\nwidth:100vw;\nheight: 30px;\nleft: 0;\ntop: 0;\n}\n");
//     fclose($fichier);
//      foreach ($files as $key => $file){
//         $key1 = $key+1;
//         $clip -= 30;
//         $fichier = 'style.css';
//         $content = ".image-".$key1."{\nposition: absolute;\nbackground: url('sprite.png') no-repeat;\nwidth:100%;\nheight: 30px;\nleft: 0;\ntop: 0;\nbackground-position: ".$clip."px;\n}\n";
//         file_put_contents($fichier,$content,FILE_APPEND);
//     }
    
//   }
// spriter(glob("*.png"));

// # Les sprites permettent de réduire le temps de chargement d'une page en concatenant plusieurs image en une.
// # + optimisation car - requete, pas besoin de onmouseover js
// // $first = imagecreatefrompng("img/playstation.png");
// // $second = imagecreatefrompng("img/xbox.png");
//     // $test = implode(" ",$argv);
// //     foreach($argv as $file){
// //         if (file_exists($file)){
// //             var_dump($file);
// //             echo "not a directory";
// //         }else{
// //         echo "it's a dir$file";
// //     }
// // }
// function my_merge_image($first,$second){
//     // for($i=0;$i<60;$i+=30){
//     //     $fond = imagecreate(60+$i,30);
//     // }
//     $fond = imagecreate(imagesx($first) + imagesx($second), imagesy($second));
//     imagecopymerge($fond, $first, 30, 0, 0, 0, imagesx($first), imagesy($first), 50);
//     imagecopymerge($fond, $second, 0, 0, 0, 0, imagesx($second), imagesy($second), 50);
//     header('Content-Type: image/png'); 
//     imagepng($fond);
// }
// // my_merge_image($first,$second);

// function mytest($argc,$argv,$dir_path){
//     $images = array_shift($argv);
//     if ($argc > 1) {
//         $width = 30;
//         foreach($argv as $value){
//            echo $value;
//           }
// 	}else {
// 		echo "Veuillez insérer les images à sprite";
// 	}
// }
// mytest($argc,$argv);
$secondlast = array_slice($argv,-2,1);

var_dump(implode(" ",$secondlast));
