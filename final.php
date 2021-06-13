<?php
function my_scan_dir($argv){
    global $array;
    global $sprite_name;
    global $style_name;
    $sprite_name = "sprite.png";
    $style_name = "style.css";
    array_shift($argv);

    // NOTE sprite name option -i --output-image
        if (in_array("-i",$argv) OR in_array("--output-image",$argv) ){
             if(in_array("-i",$argv)){
                    $array_if_option_exist = array_search("-i",$argv);
                }else{
                    $array_if_option_exist = array_search("--output-image",$argv);
                }
                // REVIEW 
                    // sélectionne l'option et le nom de l'image
                    $array_sprite_name = $argv[$array_if_option_exist +1];
                    $sprite_name = $array_sprite_name;

                    // supprime l'option et le nom de l'image
                    unset($argv[$array_if_option_exist +1]);
                    unset($argv[$array_if_option_exist]);
                }
        
    // NOTE style name option -s --output-style
        if (in_array("-s",$argv) OR in_array("--output-style",$argv) ){
             if(in_array("-s",$argv)){
                    $array_if_option_exist = array_search("-s",$argv);
                }else{
                    $array_if_option_exist = array_search("--output-style",$argv);
                }
                // REVIEW 
                    // sélectionne l'option et le nom du style
                    $array_style_name = $argv[$array_if_option_exist +1];
                    $style_name = $array_style_name;

                    // supprime l'option et le nom du style
                    unset($argv[$array_if_option_exist +1]);
                    unset($argv[$array_if_option_exist]);
                }

    // NOTE: recursive option
        if(in_array("-r",$argv) OR in_array("--recursive",$argv)){

            // REVIEW 
                //si on trouve -r ou --recursive dans l'argv on le supprime
                if(in_array("-r",$argv)){
                    $array_if_option_exist = array_search("-r",$argv);
                }else{
                    $array_if_option_exist = array_search("--recursive",$argv);
                }
                $array_without_option = end($argv);
                unset($argv[$array_if_option_exist]);
                
                var_dump($array_without_option);

            // REVIEW
                // transforme argv en string pour que la recursive marche
                $dir_path = [];
                array_push($dir_path,$array_without_option);
                $dir_path_string = implode(' ',$dir_path);
                $array = [];

                my_recursive($dir_path_string);
        }

    // NOTE: dir
        elseif(is_dir(end($argv))){
            $dh = opendir(end($argv));
            $array = [];
                while(($file = readdir($dh)) !== false){
                    if (substr($file,-3) == "png"){
                        array_push($array,$file);
                    }
                }

                // TODO $array_rev = array_merge($array,array_slice(array_reverse(end($argv)),1));
                // TODO $array = array_reverse($array_rev);

            closedir($dh);
        }
        // NOTE: file
            else{
                    $array = [];
                    foreach($argv as $files){
                        array_push($array,$files);
                    }
                }

    generate_sprite($array);
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
                     array_push($array,$dir_path_string.$file); 
                 }
         }
     }
     closedir($dh);
     }

}

function generate_sprite(){
    global $array;
    global $sprite_name;
    global $style_name;

    $img_height_max = [];
    $img_width_max = [];

    // définit les tailles
        foreach($array as $picture){
            $source = imagecreatefrompng($picture);
            $img_width = imagesx($source);
            $img_height = imagesy($source); 
            array_push($img_height_max,$img_height);
            array_push($img_width_max,$img_width);
        }    

    // incrémente et corréle
        $sprite_width = 0;
        foreach ($array as $picture) {
            $sprite_width += max($img_width_max);
        }
            $destination = imagecreatetruecolor($sprite_width, max($img_height_max));

        foreach($array as $picture){   
            $source = imagecreatefrompng($picture);         
            imagecopy($destination, $source, $pos_x, 0, 0, 0, $sprite_width, max($img_height_max));

            $pos_x += max($img_width_max);
        }

    // crée le fichier final sprite
      imagepng($destination,$sprite_name);

    // génére le fichier style //
        // ajoute la partie html et la class du sprite généré dans le fichier style
        $fichier = fopen($style_name, "c");
        fwrite($fichier, "html{\n\tposition: relative;\n\theight: ".max($img_width_max)."px;\n\twidth: ".max($img_width_max)."px;\n}.image{\n\tbackground: url('".$sprite_name."') no-repeat;\n\twidth:100vw;\n\theight: ".max($img_height_max)."px;\n\tleft: 0;\n\ttop: 0;\n}\n");
        fwrite($fichier, ".image-1{\n\tposition: absolute;\n\tbackground: url('".$sprite_name."') no-repeat;\n\twidth:100%;\n\theight: ".max($img_height_max)."px;\n\tleft: 0;\n\ttop: 0;\n\tbackground-position: 0px;\n}\n");
        // crée une balise class pour chaque images données en paramètre
        $position_array=[];
        array_shift($array);
        var_dump($array);
            foreach ($array as $key => $file){
                $key1 = $key +2;
                $position_x -= max($img_width_max);
                fwrite($fichier, ".image-".$key1."{\n\tposition: absolute;\n\tbackground: url('".$sprite_name."') no-repeat;\n\twidth:100%;\n\theight: ".max($img_height_max)."px;\n\tleft: 0;\n\ttop: 0;\n\tbackground-position: ".$position_x."px;\n}\n");
            }
            var_dump($array);

            fclose($fichier);
    
}

function generate_css(){
    
}
