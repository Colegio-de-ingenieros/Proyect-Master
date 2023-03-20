<?php
include_once('../../view/administrativo/js/Registro_Cursos.js');

// Leemos el arreglo enviado desde JavaScript
$arreglo = json_decode($_POST["arrayin"]);

// Leemos la lista 1 enviada desde JavaScript
$lista1 = json_decode($_POST["lista"]);

// Leemos la lista 2 enviada desde JavaScript
$lista2 = json_decode($_POST["su"]);

// Imprimimos los datos leídos
var_dump($arreglo);
var_dump($lista1);
var_dump($lista2);

$servername = "localhost";
$username = "AdiminCISCIG";
$password = "ColegioCISCIG2023";
$dbname = "colegiociscig";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
else{
    echo "Conexión exitosa";
}

$sql = ("INSERT INTO Cursos (ClaveCur,NomCur,ObjCur,DuracionCur) 
VALUES ('$arreglo[0]','$arreglo[1]','$arreglo[2]','$arreglo[3]')");;
mysqli_query($conn, $sql);

if($lista1!=null){
$conta=0;
foreach($lista1 as $valor){
    $sql1 = ("INSERT INTO Temas (IdTema,NomTema)
    VALUES ('$arreglo[0]','$lista1[$conta]')");
    mysqli_query($conn, $sql1);
    $conta++;    
}
    
    echo "Datos insertados correctamente";
}
if ($lista2!=null){
    $conta1=0;
    foreach($lista2 as $valor1){
         $sql2 = ("INSERT INTO SubTemas (IdSubT,NomSubT)
         VALUES ('$arreglo[0]','$lista2[$conta1]')");
        mysqli_query($conn, $sql2);
        $conta1++;
   }
}
        mysqli_close($conn);
    
        echo "Datos insertados correctamente";


?>
