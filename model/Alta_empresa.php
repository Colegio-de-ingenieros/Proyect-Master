<?php
require_once("../config/Crud_bd.php");
class Alta_empresa extends Crud_bd{

    public $sql = [];
    public $parametros = [];

    public function buscar_empresa($rfc)
    {
        $this->conexion_bd();
        $datos = $this->mostrar("SELECT * FROM usuaemp where RFCUsuaEmp =:rfc",[":rfc"=>$rfc]);
        $this->cerrar_conexion();

        if(count($datos) == 0){

            return false;
        }else{
            
            return true;
        }
    }

    public function insertar_empresa($rfc,$nombre,$calle,$hora_inicio,$hora_fin,$razon,$correo,$contra)
    {
        # esta funcion inserta una empresa en la bd
        
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
        $this->sql[] = $sql;
        $this->parametros[] = $parametros;  
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



      
        for ($i=0; $i <count($dias) ; $i++){
            
            $this->sql[]= "INSERT INTO empdias (RFCUsuaEmp,IdLab) VALUES (:rfc,:dia)";
            $this->parametros[] = [":rfc"=>$rfc,":dia"=>$dias[$i]];
        }
        
        
        
    }

    public function obtener_id_area_emp()
    {
        $this->conexion_bd();
        $sql = "SELECT Max(IdAreaEmp) FROM areaempresa";
        $resultado = $this->mostrar($sql);
        $this->cerrar_conexion();
        
        
       
        return $resultado;
    }


 
    public function insertar_areas($nombre,$paterno,$materno,$telefono,$extension,$correo,$tipo_area,$rfc_empresa,$suma)
    {
        
        $arreglo = $this->obtener_id_area_emp();
        $id = "";
        if(is_null($arreglo[0][0]) == 1){
            $id = 1;
            
        }else{
            $id = $arreglo[0][0];
            $id++;
        }

        $id = $id +  $suma;
    

        $sql_area = "INSERT INTO areaEmpresa (IdAreaEmp, NomEncArea, ApePEncArea, ApeMEncArea, TelFEncArea,"
                ."ExtenTelFEncArea, CorreoEncArea) VALUES (:id,:nom,:pa,:ma,:tel,:ext,:correo)";
        $parametros_area = [":id"=>$id, ":nom"=>$nombre,":pa"=>$paterno,
                            ":ma"=>$materno,":tel"=>$telefono,":ext"=>$extension,
                            ":correo"=>$correo];
        $sql_emparea = "INSERT INTO emparea (RFCUsuaEmp,IdAreaEmp) VALUES (:empresa,:area)";
        $parametros_emparea = [":empresa"=>$rfc_empresa, ":area"=>$id];
        
        $sql_tipo = "INSERT INTO areaemptipo (IdArea,IdAreaEmp) VALUES (:tipo,:id)";
        $parametros_tipo = [":tipo"=>$tipo_area,":id"=>$id];

        $this->sql[] = $sql_area;
        $this->parametros[] = $parametros_area;
        $this->sql[] = $sql_emparea;
        $this->parametros[] = $parametros_emparea;
        $this->sql[] = $sql_tipo;
        $this->parametros[] = $parametros_tipo;

        


        
    }

    public function establecer_tipo_usuario($rfc_empresa,$tipo)
    {
        //le coloca el tipo de usario que es la empresa
      
        $sql = "INSERT INTO emptipousua (IdUsua,RFCUsuaEmp) VALUES(:tipo,:rfc)";
        $parametros = [":tipo"=>$tipo,":rfc"=>$rfc_empresa];

        $this->sql[] = $sql;
        $this->parametros[] = $parametros;

    }
    public function establecer_colonia_empresa($rfc_empresa,$id_colonia)
    {
        # relaciona una empresa con una colonia

        $sql = "INSERT INTO usuaemplugares (RFCUsuaEmp,IdColonia) VALUES(:rfc,:colonia)";
        $parametros = [":rfc"=>$rfc_empresa,":colonia"=>$id_colonia];
        $this->sql[] = $sql;
        $this->parametros[] = $parametros;

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
    public function numero_inteligente($rfc_empresa,$correo_empresa)
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

    
        $sql_inteligentes = "INSERT INTO numinteligentes (IdNIntel,NInteligente) VALUES(:consecutivo,:inteligente)";
        $parametros_inteligentes = [":consecutivo"=>$numero,":inteligente"=>$numero_inteligente];

        $sql_usua = "INSERT INTO usuaempnintel (RFCUsuaEmp,IdNIntel) VALUES(:rfc,:consecutivo)";
        $parametros_usua = [":rfc"=>$rfc_empresa,":consecutivo"=>$numero];

        $this->sql[] = $sql_inteligentes;
        $this->parametros[] = $parametros_inteligentes;
        $this->sql[] = $sql_usua;
        $this->parametros[] = $parametros_usua;

       
        
        //$this->mandar_correo($correo_empresa);
     

    }
    public function mandar_correo($destinatario)
    {   
        $remitente = "ecateam22@gmail.com";
        $asunto = "Bienvenido a CISCIG!!!";
        $cuerpo = "El nombre de la empresa hora sera asociado del Colegio de Ingenieros en Sistemas  Computacionales";
        //manda el correo electronico
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $headers = "From:" . $remitente . " \r\n";
        $headers .= "Cc:afgh@somedomain.com \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html\r\n";
        $resultado = mail($destinatario,$asunto,$cuerpo, $headers);
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
    public function inserciones()
    {
        # code...
        $this->conexion_bd();
        $res = $this->insertar_eliminar_actualizar($this->sql,$this->parametros);
        $this->cerrar_conexion();
        return $res;

    }
}

$m = new Alta_empresa();
$r = $m->buscar_empresa("WOY890215GI2");

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