<?php
    require_once("../../model/empresa/Reg_Cuotas.php");
    session_start();
    if (isset ($_SESSION['usuario']  )){
        $usuario = $_SESSION['usuario'];

        $objeto = new Cuotas_empresa();
        $id = $objeto->usuario($usuario);
        $id_cuota = $objeto->id_cuotas();
        $id = $id[0]['RFCUsuaEmp'];

        $tipobox=$_POST["tipo"];
        $monto=$_POST["monto"];
        $fecha_inicio=$_POST["fechainicio"];
        $fecha_fin=$_POST["fechafin"];
        $archivo=$_FILES["archivo"]["name"];

        if ($fecha_fin> $fecha_inicio){
            if ($tipobox== 1){
                $tipobox="Membresía";
            }
            else if ($tipobox == 2){
                $tipobox = "Curso";
            }
            else if ($tipobox == 3){
                $tipobox = "Certificación";
            }
            
    
            $new_name_file=null;
        
            if ($archivo!='' || $archivo!=null){
                $tipo = $_FILES['archivo']['type'];
                list($type, $extension)=explode('/', $tipo);
                if ($extension=='pdf'){
                    $dir='../Comprobantes/';
                    if (!file_exists($dir)){
                        mkdir($dir,0777, true);
                    }
                    $temp = $_FILES['archivo']['tmp_name'];
                    $new_name_file=$dir. $id_cuota;
                    if (copy($temp, $new_name_file)){
        
                    }
                }
            }
    
            $insercion = $objeto->insertar_cuota($id,$id_cuota,$tipobox,$monto,$fecha_inicio,$fecha_fin,$archivo);
    
            if ($insercion==true){
                echo json_encode('exito');
            }else{
                echo json_encode('no exito');
            } 
        }
        else{
            echo json_encode('fechas');
        }
    }
?>