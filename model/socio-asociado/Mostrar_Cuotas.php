<?php
include('../../config/Crud_bd.php'); 

class MostrarCuota extends Crud_bd{


    function usuario($correo){
        $this->conexion_bd();
        $consulta = "SELECT IdPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
        $parametros = [":user"=>$correo];
        $datos = $this->mostrar($consulta,$parametros);
        $this->cerrar_conexion();
        return $datos;
    }

    function cuotas_disponibles($id){
        $this->conexion_bd();
        $consulta = "SELECT vigenciacuotas.IdVigCuo,MontoVigCuo, DATE_FORMAT(IniVigCuo, '%d/%m/%Y') IniVigCuo, DATE_FORMAT(FinVigCuo, '%d/%m/%Y') FinVigCuo,TipoCuota
        FROM usuaperso,persovigcuota,vigenciacuotas,tipovigcuota,tipocuota
        WHERE usuaperso.IdPerso = '$id'
        and usuaperso.IdPerso = persovigcuota.IdPerso
        and persovigcuota.IdVigCuo = vigenciacuotas.IdVigCuo
        and vigenciacuotas.IdVigCuo = tipovigcuota.IdVigCuo
        and tipovigcuota.IdCuota = tipocuota.IdCuota";
        $datos = $this->mostrar($consulta);
        $this->cerrar_conexion();

        return $datos;
    }
    
    function buscar($busqueda,$id){
        $this->conexion_bd();
        $consulta = "SELECT vigenciacuotas.IdVigCuo,MontoVigCuo, DATE_FORMAT(IniVigCuo, '%d/%m/%Y') IniVigCuo, DATE_FORMAT(FinVigCuo, '%d/%m/%Y') FinVigCuo,TipoCuota
        FROM usuaperso,persovigcuota,vigenciacuotas,tipovigcuota,tipocuota
        WHERE usuaperso.IdPerso = '$id'
        and usuaperso.IdPerso = persovigcuota.IdPerso
        and persovigcuota.IdVigCuo = vigenciacuotas.IdVigCuo
        and vigenciacuotas.IdVigCuo = tipovigcuota.IdVigCuo
        and tipovigcuota.IdCuota = tipocuota.IdCuota
        and (MontoVigCuo LIKE :busqueda OR TipoCuota LIKE :busqueda)";
        $resultados = $this->mostrar($consulta, [":busqueda" => "%".$busqueda."%"]);
        $this->cerrar_conexion();
        return $resultados;
    }

    function buscar_datos($id){
        $this->conexion_bd();
        $consulta = "SELECT tipovigcuota.IdCuota, MontoVigCuo,  DATE_FORMAT(IniVigCuo, '%d/%m/%Y') IniVigCuo, DATE_FORMAT(FinVigCuo, '%d/%m/%Y') FinVigCuo
        FROM vigenciacuotas, tipovigcuota 
        WHERE vigenciacuotas.IdVigCuo='$id' and vigenciacuotas.IdVigCuo=tipovigcuota.IdVigCuo";
        $resultados = $this->mostrar($consulta);
        $this->cerrar_conexion();
        return $resultados;
    }

    public function id_cuotas($id){
        $this->conexion_bd();

        $consulta = "SELECT IdVigCuo FROM persovigcuota WHERE binary(IdPerso) =  binary(:user)";
        $parametros = [":user"=>$id];
        $datos = $this->mostrar($consulta,$parametros);
        $this->cerrar_conexion();
        return $datos;
    }

}
?>