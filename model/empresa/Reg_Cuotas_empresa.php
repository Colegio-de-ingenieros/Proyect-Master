<?php
require_once ('../../config/Crud_bd.php'); 

class Cuotas_empresa extends Crud_bd{

    function usuario($correo){
        $this->conexion_bd();
        $consulta = "SELECT RFCUsuaEmp FROM usuaemp WHERE binary(CorreoUsuaEmp) =  binary(:user)";
        $parametros = [":user"=>$correo];
        $datos = $this->mostrar($consulta,$parametros);
        $this->cerrar_conexion();
        return $datos;
    }
    function insertar_cuota($id,$id_cuota,$id_tipo_cuota,$tipobox,$monto,$fecha_inicio,$fecha_fin,$archivo){
        $this->conexion_bd();

        //consultas para la tabla de cuotas
        $q1 = "INSERT INTO vigenciacuotas (IdVigCuo, MontoVigCuo, IniVigCuo, FinVigCuo, DocCuota) 
        VALUES (:id_cuota, :monto, :fecha_inicio, :fecha_fin, :archivo)";

        $a1 = [":id_cuota"=>$id_cuota, ":monto"=>$monto, ":fecha_inicio"=>$fecha_inicio, ":fecha_fin"=>$fecha_fin,":archivo"=>$archivo];

        //consultas para la tabla de relacion de cuotas y empresa
        $q2 = "INSERT INTO empvigcuota (RFCUsuaEmp ,IdVigCuo) 
        VALUES (:idPerso, :idcuota)";

        $a2 = [":idPerso"=>$id, ":idcuota"=>$id_cuota];

        //consultas para el tipo de cuota
        $q3 = "INSERT INTO tipocuota (IdCuota ,TipoCuota) 
        VALUES (:idcuota, :tipobox)";

        $a3 = [":idcuota"=>$id_tipo_cuota, ":tipobox"=>$tipobox];

        //consultas para la tabla de relacion de coutas con el tipo de cuota
        $q4 = "INSERT INTO tipovigcuota (IdVigCuo ,IdCuota) 
        VALUES (:IdVigCuo, :idcuota)";

        $a4 = [":IdVigCuo"=>$id_cuota, ":idcuota"=>$id_tipo_cuota];

        $querry = [$q1, $q2, $q3, $q4];
        $parametros = [$a1, $a2, $a3, $a4];
        //acomoda todo en arreglos para mandarlos al CRUD

        $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
        $this->cerrar_conexion();
        return $ejecucion;
    }
    public function id_cuotas(){
        $this->conexion_bd();

        $sql = "SELECT Count(IdVigCuo) FROM vigenciacuotas";
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
    public function id_tipo_cuota(){
        $this->conexion_bd();

        $sql = "SELECT Count(IdCuota) FROM tipocuota";
        $arreglo = $this->mostrar($sql);
        $this->cerrar_conexion();
    
        $numero = "";
        if(is_null($arreglo[0][0]) == 1){
            $numero = 1;
            
        }else{
            $numero = $arreglo[0][0];
            $numero++;
            
        }
        return $numero;
    }
}



?>