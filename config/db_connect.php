<?php

$conn = mysqli_connect('localhost', 'root', '', 'naija_pizza');

if (!$conn){
    echo 'Connection Error: ' .
    mysqli_connect_error();
}



?>