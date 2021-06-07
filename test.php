<?php
function generate_sprite($array){
    $argvpoint = array_search(".",$array);
    var_dump(array_slice($array[$argvpoint],1));

}
generate_sprite(["xbox.png",".","steam.png","lol.png"]);