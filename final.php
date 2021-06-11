<?php
function my_scan_dir($argv){
    global $array;
    array_shift($argv);

    // NOTE: dir
        if(is_dir(implode(" ",$argv))){
            $dh = opendir(implode(" ",$argv));
            $array = [];
                while(($file = readdir($dh)) !== false){
                    if (substr($file,-3) == "png"){
                        array_push($array,$file);
                    }
                }

                // TODO $array_rev = array_merge($array,array_slice(array_reverse(implode(" ",$argv)),1));
                // TODO $array = array_reverse($array_rev);

            closedir($dh);
        }

    // NOTE: recursive option
        elseif(in_array("-r",$argv) OR in_array("--recursive",$argv)){

            // REVIEW si on trouve -r ou --recursive dans l'array on le supprime
                $array_if_option_exist = array_search("-r",$argv);
                $array_if_option_exist = array_search("--recursive",$argv);
                $array_without_option = $argv[$array_if_option_exist +1];
                unset($argv[$array_if_option_exist]);
                
            // REVIEW transforme argv en string pour que la recursive marche
                $dir_path = [];
                array_push($dir_path,$array_without_option);
                $dir_path_string = implode(' ',$dir_path);
                $array = [];

                my_recursive($dir_path_string);
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
                     array_push($array,$file); 
                 }
         }
     }
     closedir($dh);
     }

}

function generate_sprite(){
    global $array;
    $sprite_name = "sprite.png";
    $style_name = "style.css";
    var_dump($array);

    // NOTE sprite name option -i
    // if (in_array("-i",$array) OR in_array("--output-image",$array) ){
        
    //     // REVIEW 
    //         $array_if_option_exist = array_search("-i",$array);
    //         $array_if_option_exist = array_search("--output-image",$array);

    //         $sprite_name = $array[$array_i +1];

    //         unset($array[$array_i]);
    //         unset($array[$array_i +1]);
    //         var_dump($array);
    //         // unset spritename direct 
    //     }
}
