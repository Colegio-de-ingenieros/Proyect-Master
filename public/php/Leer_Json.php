<?php
    header('Content-Type: application/json');
    $nombre = $_POST['nombre_json'];
    echo file_get_contents($nombre);
?>