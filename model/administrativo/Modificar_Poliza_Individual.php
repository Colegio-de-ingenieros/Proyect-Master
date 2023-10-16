<?php
require_once('../../config/Crud_bd.php');

class Modificar_Poliza_Individual extends Crud_bd{

    public function datos_generales($id_poliza) {
        $this->conexion_bd();
        $consulta = "SELECT NomElaPol, ApePElaPol, ApeMElaPol, CoceptoGral, DATE_FORMAT(FechaPolGral,'%d/%m/%Y') as FechaPolGral  FROM polgeneral WHERE polgeneral.IdPolGral = :id";
        $resultados = $this->mostrar($consulta,[":id"=>$id_poliza]);
        $this->cerrar_conexion();

  

        return $resultados;
    }

    public function polizas_individuales($id_poliza){
        $this->conexion_bd();
        $consulta = "SELECT indpolacc.IdPolAcc ,polindividual.IdPolInd, DesPolInd, Monto, DesDocInd  from polindividual 
                    INNER JOIN indgralpol on indgralpol.IdPolInd = polindividual.IdPolInd AND indgralpol.IdPolGral = :id
                    INNER JOIN indpolacc on polindividual.IdPolInd = indpolacc.IdPolInd";
                    
        $resultados = $this->mostrar($consulta,[":id"=>$id_poliza]);
        $this->cerrar_conexion();

        $resultado_procesado = [];

        for($i=0; $i<count($resultados);$i++){
            $filas = $resultados[$i];
            $fila = array();
            for ($j=0; $j < 5 ; $j++) { 
                
                array_push($fila, $filas[$j]);

            }

            $resultado_procesado[$i] = $fila;
            
        }


        return $resultado_procesado;
    }

    public function propietario_poliza($id_poliza){

        # ver si es de una empresa 
        $datos = [];
        $this->conexion_bd();
        $datos = $this->mostrar("SELECT CONCAT('Emp. ',usuaemp.NomUsuaEmp) FROM usuaemp
        INNER JOIN (SELECT RFCUsuaEmp FROM empgralpol WHERE IdPolGral =  :id) as tabla on tabla.RFCUsuaEmp = usuaemp.RFCUsuaEmp",[':id'=>$id_poliza]);

        if(count($datos) == 0){
            
            $datos = $this->mostrar("SELECT CONCAT('Asoc. ',usuaperso.NomPerso,' ',COALESCE(usuaperso.ApePPerso, ''),' ',COALESCE(usuaperso.ApeMPerso, '')) FROM usuaperso 
            INNER JOIN (SELECT IdPerso FROM persogralpol WHERE IdPolGral = :id) as tabla on tabla.IdPerso = usuaperso.IdPerso",[':id'=>$id_poliza]);
        }
        $this->cerrar_conexion();

        return $datos;

    }
}






?>