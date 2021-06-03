<?php
    $first = imagecreatefrompng("img/playstation.png");
    $second = imagecreatefrompng("img/xbox.png");
    function my_merge_image($first,$second){
        $fond = imagecreate(60,30);
        imagecopymerge($fond, $first, 30, 0, 0, 0, imagesx($first), imagesy($first), 50);
        imagecopymerge($fond, $second, 0, 0, 0, 0, imagesx($second), imagesy($second), 50);
        header('Content-Type: image/png'); 
        imagepng($fond,"image.png");
    }
    my_merge_image($first,$second);

    function my_generate_css(){
    $file = 'style.css';
    // Ouvre un fichier pour lire un contenu existant
    $content = ".image{color: red;}";
    file_put_contents($file,$current);
    }
    my_generate_css();
?>
