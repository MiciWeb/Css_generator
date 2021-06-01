<?php
function my_scandir($dir_path){
    $dir = opendir($dir_path);
    $array = [];
        while(($file = readdir($dir)) !== false) 
    {  
    if (substr($file,-3) == "png"){
        array_push($array,$file);
       
    }
    }
    print_r($array);
    
    closedir($dir);
}
my_scandir(".");