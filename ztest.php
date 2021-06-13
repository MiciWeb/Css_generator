<?php
function sprite($argv){   
        array_shift($argv);
        $array = $argv;

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
        imagepng($destination,"zchibou.png");

        //  génére le fichier style 


        // ajoute la partie html et la class du sprite généré dans le fichier style
      

        // crée une balise class pour chaque images données en paramètre
        
            // array_push($position_array,$clip);
            // array_unshift($position_array,0);
            // $array_int = implode(',',$position_array);
            
           
            foreach ($array as $key => $file){
                $key1 = $key +1;
                $position_x -= max($img_width_max);
                $content = ".image-".$key1."{
                    \nposition: absolute;
                    \nbackground: url('".$sprite_name."') no-repeat;
                    \nwidth:100%;\nheight: ".$imgheight."px;
                    \nleft: 0;
                    \ntop: 0;
                    \nbackground-position: ".$position_x."px;\n}
                    \n";
                file_put_contents("zchibou.css",$content,FILE_APPEND);
            }
}
sprite($argv);