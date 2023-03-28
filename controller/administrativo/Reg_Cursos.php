<?php
    include_once('../../model/Reg_Cursos.php');

    $arreglo = json_decode($_POST["arrayin"]);
    $lista1 = json_decode($_POST["lista"]);

    $obj = new NuevoCurso();

    $obj->conexion();



    $identificador=$arreglo[0];
    $existe=$obj->esta($identificador);

    if($existe){
    echo "La clave existe actualmente en la base de datos";
    }
    else{
        $obj->insertar($arreglo);

        $longi=[];

        for ($i=0;$i<count($lista1);$i++){
            array_push($longi,$lista1[$i]);
        }

        $incres=$obj->idsub();
        $incres=$incres[0][0];
        $incres++;

    $incre=$obj->idtema();
    $incre=$incre[0][0];
    $incre = $incre+$incres;
    $incre++;

    $tema = [];

    for($i=0;$i<count($lista1);$i++){
        $obj->insertarTema($incre,$lista1[$i][0]);
        array_push($tema,$incre);
        $incre++;
    }

    for($i=0;$i<count($tema);$i++){
        $obj->curtem($arreglo[0],$tema[$i]);
    }




    /* echo "Datos insertados correctamente"; */

    for($i=0;$i<count($lista1);$i++){
        if ($longi[$i] > 1){
            for($j=1;$j<count($lista1[$i]);$j++){
                $obj->insertarSub($incres,$lista1[$i][$j]);
                $obj->temsub($tema[$i],$incres);}
                $incres = $incres+1;
            }

        }

    }
    echo "Registro completado";

    }

?>