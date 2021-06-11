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

    // REVIEW Generate sprite image
        // NOTE: on attribut les largeur et hauteur des pictures a nos variables
            foreach($array as $picture){
                $source = imagecreatefrompng($picture);
                $imgwidth = imagesx($source);
                $imgheight = imagesy($source); 
            }
            $sprite_height = 0;
            $sprite_width = 0;

        // NOTE: crée des carrés vide "$destination" ou l'on va coller chaque image "$source" bout à bout
            foreach ($array as $picture) {
                $sprite_width += $imgwidth;

            }
            // width  = toutes les images, hauteur de la plus grosse
            $destination = imagecreatetruecolor($sprite_width, $sprite_height);
            
            $pos = 0;

            foreach($array as $picture){   
                $source = imagecreatefrompng($picture);         
                imagecopy($destination, $source, $pos, 0, 0, 0, $imgwidth, $imgheight);
                $pos += $imgwidth;
            }
                
        // crée le fichier final sprite
            imagepng($destination,$sprite_name);
    

    // REVIEW Generate sprite image
            



}
