<?php
function my_scandir($argv){

    array_shift($argv);
    if(implode(" ",$argv) == "."){ 
        $dir = opendir(implode(" ",$argv));
        $array = [];
            while(($files = readdir($dir)) !== false) 
        {  
        if (substr($files,-3) == "png"){
            array_push($array,$files);
        }
        }
        closedir($dir);
    }else{
        var_dump($argv);
        $array = [];
        foreach($argv as $files){
            array_push($array,$files);
        }
    }
    

         //function Generate Sprite
  $width = 0;
  $imgwidth = 30;
  $imgheight = 30;
  foreach ($array as $picture) {
      $width += $imgwidth;
  }

  $dest = imagecreatetruecolor($width, $imgheight);

  $pos = 0;
  foreach ($array as $picture){
    $source = imagecreatefrompng($picture);
    
    imagecopy($dest, $source, $pos, 0, 0, 0, $imgwidth, $imgheight);

    $pos += $imgwidth;
    }
      imagepng($dest,"sprite.png");

    //function Generate Css
      $fichier = fopen('style.css', "c");
    fwrite($fichier, "html{\nposition: relative;\nheight: 30px;\nwidth: 30px;\n}\n.image{\nbackground: url('sprite.png') no-repeat;\nwidth:100vw;\nheight: 30px;\nleft: 0;\ntop: 0;\n}\n");
    fclose($fichier);
     foreach ($array as $key => $file){
        $key1 = $key+1;
        $clip -= 30;
        $fichier = 'style.css';
        $content = ".image-".$key1."{\nposition: absolute;\nbackground: url('sprite.png') no-repeat;\nwidth:100%;\nheight: 30px;\nleft: 0;\ntop: 0;\nbackground-position: ".$clip."px;\n}\n";
        file_put_contents($fichier,$content,FILE_APPEND);
    }

    }
my_scandir($argv);