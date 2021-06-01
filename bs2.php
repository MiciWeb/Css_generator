<?php
function my_scandir($dir_path){
    $dir = opendir($dir_path);

        while(($file = readdir($dir)) !== false) 
    {  
    if (preg_match("/.png/i","$file") == 1){
        $array = [];
        array_push($array,$file);
        foreach($array as $value){
            print_r($array);
        }
    }
    }
    
    closedir($dir);
}
my_scandir(".");