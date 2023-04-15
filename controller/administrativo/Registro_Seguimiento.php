<?php

require_once('../../model/administrativo/Reg_Seguimiento.php');
$objeto=new Seguimiento();
$data =[];

$oculto=$_POST["valueHidden"];

if ($oculto==1){
    $data = $objeto->buscar_participantes();  
} else {
    $envio=$_POST["envio"];
    if ($envio!=1){
        $valTipo=$_POST["tipo"];
        if ($valTipo=="curso"){
            $data = $objeto->buscar_cursos();
        }else if ($valTipo=="proyecto"){
            $data = $objeto->buscar_proyectos();
        }else{
            $data = $objeto->buscar_certificaciones();
        }
    } else {
        $valTipo=$_POST["tipo"];
        $actividad=($_POST["nombre"]);
        $auxIns=($_POST["lisIns"]);
        $auxSocAso=($_POST["lisSocio"]);
        $auxEmp=($_POST["lisEmp"]);

        $instructores=explode(",", $auxIns);
        
        $idSeg=$objeto->id_seg();
        
        $result=$objeto->insert_seg($idSeg);
        if($result == true){
            if ($valTipo=="curso"){
                $result=$objeto->insert_curso($idSeg, $actividad);
            }else if ($valTipo=="proyecto"){
                $result = $objeto->insert_proyectos($idSeg, $actividad);
            }else{
                $result = $objeto->insert_certificaciones($idSeg, $actividad);
            }
            if($result == true){
                for ($i=0;$i<count($instructores);$i++){
                    $result = $objeto->insert_instructores($idSeg, $instructores[$i]);
                }
                if ($auxSocAso!=""){
                    $sociosAsoc=explode(",", $auxSocAso);
                    for ($i=0;$i<count($sociosAsoc);$i++){
                        $result = $objeto->insert_socios($idSeg, $sociosAsoc[$i]);
                    }
                }
                if ($auxEmp!=""){
                    $empresas=explode(",", $auxEmp);
                    for ($i=0;$i<count($empresas);$i++){
                        $result = $objeto->insert_empresas($idSeg, $empresas[$i]);
                    }
                }
                
                if($result == true){
                    $data=['correcto'];
                }
            }
            else{
                echo json_encode('Ha ocurrido un error al conectar con la base de datos');
            }
        }
        else{
            echo json_encode('Ha ocurrido un error al conectar con la base de datos');
        }
    }
}

echo json_encode($data)

?>