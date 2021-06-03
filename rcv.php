<?php
function recursive($argv){
    array_shift($argv);
    if(implode(" ",$argv) == "."){ 
        $dir = opendir(implode(" ",$argv));
        $array = [];
        while(($files = readdir($dir)) !== false) {  
            if (substr($files,-3) == "png"){
            array_push($array,$files);
        }
        var_dump($array);
        }
        closedir($dir);
    }
}
recursive($argv);