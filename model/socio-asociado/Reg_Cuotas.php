<?php
require_once ('../../config/Crud_bd.php'); 

class BuscarId extends Crud_bd{
    function usuario($correo){
        $this->conexion_bd();
        $consulta = "SELECT IdPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
        $parametros = [":user"=>$correo];
        $datos = $this->mostrar($consulta,$parametros);
        $this->cerrar_conexion();
        return $datos;
    }
    function insertar_cuota($id,$id_cuota,$tipobox,$monto,$fecha_inicio,$fecha_fin,$archivo){
        $this->conexion_bd();

        //consultas para la tabla de cuotas
        $q1 = "INSERT INTO vigenciacuotas (IdVigCuo, MontoVigCuo, IniVigCuo, FinVigCuo) 
        VALUES (:id_cuota, :monto, :fecha_inicio, :fecha_fin)";

        $a1 = [":id_cuota"=>$id_cuota, ":monto"=>$monto, ":fecha_inicio"=>$fecha_inicio, ":fecha_fin"=>$fecha_fin];

        //consultas para la tabla de relacion de cuotas y personas
        $q2 = "INSERT INTO persovigcuota (IdPerso ,IdVigCuo) 
        VALUES (:idPerso, :idcuota)";

        $a2 = [":idPerso"=>$id, ":idcuota"=>$id_cuota];

        if ($tipobox == "Membresía"){
            //consultas para la tabla de relacion de coutas con el tipo de cuota
            $q3 = "INSERT INTO tipovigcuota (IdVigCuo ,IdCuota) 
            VALUES (:IdVigCuo, :idcuota)";

            $a3 = [":IdVigCuo"=>$id_cuota, ":idcuota"=>"1"];
        }
        else if ($tipobox == "Curso"){
            //consultas para la tabla de relacion de coutas con el tipo de cuota
            $q3 = "INSERT INTO tipovigcuota (IdVigCuo ,IdCuota) 
            VALUES (:IdVigCuo, :idcuota)";

            $a3 = [":IdVigCuo"=>$id_cuota, ":idcuota"=>"2"];
        }else if($tipobox == "Certificación"){
            //consultas para la tabla de relacion de coutas con el tipo de cuota
            $q3 = "INSERT INTO tipovigcuota (IdVigCuo ,IdCuota) 
            VALUES (:IdVigCuo, :idcuota)";

            $a3 = [":IdVigCuo"=>$id_cuota, ":idcuota"=>"3"];
        }

        $querry = [$q1, $q2, $q3];
        $parametros = [$a1, $a2, $a3];
        //acomoda todo en arreglos para mandarlos al CRUD

        $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
        $this->cerrar_conexion();
        return $ejecucion;
    }
    public function id_cuotas(){
        $this->conexion_bd();

        $sql = "SELECT MAX(IdVigCuo) FROM vigenciacuotas";
        $arreglo = $this->mostrar($sql);
        $this->cerrar_conexion();
    
        $numero = "";
        if(is_null($arreglo[0][0]) == 1){
            $numero = 1;
            
        }else{
            $numero = $arreglo[0][0];
            $numero++;
            
        }

        $idCuota = $this->agregar_ceros($numero, 6);
        return $idCuota;
    }
    public function agregar_ceros($numero, $lon){
        $ceros = "";
        $numero_nuevo="";
        for ($i=0; $i < $lon ; $i++) { 
            $numero_nuevo = $ceros .$numero;
            if(strlen($numero_nuevo) == $lon){
                break;
            }else{
                $ceros = $ceros . "0";
            }

        }
        return $numero_nuevo;
    }
}



?>