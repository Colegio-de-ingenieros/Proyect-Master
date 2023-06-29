<?php
require_once('../../config/Crud_bd.php');

class Modificar_perfil_empresa extends Crud_bd {

    function buscar_rfc_empresa($user){

        $this->conexion_bd();
        $datos = $this->mostrar("SELECT RFCUsuaEmp FROM usuaemp WHERE binary(CorreoUsuaEmp)= binary(:user)",[':user'=>$user]);
        $this->cerrar_conexion();

        return $datos[0][0];
    }

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

    public function existeCorreo($correo)
    {
        # ve si el correo ya esta en la base
        $this->conexion_bd();
        $dato1 = $this->mostrar("SELECT CorreoPerso FROM usuaperso WHERE binary(CorreoPerso)= binary(:correo)",[':correo'=>$correo]);
        $dato2 = $this->mostrar("SELECT CorreoUsuaEmp FROM usuaemp WHERE binary(CorreoUsuaEmp)= binary(:correo)",[':correo'=>$correo]);
        $dato3 = $this->mostrar("SELECT CorreoT FROM trabajadores WHERE binary(CorreoT)= binary(:correo)",[':correo'=>$correo]);
        $this->cerrar_conexion();

        if(count($dato1) == 0 && count($dato2) == 0 && count($dato3) == 0){
          
            return false;
        }else{
            
            return true;
        }
    }
    /**
     * funcion para actualizar los datos generales
     */
   
    function set_datos_generales($rfc_anterior, $rfc_nuevo,$nombre, $correo, $password, $razon){
        #actualiza datos generales
        $sqls = [];
        $parametros = [];
        $this->conexion_bd();

        
        if(strcmp($rfc_anterior,$rfc_nuevo) != 0){
            # que los dos rfc no son iguales, entonces hubo un cambio
            // cambio en usuaemplugares
            $sqls[] = "UPDATE usuaemplugares SET RFCUsuaEmp=:rfcNuevo WHERE RFCUsuaEmp=:rfcAnterior";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo, ":rfcAnterior"=>$rfc_anterior];
            //cambio en empservicios
            $sqls[] = "UPDATE empservicios SET RFCUsuaEmp=:rfcNuevo WHERE RFCUsuaEmp=:rfcAnterior";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo, ":rfcAnterior"=>$rfc_anterior];
            // cambio en usuaempnintel
            $sqls[] = "UPDATE usuaempnintel SET RFCUsuaEmp=:rfcNuevo WHERE RFCUsuaEmp=:rfcAnterior";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo, ":rfcAnterior"=>$rfc_anterior];
            // cambio emptipousua
            $sqls[] = "UPDATE emptipousua SET RFCUsuaEmp=:rfcNuevo WHERE RFCUsuaEmp=:rfcAnterior";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo, ":rfcAnterior"=>$rfc_anterior];
            // cambio empparticipa
            $sqls[] = "UPDATE empparticipa SET RFCUsuaEmp=:rfcNuevo WHERE RFCUsuaEmp=:rfcAnterior";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo, ":rfcAnterior"=>$rfc_anterior];
            // cambio empvigcuota
            $sqls[] = "UPDATE empvigcuota SET RFCUsuaEmp=:rfcNuevo WHERE RFCUsuaEmp=:rfcAnterior";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo, ":rfcAnterior"=>$rfc_anterior];
            // cambio empaltacur
            $sqls[] = "UPDATE empaltacur SET RFCUsuaEmp=:rfcNuevo WHERE RFCUsuaEmp=:rfcAnterior";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo, ":rfcAnterior"=>$rfc_anterior];
            // cambio emparea
            $sqls[] = "UPDATE emparea SET RFCUsuaEmp=:rfcNuevo WHERE RFCUsuaEmp=:rfcAnterior";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo, ":rfcAnterior"=>$rfc_anterior];
            // cambio empdias
            $sqls[] = "UPDATE empdias SET RFCUsuaEmp=:rfcNuevo WHERE RFCUsuaEmp=:rfcAnterior";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo, ":rfcAnterior"=>$rfc_anterior];
            // cambio usuaempbolsa
            $sqls[] = "UPDATE usuaempbolsa SET RFCUsuaEmp=:rfcNuevo WHERE RFCUsuaEmp=:rfcAnterior";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo, ":rfcAnterior"=>$rfc_anterior];
        }
        if(empty($password)){

            $sqls[] = "UPDATE usuaemp SET RFCUsuaEmp=:rfcNuevo, NomUsuaEmp=:nombre, RazonUsuaEmp=:razon, CorreoUsuaEmp=:correo
                WHERE RFCUsuaEmp=:rfcAnterior ";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo,":nombre"=>$nombre, ":razon"=>$razon, ":correo"=>$correo, ":rfcAnterior"=>$rfc_anterior ];
        }else{
            $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $sqls[] = "UPDATE usuaemp SET RFCUsuaEmp=:rfcNuevo, NomUsuaEmp=:nombre, RazonUsuaEmp=:razon, CorreoUsuaEmp=:correo, ContraUsuaEmp=:contra
                WHERE RFCUsuaEmp=:rfcAnterior ";
            $parametros[] = [":rfcNuevo"=>$rfc_nuevo,":nombre"=>$nombre, ":razon"=>$razon, ":correo"=>$correo, ":contra"=>$password_hash ,":rfcAnterior"=>$rfc_anterior ];
        }

        $res = $this->insertar_eliminar_actualizar($sqls,$parametros);
        $this->cerrar_conexion();

        return $res;
        
    }
    function set_domicilio($rfc,$calle,$colonia){
        // coloca el domicilio en las tablas correpondientes
        $sqls = [];
        $parametros = [];
        $this->conexion_bd();
        
        $sqls[] = "UPDATE usuaemp SET CalleUsuaEmp=:calle WHERE RFCUsuaEmp=:rfc";
        $parametros[] = [":rfc"=>$rfc, ":calle"=>$calle];

        $sqls[] = "UPDATE usuaemplugares SET IdColonia=:colonia WHERE RFCUsuaEmp=:rfc";
        $parametros[] = [":colonia"=>$colonia, ":rfc"=>$rfc];
        
        $res = $this->insertar_eliminar_actualizar($sqls,$parametros);
        $this->cerrar_conexion();

        return $res;
        
    }

    public function set_horario($rfc,$dias,$hora_inicio, $hora_fin )
    {
      
        $sqls = [];
        $parametros = [];
        $this->conexion_bd();

        $sqls[] = "UPDATE usuaemp SET HrIniUsuaEmp=:inicio, HrFinUsuaEmp=:fin WHERE RFCUsuaEmp=:rfc";
        $parametros[] = [":rfc"=>$rfc, ":inicio"=>$hora_inicio, ":fin"=>$hora_fin];

        $sqls[] = "DELETE FROM empdias WHERE RFCUsuaEmp=:rfc ";
        $parametros[] = [":rfc"=>$rfc];

        for ($i=0; $i <count($dias) ; $i++){
            
            $sqls[]= "INSERT INTO empdias (RFCUsuaEmp,IdLab) VALUES (:rfc,:dia)";
            $parametros[] = [":rfc"=>$rfc,":dia"=>$dias[$i]];
        }

        $res = $this->insertar_eliminar_actualizar($sqls,$parametros);
        $this->cerrar_conexion();

        return $res;
        
    }

    function actualizar_area($id_area, $nombre, $paterno, $materno, $telefono, $extension, $correo){
        $this->conexion_bd();
        $sql = "UPDATE areaempresa SET NomEncArea=:nombre, ApePEncArea=:paterno, ApeMEncArea=:materno, TelFEncArea=:telefono,
                ExtenTelFEncArea=:ext, CorreoEncArea=:correo WHERE IdAreaEmp=:id";
        $parametros = [":id"=>$id_area, ":nombre"=>$nombre, ":paterno"=>$paterno, ":materno"=>$materno,
                         ":telefono"=>$telefono, ":ext"=>$extension, ":correo"=>$correo
                        ];

        $res = $this->insertar_eliminar_actualizar($sql,$parametros);
        $this->cerrar_conexion();

        return $res;

    }
    function insertar_area($tipo,$rfc,$nombre, $paterno, $materno, $telefono, $extension, $correo){
        $sqls = [];
        $parametros = [];
        $this->conexion_bd();
        
        $id = $this->mostrar("SELECT id FROM (SELECT MAX(IdAreaEmp)+1 as id  FROM  areaempresa) AS tabla");
        $id_area = $id[0][0];

        $sqls[] = "INSERT INTO areaempresa (IdAreaEmp, NomEncArea, ApePEncArea, ApeMEncArea, TelFEncArea, ExtenTelFEncArea, CorreoEncArea) 
                    VALUES (:id,:nombre,:paterno,:materno,:telefono,:ext,:correo)";

        $parametros[] = [":id"=>$id_area ,":nombre"=>$nombre, ":paterno"=>$paterno, ":materno"=>$materno,
                        ":telefono"=>$telefono, ":ext"=>$extension, ":correo"=>$correo
                        ];
        $sqls[] = "INSERT INTO emparea (RFCUsuaEmp,IdAreaEmp) VALUES (:rfc,:id)";    
        $parametros[] = [":rfc"=>$rfc,":id"=>$id_area];   
        
        $sqls[] = "INSERT INTO areaemptipo (IdArea,IdAreaEmp) VALUES (:tipo,:id)";
        $parametros[] = [":tipo"=>$tipo,":id"=>$id_area]; 
      

        $res = $this->insertar_eliminar_actualizar($sqls,$parametros);
        $this->cerrar_conexion();

        return $res;
    }
    function eliminar_area($rfc,$id_area, $tipo){

        $sqls = [];
        $parametros = [];
        $this->conexion_bd();

       

        $sqls[] = "DELETE FROM emparea WHERE RFCUsuaEmp=:rfc AND IdAreaEmp=:id)";    
        $parametros[] = [":rfc"=>$rfc,":id"=>$id_area];   

        $sqls[] = "DELETE FROM areaemptipo WHERE  IdArea=:tipo AND IdAreaEmp=:id ";
        $parametros[] = [":tipo"=>$tipo,":id"=>$id_area]; 

        $sqls[] = "DELETE FROM areaempresa WHERE IdAreaEmp=:id";
        $parametros[] = [":id"=>$id_area];

        $res = $this->insertar_eliminar_actualizar($sqls,$parametros);
        $this->cerrar_conexion();

        return $res;
        
    }


    function set_acuerdo($rfc,$acepta){

        $this->conexion_bd();
        $sql = "UPDATE usuaemp SET acuerdoEmp=:acepta WHERE RFCUsuaEmp=:rfc";
        $parametros = [":rfc"=>$rfc, ":acepta"=>$acepta];
        $res = $this->insertar_eliminar_actualizar($sql,$parametros);
        $this->cerrar_conexion();

        return $res;
    }
    

}





?>