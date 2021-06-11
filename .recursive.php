<?php
function recursive($argv){
    array_shift($argv);
    var_dump(end($argv));
    // if(is_dir(end($argv))){ 
    //     $dir = opendir(implode(" ",$argv));
    //     $array = [];
    //     while(($files = readdir($dir)) !== false) {  
    //         if (substr($files,-3) == "png"){
    //         array_push($array,$files);
    //         }
    //         recursive($argv);

    //     }
    //     closedir($dir);

    //     var_dump($array);
    // }
}


function my_scan_dir($argv){
    // option -r recursive
    if(in_array("-r",$argv)){
        // si on trouve -r on le supprime
        $array_r = array_search("-r",$argv);
        unset($argv[$array_r]);

        // transforme l'array argv en string
        array_shift($argv);
        $dir_path = [];
        array_push($dir_path,implode(" ",$argv));
        $dir_path_string = implode(' ',$dir_path);

        my_recursive($dir_path_string);

    }

}
my_scan_dir($argv);

function my_recursive($dir_path_string){
   if ($dh = opendir($dir_path_string)){
        while (($file = readdir($dh)) !== false){
            if ($file !== "." AND $file !== ".." AND $file !== ".git"){
                if (is_dir($dir_path_string . $file)){
                    my_recursive($dir_path_string .$file ."/");
                    
                } elseif(substr($file,-3) == "png"){
                    echo $file . "\n";
                }
        }
    }
    closedir($dh);
    }
}



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