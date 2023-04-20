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
                $objeto->estatus_cursos($actividad);
                $result=$objeto->insert_curso($idSeg, $actividad);
            }else if ($valTipo=="proyecto"){
                $objeto->estatus_proyectos($actividad);
                $result = $objeto->insert_proyectos($idSeg, $actividad);
                
            }else{
                $result = $objeto->insert_certificaciones($idSeg, $actividad);
                $objeto->estatus_certifica($actividad);
            }
            if($result == true){
                for ($i=0;$i<count($instructores);$i++){
                    $idI=$objeto->id_parI();
                    $result = $objeto->insert_instructores($idI,$idSeg, $instructores[$i]);
                    $objeto->estatus_ins($instructores[$i]);
                }
                if ($auxSocAso!=""){
                    $sociosAsoc=explode(",", $auxSocAso);
                    for ($i=0;$i<count($sociosAsoc);$i++){
                        $idP=$objeto->id_parP();
                        $result = $objeto->insert_socios($idSeg, $sociosAsoc[$i], $idP);
                    }
                }
                if ($auxEmp!=""){
                    $empresas=explode(",", $auxEmp);
                    for ($i=0;$i<count($empresas);$i++){
                        $idE=$objeto->id_parE();
                        $result = $objeto->insert_empresas($idSeg, $empresas[$i], $idE);
                    }
                }
                
                if($result == true){
                    $data=['correcto', $idSeg];
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