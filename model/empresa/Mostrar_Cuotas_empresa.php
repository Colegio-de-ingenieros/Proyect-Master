<?php
include('../../config/Crud_bd.php'); 

class MostrarCuota extends Crud_bd{


    function usuario($correo){
        $this->conexion_bd();
        $consulta = "SELECT RFCUsuaEmp FROM usuaemp WHERE binary(CorreoUsuaEmp) =  binary(:user)";
        $parametros = [":user"=>$correo];
        $datos = $this->mostrar($consulta,$parametros);
        $this->cerrar_conexion();
        return $datos;
    }

    function cuotas_disponibles($id){
        $this->conexion_bd();
        $consulta = "SELECT vigenciacuotas.IdVigCuo,MontoVigCuo, IniVigCuo, FinVigCuo,TipoCuota,DocCuota
        FROM usuaemp,empvigcuota,vigenciacuotas,tipovigcuota,tipocuota
        WHERE usuaemp.RFCUsuaEmp = '$id'
        and usuaemp.RFCUsuaEmp = empvigcuota.RFCUsuaEmp
        and empvigcuota.IdVigCuo = vigenciacuotas.IdVigCuo
        and vigenciacuotas.IdVigCuo = tipovigcuota.IdVigCuo
        and tipovigcuota.IdCuota = tipocuota.IdCuota";
        $datos = $this->mostrar($consulta);
        $this->cerrar_conexion();

        return $datos;
    }
    
    function buscar($busqueda,$id){
        $this->conexion_bd();
        $querry = "SELECT  vigenciacuotas.IdVigCuo,MontoVigCuo, IniVigCuo, FinVigCuo,TipoCuota,DocCuota 
        FROM usuaemp,empvigcuota,vigenciacuotas,tipovigcuota,tipocuota
        WHERE usuaemp.RFCUsuaEmp = '$id'
        and usuaemp.RFCUsuaEmp = empvigcuota.RFCUsuaEmp
        and empvigcuota.IdVigCuo = vigenciacuotas.IdVigCuo
        and vigenciacuotas.IdVigCuo = tipovigcuota.IdVigCuo
        and tipovigcuota.IdCuota = tipocuota.IdCuota
        and (MontoVigCuo LIKE :busqueda OR TipoCuota LIKE :busqueda)";
        $resultados = $this->mostrar($querry, [":busqueda" => "%".$busqueda."%"]);
        $this->cerrar_conexion();
        return $resultados;
    }

    function buscar_datos($id){
        $this->conexion_bd();
        $consulta = "SELECT tipovigcuota.IdCuota, MontoVigCuo, IniVigCuo, FinVigCuo, DocCuota 
        FROM vigenciacuotas, tipovigcuota 
        WHERE vigenciacuotas.IdVigCuo='$id' and vigenciacuotas.IdVigCuo=tipovigcuota.IdVigCuo";
        $resultados = $this->mostrar($consulta);
        $this->cerrar_conexion();
        return $resultados;
    }
}
?>