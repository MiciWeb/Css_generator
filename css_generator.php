<?php
// // 2eme nom
// // oe bof zehma tu met le nom de l'image et ca recup le fichierc precis
// // recursive if sans argv

// function generate_sprite($array){
//     $sprite_name = "sprite.png";
//     $style_name = 'style.css';
//     // option -i du man
//     if (in_array("-i",$array) ){

//         $array_i = array_search("-i",$array);

//         $sprite_name = $array[$array_i +1];

//         unset($array[$array_i]);
//         unset($array[$array_i +1]);
//         // unset spritename direct 
//       }

//     // option -s du man
//     if(in_array("-s",$array)){
//         $array_i = array_search("-s",$array);

//         $style_name = $array[$array_i +1];

//         unset($array[$array_i]);
//         unset($array[$array_i +1]);

//     }

//     // on attribut les largeur et hauteur des pictures a nos variables
//     foreach($array as $picture){
//         $source = imagecreatefrompng($picture);
//         $imgwidth = imagesx($source);
//         $imgheight = imagesy($source); 
//     }

//     $sprite_width = 0;
//     $sprite_height = $imgheight;

    
//     // génére le fichier sprite //

   

//         // crée des carrés vide "$destination" ou l'on va coller chaque image "$source" bout à bout
//         foreach ($array as $picture) {
//             $sprite_width += $imgwidth;
//         }
//         $destination = imagecreatetruecolor($sprite_width, $sprite_height);

//         $pos = 0;

//         foreach($array as $picture){   
//             $source = imagecreatefrompng($picture);         
//             imagecopy($destination, $source, $pos, 0, 0, 0, $imgwidth, $imgheight);
    
//             $pos += $imgwidth;
//         }
    
//         // crée le fichier final sprite
//         imagepng($destination,$sprite_name);
    
//     // génére le fichier style //


//         // ajoute la partie html et la class du sprite généré dans le fichier style
//         $fichier = fopen($style_name, "c");
//         fwrite($fichier, "html{
//             \nposition: relative;
//             \nheight: ".$imgheight."px;
//             \nwidth: ".$imgwidth."px;\n}
//             \n.image{
//             \nbackground: url('".$sprite_name."') no-repeat;
//             \nwidth:100vw;\nheight: ".$imgheight."px;
//             \nleft: 0;
//             \ntop: 0;
//             \n}
//             \n");

//         // crée une balise class pour chaque images données en paramètre
//         $position_array=[];
//         if (array_key_first($array) == 4){
//             $fix_key_bug = array_reverse($array);
           
//             fwrite($fichier, "
//             .image-1{\nposition: absolute;
//                 \nbackground: url('".$sprite_name."') no-repeat;
//                 \nwidth:100%;
//                 \nheight: ".$imgheight."px;
//                 \nleft: 0;
//                 \ntop: 0;
//                 \nbackground-position: 0px;\n}\n");

//             fclose($fichier);

//             array_shift($fix_key_bug);
//             foreach($fix_key_bug as $key => $file){
//                 $key1 = $key+2;
//                 $clip -= $imgwidth;
//                 var_dump($key1);

//                 $content = ".image-".$key1."{
//                     \nposition: absolute;
//                     \nbackground: url('".$sprite_name."') no-repeat;
//                     \nwidth:100%;\nheight: ".$imgheight."px;
//                     \nleft: 0;
//                     \ntop: 0;
//                     \nbackground-position: ".$clip."px;\n}\n";
//                 file_put_contents($style_name,$content,FILE_APPEND);

//             }

//         }else{
//             // array_push($position_array,$clip);
//             // array_unshift($position_array,0);
//             // $array_int = implode(',',$position_array);
            
//             fwrite($fichier, "
//             .image-1{\nposition: absolute;
//                 \nbackground: url('".$sprite_name."') no-repeat;
//                 \nwidth:100%;
//                 \nheight: ".$imgheight."px;
//                 \nleft: 0;
//                 \ntop: 0;
//                 \nbackground-position: 0px;\n}\n");
//             fclose($fichier);
//             array_shift($array);
//             foreach ($array as $key => $file){
//                 $key1 = $key +2;
//                 $clip -= $imgwidth;
//                 var_dump($key1);
//                 $content = ".image-".$key1."{
//                     \nposition: absolute;
//                     \nbackground: url('".$sprite_name."') no-repeat;
//                     \nwidth:100%;\nheight: ".$imgheight."px;
//                     \nleft: 0;
//                     \ntop: 0;
//                     \nbackground-position: ".$clip."px;\n}\n";
//                 file_put_contents($style_name,$content,FILE_APPEND);
//             }
//         }
    
// }



function my_scan_dir($argv){
    global $array;
    array_shift($argv);
    
    // option -r recursive
    if(in_array("-r",$argv) and is_dir(implode(" ",$argv))){

        // si on trouve -r on le supprime
        $array_r = array_search("-r",$argv);
        unset($argv[$array_r]);

        // transforme l'array argv en string
        $dir_path = [];
        array_push($dir_path,implode(" ",$argv));
        $dir_path_string = implode(' ',$dir_path);
        $array = [];

        my_recursive($dir_path_string);

    }elseif(is_dir(implode(" ",$argv))){

        $dh = opendir(implode(" ",$argv));
        $array = [];
            while(($files = readdir($dh)) !== false){
                if (substr($files,-3) == "png"){
                    array_push($array,$files);
                    echo $files;
                    echo "dir";
                }
            }

            $array_rev = array_merge($array,array_slice(array_reverse(implode(" ",$argv)),1));
            $array = array_reverse($array_rev);

        closedir($dh);
    }

}
my_scan_dir($argv);

function my_recursive($dir_path_string){
    global $array;
   if ($dh = opendir($dir_path_string)){
        while (($file = readdir($dh)) !== false){
            if ($file !== "." AND $file !== ".." AND $file !== ".git"){
                if (is_dir($dir_path_string.$file)){
                    my_recursive($dir_path_string.$file."/");
                    
                } elseif(substr($file,-3) == "png"){
                    array_push($array,$file);
                    // $array = array_merge($array_r,explode(" ",$dir_path_string.$file));

                }
        }
    }
    closedir($dh);
    }
}
function test($mdr){
    global $array;
    foreach($array as $value){
        echo $value."\n";
    }
}
test("mdr");


// function my_scan_dir($dir_path){
//     array_shift($argv);
//     if(is_dir($argv)){ 
//             $argvpoint = array_search(".",$argv);
//             $dir = opendir($arraypoint = $argv[$argvpoint]);
//             $arraypng = [];
//                 while(($files = readdir($dir)) !== false){
//                     if (substr($files,-3) == "png"){
//                         array_push($arraypng,$files);
//                         echo $files;
//                         echo "dir";
//                     }
//                 }

//                 $array_rev = array_merge($arraypng,array_slice(array_reverse($argv),1));
//                 $array = array_reverse($array_rev);

//             closedir($dir);
//     }else{
//         $array = [];
//         foreach($argv as $files){
//             array_push($array,$files);
//             echo "files";
//         }
//     }
//     // generate_sprite($array);
// }
// my_scan_dir($dir_path);