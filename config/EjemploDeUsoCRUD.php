<?php

    include_once("Crud_bd.php");
    $base = new Crud_bd();
    $base->conexion_bd();
    $fecha = date('y-m-d');

    // $sql = "INSERT INTO alunmos (nombre,paterno,materno,semestre,no_control,correo,telefono) VALUES(:nom, :apep, :apem, :se,:con, :correo, :tele)";
    // $base->insertar_eliminar_actualizar($sql, [":nom"=>"maria", ":apep"=>"llamas", ":apem"=>"Marquez", ":se"=>"2",":con"=>"Z20020020", ":correo"=>"solo@gmail.com",":tele"=>"4371023438"]);
    // $base->insertar_eliminar_actualizar("DELETE FROM datos_usuarios WHERE id=:id", [":id"=>"6"]);
    // $base->insertar_eliminar_actualizar("UPDATE datos_usuarios SET Direccion=:midir WHERE id=:mid", [":mid"=>"4", ":midir"=>"sierra madre"]);
    // $base->insertar_eliminar_actualizar("DELETE FROM datos_usuarios WHERE id=:id", [":id"=>"4"]);
    // $base->mostrar("SELECT * FROM datos_usuarios where id=:id", [":id"=>"1"]);
    
    /*$q1 = "INSERT INTO proyectos (IdPro, NomProyecto, IniPro, FinPro, ObjPro, MontoPro, EstatusPro)
    VALUES(:id, :nom, :inicio, :fin, :obj, :monto, :estatus)";

    $a1 = [":id"=>'PCRUD2', ":nom"=>'prueba de insersión arreglos', ":inicio"=>$fecha, ":fin"=>$fecha, 
    ":obj"=>'Verificar que se pueden hacer varias consultas en una sola transacción', ":monto"=>100, ":estatus"=>1];

    $q2 = "INSERT INTO proyectos (IdPro, NomProyecto, IniPro, FinPro, ObjPro, MontoPro, EstatusPro)
        VALUES(:id, :nom, :inicio, :fin, :obj, :monto, :estatus)";

    $a2 = [":id" => 'PCRUD3', ":nom" => 'prueba de insersión arreglos2', ":inicio" => $fecha, ":fin" => $fecha,
        ":obj" => 'Verificar que se pueden hacer varias consultas en una sola transacción', ":monto" => 100, ":estatus" => 1];

    $sql = [$q1, $q2];
    $parametros = [$a1, $a2];
    $resultado = $base->insertar_eliminar_actualizar($sql,$parametros);

    if($resultado){
        echo "se inserto con exito";
    }else{
        echo "No se pudo insertar";
    }
    $base->cerrar_conexion(); 
    
    /*include_once("Crud_bd.php");
    $perro=new Crud_bd();
    $perro->conexion_bd();

    $consulta="SELECT * FROM evento,alumnos";
    $parametro=[":selecion"=>"10"];
    $resultado=$perro->mostrar($consulta);
    var_dump($resultado);

    for ($i=0; $i <count($resultado) ; $i++) { 
        # code...
        echo "<br>";
        echo $resultado[$i]["no_evento"]."<br>";
        echo $resultado[$i]["evento"]."<br>";
        echo $resultado[$i]["hora_inicio"]."<br>";
        echo $resultado[$i]["hora_fin"]."<br>";
        echo $resultado[$i]["descripcion"]."<br>";
    }

    for ($i=0; $i <count($resultado) ; $i++) { 
        echo "<br>";
        echo $resultado[$i][0];
    }
     */ 

     /*   Ejemplo nuevo
    $base = new Crud_bd();
    $base->conexion_bd();
    $resultado=$base->mostrar("SELECT * FROM estados");
    var_dump($resultado);
    $sql = "UPDATE pruebas set ma=:numero1 where m = :numero";
    $resulatado = $base->insertar_eliminar_actualizar($sql,[":numero1"=>'2000',":numero"=>'1']);
    if($resulatado){
        echo "Operacion exitosa";

    }
    */

    /*
    ejemplo con fechas
     $base = new Crud_bd();
    $base->conexion_bd();
    $fecha=date("Y-m-d");
    $sql = "INSERT INTO proyectos (IdPro,NomProyecto,IniPro,FinPro,ObjPro,MontoPro,EstatusPro) VALUES(:id,:nom,:ini,:fin,:obj,:monto,:estatus)";
    $arreglo = [":id"=>2,":nom"=>"Proyecto insercion",
                ":ini"=>$fecha,":fin"=>$fecha,
                ":obj"=>"inseertabdiauudcuiqw huc wbjqucb",
                ":monto"=>20.2,":estatus"=>1];
    $resulatado = $base->insertar_eliminar_actualizar($sql,$arreglo);
    if($resulatado){
        echo "Operacion exitosa";
    }
    */
    
    


?>
