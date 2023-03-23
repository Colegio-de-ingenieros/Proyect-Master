<?php

include_once('../../model/Reg_Cursos.php');
// Leemos el arreglo enviado desde JavaScript
$arreglo = json_decode($_POST["arrayin"]);

// Leemos la lista 1 enviada desde JavaScript
$lista1 = json_decode($_POST["lista"]);

// Leemos la lista 2 enviada desde JavaScript
/* $lista2 = json_decode($_POST["su"]); */

//imprimimos
/* var_dump($arreglo);
var_dump($lista1); */
/* var_dump($lista2); */

/* imprimir el segundo dato de la segunda posicion en la lista de listas lista1 */
 /* echo $lista1[1][0][1]; */
/* consegir la longitud de la lista */
/* echo count($lista1[0][0]); */
/* echo count($lista1[1][0]); */
/* echo count($lista1); */

$obj = new NuevoCurso();
$obj->conexion();

$obj->insertar($arreglo);

$servername = "localhost";
$username = "AdminCISCIG";
$password = "ColegioCISCIG2023.";
$dbname = "colegiociscig";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = ("SELECT MAX(IdTema) FROM temas");
$res = mysqli_query($conn, $sql);
$re = mysqli_fetch_assoc($res);
$n= $re['MAX(IdTema)'];
echo $n;

$incre=0;
if ($n){
    $incre=$incre+$n;
    $incre++;
}

$tema = array();
if ($lista1){
for($i=0;$i<count($lista1);$i++){
    $obj->insertarTema($incre,$lista1[$i][0][0]);
    
    array_push($tema,$incre);
    $incre++;
}
echo "Datos insertados correctamente";

for($i=0;$i<count($tema);$i++){
    $obj->curtem($arreglo[0],$tema[$i]);
}
echo "Datos insertados correctamente";


$sql = ("SELECT MAX(IdSubT) FROM subtemas");
$res = mysqli_query($conn, $sql);
$re = mysqli_fetch_assoc($res);
$n= $re['MAX(IdSubT)'];
echo $n;

$incre=0;
if ($n){
    $incre=$incre+$n;
    $incre++;
}


for($i=0;$i<count($lista1);$i++){
    for($j=1;$j<count($lista1[$i][0]);$j++){
        $obj->insertarSub($incre,$lista1[$i][0][$j]);
        $obj->temsub($tema[$i],$incre);
        
        $incre++;
    }
} 
}
















/* $obj = new NuevoCurso();
$obj->conexion();

$obj->insertar($arreglo);
    
if($lista1!=null){
    $conta=0;
    foreach($lista1 as $valor){
        $obj->insertarTema($arreglo,$lista1,$conta);
        $conta++;    
    }
        
        echo "Datos insertados correctamente";
    } */
    /* if ($lista2!=null){
        $conta1=0;
        foreach($lista2 as $valor1){
            $obj->insertarSub($arreglo,$lista2,$conta1);
            $conta1++;
       }
    } */

/* 
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

 */
?>