<?php
$host='localhost';
$nombreBD='u283658544_colegiociscig';
$usuario='u283658544_colegiociscig';
$password='ColegioCISCIG2023.';

$nuevoNombre='Respaldo';
$target_path = "../comprobantes/administrativo/BD/";
$parts = explode(".",$_FILES['importa_bd']['name']);
$target_path = $target_path . $nuevoNombre.".". end($parts);

if(move_uploaded_file($_FILES['importa_bd']['tmp_name'], $target_path)){
    $data=('Actualización exitosa');
}else{
    $data=('Ha ocurrido un error al conectar con la base de datos');
}

 // Ruta al fichero que vas a cargar.
$fichero ='../../controller/comprobantes/administrativo/BD/Respaldo.sql';

// Aquí tendrás que poner tus datos de conexión a la base de datos y la tabla en cuestión.
$conexion = mysqli_connect($host, $usuario, $password)or die('Error al conectar');

//Elimina la base de BD
$eliminarBD='DROP DATABASE IF EXISTS '. $nombreBD ;
if(mysqli_query($conexion, $eliminarBD) ){
    $data=('Base eliminada correctamente');
}else{
    $data=('No se pudo eliminar la base de datos');
}

//Crea la base de datos
$crearBD='CREATE DATABASE '.  $nombreBD;
//$res_crearBD = mysqli_query($conexion, $crearBD) or die("No se pudo crear la BD: ".mysqli_error());
if(mysqli_query($conexion, $crearBD) ){
    $data=('Base creada correctamente');
}else{
    $data=('No se pudo crear la base de datos');
}
//Selecciona la BD
//mysqli_select_db($conexion, $nombreBD ) or die("No se pudo seleccionar la Base de Datos: ". mysqli_error());
if(mysqli_select_db($conexion, $nombreBD) ){
    $data=('Base seleccionada correctamente');
}else{
    $data=('No se pudo seleccionar la base de datos');
}
// Linea donde vamos montando la sentencia actual
$temp = '';

// Flag para controlar los comentarios multi-linea
$comentario_multilinea = false;

// Leemos el fichero SQL al completo
$lineas = file($fichero);
// Procesamos el fichero linea a linea
foreach ($lineas as $linea) 
{

    // Quitamos espacios/tabuladores por delante y por detrás
    $linea = trim($linea); 

    // Si es una linea en blanco o tiene un comentario nos la saltamos
    if ( (substr($linea, 0, 2) == '--') or (substr($linea, 0, 1) == '#') or ($linea == '') )
        continue;

    // Saltamos los comentarios multilinea /* texto */ Se detecta cuando empiezan y cuando acaban mediante estos dos ifs  
   // if ( substr($linea, 0, 2) == '/*' ) $comentario_multilinea = true;

   // if ( $comentario_multilinea ) {
       //if ( (substr($linea, -2, 2) == '*/') or (substr($linea, -3, 3) == '*/;') ) $comentario_multilinea = false;
      // continue;
    //}

    // Añadimos la linea actual a la sentencia en la que estamos trabajando 
    $temp .= $linea;

    // Si la linea acaba en ; hemos encontrado el final de la sentencia
    if (substr($linea, -1, 1) == ';') {
        // Ejecutamos la consulta
        //mysqli_query($conexion, $temp) or print('<strong>Error en la consulta</strong> \'' . $temp . '\' - ' . mysqli_error($conexion) . "<br /><br />\n");
        if(mysqli_query($conexion, $temp) ){
            $data=('Importación exitosa');
            
        }else{
            $data=('Error en la consulta'. $temp);
        }
        // Limpiamos sentencia temporal
        $temp = '';
    }
    
}

unlink('../../controller/comprobantes/administrativo/BD/Respaldo.sql');

echo json_encode($data);

?>