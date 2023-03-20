<?php
echo "Hello World";
// Leemos el arreglo enviado desde JavaScript
$arreglo = json_decode($_POST["arreglo"]);

// Leemos la lista 1 enviada desde JavaScript
$lista1 = json_decode($_POST["lista1"]);

// Leemos la lista 2 enviada desde JavaScript
$lista2 = json_decode($_POST["lista2"]);


?>