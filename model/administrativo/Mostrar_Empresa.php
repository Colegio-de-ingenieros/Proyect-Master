<?php
include('../../config/Crud_bd.php'); 

class MostrarEmpresa{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }
    function getRFC($intel){
        $querry = "SELECT RFCUsuaEmp
        FROM usuaempnintel,numinteligentes
        WHERE usuaempnintel.IdNIntel = numinteligentes.IdNIntel AND NInteligente = :inteligente";
        $resultados = $this->base->mostrar($querry, [":inteligente" => $intel]);
        return $resultados;
    }
    function mostrarEmpresa($rfc){
        $querry = "SELECT * FROM usuaemp WHERE RFCUsuaEmp = :rfc";
        $resultados = $this->base->mostrar($querry, [":rfc" => $rfc]);
        return $resultados;
    }
    function mostrarColonia($id){
        $q3 = "SELECT * FROM `colonias`,`usuaemplugares` ,`municipios`, `estados` 
        WHERE `usuaemplugares`.`IdColonia`=`colonias`.`IdColonia` 
        AND `colonias`.`idmunicipio`= `municipios`.`idmunicipio` 
        AND `municipios`.`idestado` = `estados`.`idestado` 
        AND `usuaemplugares`.`RFCUsuaEmp`= :id";
        $resultados4 = $this->base->mostrar($q3, [":id" => $id]);
        return $resultados4;
    }
    function getDias($id){
        $q4 = "SELECT Dia FROM empdias,diaslaborales
        WHERE empdias.IdLab=diaslaborales.IdLab and`RFCUsuaEmp`= :id";
        $resultados5 = $this->base->mostrar($q4, [":id" => $id]);
        return $resultados5;
    }
    function mostrarAreasRH($rfc){
        $querry = "SELECT * FROM emparea,areaempresa, areaemptipo, areas 
        WHERE emparea.IdAreaEmp=areaempresa.IdAreaEmp  AND areaemptipo.IdAreaEmp = areaempresa.IdAreaEmp AND areaemptipo.IdArea =areas.IdArea 
        AND RFCUsuaEmp = :rfc AND TipoArea ='Recursos Humanos'" ;
        $resultados = $this->base->mostrar($querry, [":rfc" => $rfc]);
        return $resultados;
    }
    function mostrarAreasTI($rfc){
        $querry = "SELECT * FROM emparea,areaempresa, areaemptipo, areas 
        WHERE emparea.IdAreaEmp=areaempresa.IdAreaEmp  AND areaemptipo.IdAreaEmp = areaempresa.IdAreaEmp AND areaemptipo.IdArea =areas.IdArea 
        AND RFCUsuaEmp = :rfc AND TipoArea ='TI'" ;
        $resultados = $this->base->mostrar($querry, [":rfc" => $rfc]);
        return $resultados;
    }
    function mostrarAreasCap($rfc){
        $querry = "SELECT * FROM emparea,areaempresa, areaemptipo, areas 
        WHERE emparea.IdAreaEmp=areaempresa.IdAreaEmp  AND areaemptipo.IdAreaEmp = areaempresa.IdAreaEmp AND areaemptipo.IdArea =areas.IdArea 
        AND RFCUsuaEmp = :rfc AND TipoArea ='Capacitación'" ;
        $resultados = $this->base->mostrar($querry, [":rfc" => $rfc]);
        return $resultados;
    }
    function cuotas_disponibles($id){
        $consulta = "SELECT vigenciacuotas.IdVigCuo,MontoVigCuo, DATE_FORMAT(IniVigCuo, '%d/%m/%Y') IniVigCuo, DATE_FORMAT(FinVigCuo, '%d/%m/%Y') FinVigCuo,TipoCuota, EstatusVigCuo
        FROM usuaemp,empvigcuota,vigenciacuotas,tipovigcuota,tipocuota
        WHERE usuaemp.RFCUsuaEmp = '$id'
        and usuaemp.RFCUsuaEmp = empvigcuota.RFCUsuaEmp
        and empvigcuota.IdVigCuo = vigenciacuotas.IdVigCuo
        and vigenciacuotas.IdVigCuo = tipovigcuota.IdVigCuo
        and tipovigcuota.IdCuota = tipocuota.IdCuota";
        $resultados = $this->base->mostrar($consulta);
        return $resultados;
    }
    function buscar($busqueda,$id){
        $querry = "SELECT  vigenciacuotas.IdVigCuo,MontoVigCuo, DATE_FORMAT(IniVigCuo, '%d/%m/%Y') IniVigCuo, DATE_FORMAT(FinVigCuo, '%d/%m/%Y') FinVigCuo,TipoCuota, EstatusVigCuo
        FROM usuaemp,empvigcuota,vigenciacuotas,tipovigcuota,tipocuota
        WHERE usuaemp.RFCUsuaEmp = '$id'
        and usuaemp.RFCUsuaEmp = empvigcuota.RFCUsuaEmp
        and empvigcuota.IdVigCuo = vigenciacuotas.IdVigCuo
        and vigenciacuotas.IdVigCuo = tipovigcuota.IdVigCuo
        and tipovigcuota.IdCuota = tipocuota.IdCuota
        and (MontoVigCuo LIKE :busqueda OR TipoCuota LIKE :busqueda)";
        $resultados = $this->base->mostrar($querry, [":busqueda" => "%".$busqueda."%"]);
        return $resultados;
    }
    function buscar_datos($id){
        $consulta = "SELECT tipovigcuota.IdCuota, MontoVigCuo, DATE_FORMAT(IniVigCuo, '%d/%m/%Y') IniVigCuo, DATE_FORMAT(FinVigCuo, '%d/%m/%Y') FinVigCuo,TipoCuota, EstatusVigCuo, ComeVigCuo 
        FROM vigenciacuotas, tipovigcuota, tipocuota 
        WHERE vigenciacuotas.IdVigCuo='$id' and vigenciacuotas.IdVigCuo=tipovigcuota.IdVigCuo and tipovigcuota.IdCuota = tipocuota.IdCuota";
        $resultados = $this->base->mostrar($consulta);
        return $resultados;
    }
    function modificar_cuota($id,$comentario,$valor){
        $q1="UPDATE vigenciacuotas SET  ComeVigCuo = :comentario, EstatusVigCuo=:valor WHERE IdVigCuo = :id";
        $a1 = [":comentario"=>$comentario, ":valor"=>$valor, ":id"=>$id];
        $querry = [$q1];
        $arre = [$a1];
        $this->base->insertar_eliminar_actualizar($querry, $arre);
    }
}
$obj = new MostrarEmpresa();
$obj->instancias();
?>