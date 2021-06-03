<?php
function spriter($files) {
  $width = 0;
  $imgwidth = 30;
  $imgheight = 30;
  foreach ($files as $file) {
      $width += $imgwidth;
  }

  $dest = imagecreatetruecolor($width, $imgheight);

  $pos = 0;
  foreach ($files as $file){
    $source = imagecreatefrompng($file);
    
    imagecopy($dest, $source, $pos, 0, 0, 0, $imgwidth, $imgheight);

    $pos += $imgwidth;
    }
      imagepng($dest,"sprite.png");

      $fichier = fopen('style.css', "c");
    fwrite($fichier, "html{\nposition: relative;\nheight: 30px;\nwidth: 30px;\n}\n.image{\nbackground: url('sprite.png') no-repeat;\nwidth:100vw;\nheight: 30px;\nleft: 0;\ntop: 0;\n}\n");
    fclose($fichier);
     foreach ($files as $key => $file){
        $key1 = $key+1;
        $clip -= 30;
        $fichier = 'style.css';
        $content = ".image-".$key1."{\nposition: absolute;\nbackground: url('sprite.png') no-repeat;\nwidth:100%;\nheight: 30px;\nleft: 0;\ntop: 0;\nbackground-position: ".$clip."px;\n}\n";
        file_put_contents($fichier,$content,FILE_APPEND);
    }
    
  }
spriter(glob("*.png"));
?>
