<?php
function generate_sprite($array){
    $imgwidth = 30;
    $imgheight = 30;   
    $sprite_name = "sprite.png";
    $style_name = 'style.css';
    $sprite_width = 0;
    $sprite_height = $imgheight;

    // option -i du man
    if (in_array("-i",$array) ){

        $array_i = array_search("-i",$array);

        $sprite_name = $array[$array_i +1];

        unset($array[$array_i]);
        unset($array[$array_i +1]);
      }

    // option -s du man
    if(in_array("-s",$array)){
        $array_i = array_search("-s",$array);

        $style_name = $array[$array_i +1];

        unset($array[$array_i]);
        unset($array[$array_i +1]);
    }

    // genere le fichier sprite //

        // cree des carrés vide "$destination" ou l'on va coller chaque image "$source" bout à bout
        foreach ($array as $picture) {
            $sprite_width += $imgwidth;
        }
        $destination = imagecreatetruecolor($sprite_width, $sprite_height);

        $pos = 0;

        foreach($array as $picture){
            $source = imagecreatefrompng($picture);
            
            imagecopy($destination, $source, $pos, 0, 0, 0, $imgwidth, $imgheight);
        
            $pos += $imgwidth;
        }
    
        // cree le fichier final sprite
        imagepng($destination,$sprite_name);
    
    // génére le fichier style //


        // ajoute la partie html et la class du sprite généré dans le fichier style
        $fichier = fopen($style_name, "c");
        fwrite($fichier, "html{\nposition: relative;\nheight: 30px;\nwidth: 30px;\n}\n.image{\nbackground: url('sprite.png') no-repeat;\nwidth:100vw;\nheight: 30px;\nleft: 0;\ntop: 0;\n}\n");
        fclose($fichier);

        // crée une balise class pour chaque images données en paramètre
        foreach ($array as $key => $file){
            $key1 = $key+1;
            $clip -= 30;
            $content = ".image-".$key1."{\nposition: absolute;\nbackground: url('sprite.png') no-repeat;\nwidth:100%;\nheight: 30px;\nleft: 0;\ntop: 0;\nbackground-position: ".$clip."px;\n}\n";
            file_put_contents($style_name,$content,FILE_APPEND);
        }
    
}
function my_scan_dir($argv){
    array_shift($argv);

    if(in_array(".",$argv)){ 
            $argvpoint = array_search(".",$argv);
            $dir = opendir($arraypoint = $argv[$argvpoint]);
            $arraypng = [];
                while(($files = readdir($dir)) !== false){
                    if (substr($files,-3) == "png"){
                        array_push($arraypng,$files);
                    }
                }
                $array = array_merge($arraypng,array_slice($argv,1));
            closedir($dir);
    }else{
        $array = [];
        foreach($argv as $files){
            array_push($array,$files);
        }
        var_dump($array);

    }
    
    generate_sprite($array);

}
my_scan_dir($argv);