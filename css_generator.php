<?php
function my_scan_dir($argv){
    global $array;
    global $sprite_name;
    global $style_name;
    $sprite_name = "sprite.png";
    $style_name = "style.css";
    array_shift($argv);

    // NOTE option -i --output-image
        if (in_array("-i",$argv) OR in_array("--output-image",$argv) ){
             if(in_array("-i",$argv)){
                    $array_if_option_exist = array_search("-i",$argv);
                }else{
                    $array_if_option_exist = array_search("--output-image",$argv);
                }
                    // sélectionne l'option et le nom de l'image
                    $array_sprite_name = $argv[$array_if_option_exist +1];
                    $sprite_name = $array_sprite_name;

                    // supprime l'option et le nom de l'image
                    unset($argv[$array_if_option_exist +1]);
                    unset($argv[$array_if_option_exist]);
                }
        
    // NOTE option -s --output-style
        if (in_array("-s",$argv) OR in_array("--output-style",$argv) ){
             if(in_array("-s",$argv)){
                    $array_if_option_exist = array_search("-s",$argv);
                }else{
                    $array_if_option_exist = array_search("--output-style",$argv);
                }
                    // sélectionne l'option et le nom du style
                    $array_style_name = $argv[$array_if_option_exist +1];
                    $style_name = $array_style_name;

                    // supprime l'option et le nom du style
                    unset($argv[$array_if_option_exist +1]);
                    unset($argv[$array_if_option_exist]);
                }

    // NOTE: option -r --recursive
        if(in_array("-r",$argv) OR in_array("--recursive",$argv)){

                //si on trouve -r ou --recursive dans l'argv on le supprime
                if(in_array("-r",$argv)){
                    $array_if_option_exist = array_search("-r",$argv);
                }else{
                    $array_if_option_exist = array_search("--recursive",$argv);
                }
                $array_without_option = end($argv);
                unset($argv[$array_if_option_exist]);
                
                var_dump($array_without_option);

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

function generate_sprite($array){
    global $sprite_name;
    global $style_name;

    $img_height_max = [];
    $img_width_max = [];
    $all_img_width = [];

    // NOTE: Génére l'image sprite png //
        // définit les tailles
            foreach($array as $picture){
                $source = imagecreatefrompng($picture);
                $img_width = imagesx($source);
                $img_height = imagesy($source); 
                array_push($img_height_max,$img_height);
                array_push($img_width_max,$img_width);
                array_push($all_img_width,$img_width);
            }    
        // incrémente et corréle
            $sprite_width = 0;
            foreach ($array as $key => $picture) {
                $sprite_width += $all_img_width[$key];   
            }
                $destination = imagecreatetruecolor($sprite_width, max($img_height_max));

            foreach($array as $key => $picture){   
                $source = imagecreatefrompng($picture);         
                imagecopy($destination, $source, $pos_x, 0, 0, 0, $sprite_width, max($img_height_max));
                $pos_x += $all_img_width[$key];
            }

        // crée le fichier final sprite
            imagepng($destination,$sprite_name);

    // NOTE: Génére le fichier css //
        
        $fichier = fopen($style_name, "c");
        fwrite($fichier, "html{\n\tposition: relative;\n}.image{\n\tbackground: url('".$sprite_name."') no-repeat;\n\twidth:200vw;\n\theight: ".max($img_height_max)."px;\n\tleft: 0;\n\ttop: 0;\n}\n");
        // crée 2 array différent des img width
            $position_array=[];
            $arr = [];
            $all_img_width_for_position_x = array_merge($arr,$all_img_width);
            array_unshift($all_img_width,0);
            
            foreach ($array as $key => $file){
                var_dump($file);
                $key1 = $key +1;
                $position_x -= $all_img_width[$key];
                fwrite($fichier, ".image-".$key1."{\n\tposition: absolute;\n\tbackground: url('".$sprite_name."') no-repeat;\n\twidth:".$all_img_width_for_position_x[$key]."px;\n\theight: ".max($img_height_max)."px;\n\tleft: 0;\n\ttop: 0;\n\tbackground-position: ".$position_x."px;\n}\n");
            }

            fclose($fichier);
}


