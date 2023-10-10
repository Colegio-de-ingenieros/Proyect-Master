<?php


if($result == true){
    $nuevoNombre=$idPoliza;
    $target_path = "../comprobantes/administrativo/polizas/";
    $parts = explode(".",$_FILES['archivo']['name']);
    $target_path = $target_path . $nuevoNombre.".". end($parts);
    move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path);
    
    $data=('Gasto registrado exitosamente');
}
else{
    $data=('Ha ocurrido un error al conectar con la base de datos');
}





?>

