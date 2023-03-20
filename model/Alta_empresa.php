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
   
    public function buscar_colonias($codigoPostal){
        # esta funcion trae todas las colonias en base al codigo postal
        $this->conexion_bd();
        $sql = "SELECT IdColonia,nomcolonia,ciudad,nomestado FROM"
                ." estados,municipios,colonias WHERE estados.idestado = municipios.idestado AND"
                ." municipios.idmunicipio =colonias.idmunicipio AND colonias.codpostal = :cod ";
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
    public function establecer_colonia_empresa($rfc_empresa,$id_colonia)
    {
        # relaciona una empresa con una colonia
        $this->conexion_bd();
        $sql = "INSERT INTO usuaemplugares (RFCUsuaEmp,IdColonia) VALUES(:rfc,:colonia)";
        $parametros = [":rfc"=>$rfc_empresa,":colonia"=>$id_colonia];
        $resultado = $this->insertar_eliminar_actualizar($sql,$parametros);
        $this->cerrar_conexion();
        return $resultado;

    }
    public function obtener_numero_consecutivo()
    {
        # esta funcion te dara el numero en el que se quedaron

        $this->conexion_bd();
        $sql = "SELECT Max(IdNIntel) FROM numinteligentes";
        $resultado = $this->mostrar($sql);
        $this->cerrar_conexion();
       
        return $resultado;

    }
    public function numero_inteligente($rfc_empresa)
    {
        # genera el numero inteligente
        $mydate=getdate(date("U"));
        $year = $mydate["year"];
        $mes = date('m');
        $arreglo = $this->obtener_numero_consecutivo();
        $numero = "";


        if (is_null($arreglo[0][0]) == 1) {
            # significa que no hay registros por eso hay que generarlo
            $numero = 1;
        }else{
            $numero = $arreglo[0][0];
            $numero++;
           
        }
        $numero_con_ceros = $this->agregar_ceros($numero);
        
        $numero_inteligente = $year.$mes.$numero_con_ceros;

        $this->conexion_bd();
        $sql_inteligentes = "INSERT INTO numinteligentes (IdNIntel,NInteligente) VALUES(:consecutivo,:inteligente)";
        $parametros_inteligentes = [":consecutivo"=>$numero,":inteligente"=>$numero_inteligente];

        $sql_usua = "INSERT INTO usuaempnintel (RFCUsuaEmp,IdNIntel) VALUES(:rfc,:consecutivo)";
        $parametros_usua = [":rfc"=>$rfc_empresa,":consecutivo"=>$numero];

        $sql = [$sql_inteligentes,$sql_usua];
        $parametros = [$parametros_inteligentes,$parametros_usua];

        $resultado = $this->insertar_eliminar_actualizar($sql,$parametros);
        $this->cerrar_conexion();
        return $resultado;

    }
    public function agregar_ceros($numero)
    {
        $ceros = "";
        $numero_nuevo="";
        for ($i=0; $i < 4 ; $i++) { 
            $numero_nuevo = $ceros .$numero;
            if(strlen($numero_nuevo) == 4){
                break;
            }else{
                $ceros = $ceros . "0";
            }

        }

        return $numero_nuevo;
    }
}
/*
$m = new Alta_empresa();
$m->numero_inteligente("mm");
*/
#$m->establecer_colonia_empresa("mm",10011);
#$m->establecer_tipo_usuario("mm","3");
#$r = date("h:i:s");
#$m->insertar_empresa("rrr","k","k",$r,$r,"d","d","d");
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