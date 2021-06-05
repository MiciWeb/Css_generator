<?php
function recursive($argv){
    array_shift($argv);
    if(is_dir(implode(" ",$argv))){ 
        $dir = opendir(implode(" ",$argv));
        $array = [];
        while(($files = readdir($dir)) !== false) {  
            if (substr($files,-3) == "png"){
            array_push($array,$files);
            }
            recursive($argv);

        }
        closedir($dir);

        var_dump($array);
    }
}
function scan($dir){
    if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
            if ($file !== "." AND $file !== ".." AND $file !== ".git"){
                if (is_dir($dir . $file)){
                    scan($dir . $file ."/");

                } elseif(pathinfo($file, PATHINFO_EXTENSION) == "png"){
                    echo $file . "\n";
                }
        }
    }
    closedir($dh);
    }
}
scan(".");