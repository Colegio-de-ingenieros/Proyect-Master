<?php
require_once("../config/Crud_bd.php");
class Alta_empresa extends Crud_bd{

    public function insertar_empresa($rfc,$nombre,$calle,$hora_inicio,$hora_fin,$razon,$correo,$contra)
    {
        # esta funcion inserta una empresa en la bd
        $this->conexion_bd();
        $sql = "INSERT INTO usuaemp (RFCUsuaEmp, NomUsuaEmp, CalleUsuaEmp, HrIniUsuaEmp,HrFinUsuaEmp,RazonUsuaEmp,CorreoUsuaEmp,ContraUsuaEmp) VALUES(:rfc,:nombre,:calle,:hrinicio,:hrfin,:razon,:correo,:contra)";
        $parametros = [
                        ":rfc"=>$rfc,
                        ":nombre"=>$nombre,
                        ":calle"=>$calle,
                        ":hrinicio"=>$hora_inicio,
                        ":hrfin"=>$hora_fin,
                        ":razon"=>$razon,
                        ":correo"=>$correo,
                        ":contra"=>$contra
                    ];
        $resultado = $this->insertar_eliminar_actualizar($sql,$parametros);
        $this->cerrar_conexion();

        return $resultado;
    }
    public function buscar_estado($idestado)
    {
        # esta funcion trae todos los estados
        $this->conexion_bd();
        $sql = "SELECT nomestado FROM estados WHERE idestado=:id";
        $resultado = $this->mostrar($sql,[":id"=>$idestado]);
        $this->cerrar_conexion();
        return $resultado;
    }
    public function busar_municipio($idMunicipio){
        # esta funcion trae todos los municipios
        $this->conexion_bd();
        $sql = "SELECT nommunicipio,idestado FROM municipios WHERE idmunicipio=:id";
        $resultado = $this->mostrar($sql,[":id"=>$idMunicipio]);
        $this->cerrar_conexion();
        return $resultado;
    }
    public function buscar_colonias($codigoPostal){
        # esta funcion trae todos los municipios
        $this->conexion_bd();
        $sql = "SELECT IdColonia,nomcolonia,idmunicipio FROM colonias WHERE codpostal=:cod";
        $resultado = $this->mostrar($sql,[":cod"=>$codigoPostal]);
        $this->cerrar_conexion();
        return $resultado;
    }

    public function insertar_dias_laborales($rfc,$dias )
    {

        $sql = array();
        $parametros = array();

        $this->conexion_bd();
        for ($i=0; $i <count($dias) ; $i++){
            
            $sql[]= "INSERT INTO empdias (RFCUsuaEmp,IdLab) VALUES (:rfc,:dia)";
            $parametros[] = [":rfc"=>$rfc,":dia"=>$dias[$i]];
        }
        $resultado = $this->insertar_eliminar_actualizar($sql,$parametros);
        $this->cerrar_conexion();
        return $resultado;
        
    }

    public function obtener_id_area_emp()
    {
        $this->conexion_bd();
        $sql = "SELECT Max(IdAreaEmp) FROM areaempresa";
        $resultado = $this->mostrar($sql);
        $this->cerrar_conexion();
        
        
       
        return $resultado;
    }


 
    public function insertar_areas($nombre,$paterno,$materno,$telefono,$extension,$correo,$tipo_area,$rfc_empresa)
    {
        
        $arreglo = $this->obtener_id_area_emp();
        $id = "";
        if(is_null($arreglo[0][0]) == 1){
            $id = 1;
            
        }else{
            $id = $arreglo[0][0];
            $id++;
        }

        $this->conexion_bd();

        $sql_area = "INSERT INTO areaEmpresa (IdAreaEmp, NomEncArea, ApePEncArea, ApeMEncArea, TelFEncArea,"
                ."ExtenTelFEncArea, CorreoEncArea) VALUES (:id,:nom,:pa,:ma,:tel,:ext,:correo)";
        $parametros_area = [":id"=>$id, ":nom"=>$nombre,":pa"=>$paterno,
                            ":ma"=>$materno,":tel"=>$telefono,":ext"=>$extension,
                            ":correo"=>$correo];
        $sql_emparea = "INSERT INTO emparea (RFCUsuaEmp,IdAreaEmp) VALUES (:empresa,:area)";
        $parametros_emparea = [":empresa"=>$rfc_empresa, ":area"=>$id];
        
        $sql_tipo = "INSERT INTO areaemptipo (IdArea,IdAreaEmp) VALUES (:tipo,:id)";
        $parametros_tipo = [":tipo"=>$tipo_area,":id"=>$id];

        $sqls = [$sql_area,$sql_emparea,$sql_tipo];
        $parametros = [$parametros_area,$parametros_emparea,$parametros_tipo];

        $resultado = $this->insertar_eliminar_actualizar($sqls, $parametros);

        $this->cerrar_conexion();

        return $resultado;


        
    }

    public function establecer_tipo_usuario($rfc_empresa,$tipo)
    {
        //le coloca el tipo de usario que es la empresa
        $this->conexion_bd();
        $sql = "INSERT INTO emptipousua (IdUsua,RFCUsuaEmp) VALUES(:tipo,:rfc)";
        $parametros = [":tipo"=>$tipo,":rfc"=>$rfc_empresa];
        $resultado = $this->insertar_eliminar_actualizar($sql,$parametros);
        $this->cerrar_conexion();
        return $resultado;

    }
}
/*
$m = new Alta_empresa();
#$m->establecer_tipo_usuario("mm","3");
$r = date("h:i:s");
$m->insertar_empresa("rrr","k","k",$r,$r,"d","d","d");*/
#$id =$m->obtener_id_area_emp();
#$m->insertar_areas("ti","po","po","4371023438","123","ssd",2,"mm");
#var_dump($id); 
// $r =$m->insertar_dias_laborales("mm",[1,2,3,4]);
// if($r){
//     echo "se pudo";
// }else{
//     echo "no se pudo";
// }

?>