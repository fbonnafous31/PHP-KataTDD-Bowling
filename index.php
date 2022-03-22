<?php 
    // Lecture d'une chaîne caractère par caractère
    $string = "Hello World !";
    $string = "11";
    $result = 0;
    for ($i=0; $i<= strlen($string); $i++) {
        echo $string[$i].'<br>';
        $result += $string[$i];
    }
    echo '<br>'.$result;
?>