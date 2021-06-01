<?php
    function my_generate_css(){
    $file = 'style.css';
    // Ouvre un fichier pour lire un contenu existant
    $current = file_get_contents($file);
    file_put_contents($file,$current);
    }
    my_generate_css();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bs1.css">
    <title>Document</title>
</head>
<body>
    <div class="image"></div>
</body>
</html>