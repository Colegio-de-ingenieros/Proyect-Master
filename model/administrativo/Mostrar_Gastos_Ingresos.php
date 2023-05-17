<?php
    include('../../config/Crud_bd.php');

    class Actividad_Seg_Tabla_Montos extends Crud_bd{
        public function buscar_perso($id){
            $this->conexion_bd();
            $sql = "SELECT CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso)
                    FROM persoparticipa, usuaperso
                    WHERE persoparticipa.IdParP = :id AND persoparticipa.IdPerso = usuaperso.IdPerso";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_empresa($id){
            $this->conexion_bd();
            $sql = "SELECT NomUsuaEmp
                    FROM empparticipa, usuaemp
                    WHERE empparticipa.IdParE= :id AND empparticipa.RFCUsuaEmp = usuaemp.RFCUsuaEmp";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_instr($id){
            $this->conexion_bd();
            $sql = "SELECT CONCAT_WS(' ', 'Instr.', instructor.NomIns, instructor.ApePIns, instructor.ApeMIns)
                    FROM insparticipa, instructor
                    WHERE insparticipa.IdParI= :id AND insparticipa.ClaveIns = instructor.ClaveIns";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_gastos_perso($id){
            $this->conexion_bd();
            $sql = "SELECT controlgas.IdGas, tipogastos.TipoGas, MontoGas,  DATE_FORMAT(FechaGas, '%d/%m/%Y') FechaGas
                    FROM persoparticipa, persogastos, controlgas, contipogas, tipogastos
                    WHERE persoparticipa.IdParP= :id AND persoparticipa.IdParP=persogastos.IdParP AND persogastos.IdGas=controlgas.IdGas AND
                    controlgas.IdGas=contipogas.IdGas AND contipogas.IdGasto = tipogastos.IdGasto ORDER BY FechaGas ASC";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_gastos_empresa($id){
            $this->conexion_bd();
            $sql = "SELECT empparticipa.IdParE, tipogastos.TipoGas, controlgas.IdGas, MontoGas,  DATE_FORMAT(FechaGas, '%d/%m/%Y') FechaGas
                    FROM empparticipa, empgastos, controlgas, contipogas, tipogastos
                    WHERE empparticipa.IdParE= :id AND empparticipa.IdParE=empgastos.IdParE AND empgastos.IdGas=controlgas.IdGas AND
                    controlgas.IdGas=contipogas.IdGas AND contipogas.IdGasto = tipogastos.IdGasto ORDER BY FechaGas DESC";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_gastos_instr($id){
            $this->conexion_bd();
            $sql = "SELECT insparticipa.IdParI, tipogastos.TipoGas, controlgas.IdGas, MontoGas,  DATE_FORMAT(FechaGas, '%d/%m/%Y') FechaGas
                    FROM insparticipa, insgastos, controlgas, contipogas, tipogastos
                    WHERE insparticipa.IdParI= :id AND insparticipa.IdParI=insgastos.IdParI AND insgastos.IdGas=controlgas.IdGas AND
                    controlgas.IdGas=contipogas.IdGas AND contipogas.IdGasto = tipogastos.IdGasto ORDER BY FechaGas DESC";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_ingresos_perso($id){
            $this->conexion_bd();
            $sql = "SELECT controlingre.IdIngre, MontoIngre,  DATE_FORMAT(FechaIngre, '%d/%m/%Y') FechaIngre
                    FROM persoparticipa, persoingresos, controlingre
                    WHERE persoparticipa.IdParP= :id AND persoparticipa.IdParP=persoingresos.IdParP AND persoingresos.IdIngre=controlingre.IdIngre ORDER BY FechaIngre ASC";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_ingresos_empresa($id){
            $this->conexion_bd();
            $sql = "SELECT controlingre.IdIngre, MontoIngre,  DATE_FORMAT(FechaIngre, '%d/%m/%Y') FechaIngre
                    FROM empparticipa, empingresos, controlingre
                    WHERE empparticipa.IdParE= :id AND empparticipa.IdParE=empingresos.IdParE AND empingresos.IdIngre=controlingre.IdIngre ORDER BY FechaIngre ASC";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_ingresos_instr($id){
            $this->conexion_bd();
            $sql = "SELECT controlingre.IdIngre, MontoIngre,  DATE_FORMAT(FechaIngre, '%d/%m/%Y') FechaIngre
                    FROM insparticipa, insingresos, controlingre
                    WHERE insparticipa.IdParI= :id AND insparticipa.IdParI=insingresos.IdParI AND insingresos.IdIngre=controlingre.IdIngre ORDER BY FechaIngre ASC";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_gasto($idGas){
            $this->conexion_bd();
            $sql = "SELECT MontoGas, FechaGas, tipogastos.IdGasto, tipogastos.TipoGas
                    FROM controlgas, contipogas, tipogastos
                    WHERE controlgas.IdGas = :id AND controlgas.IdGas = contipogas.IdGas  AND contipogas.IdGasto = tipogastos.IdGasto";
            $arre = [":id"=>$idGas];
            $datos = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            $tipoGastos= $this->gastos();
            $resultado=array_merge($datos, $tipoGastos);
            return $resultado;
        }

        public function gastos(){
            $this->conexion_bd();
            $sql = "SELECT*
                    FROM tipogastos";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_ingreso($idIngre){
            $this->conexion_bd();
            $sql = "SELECT MontoIngre, FechaIngre
                    FROM controlingre
                    WHERE controlingre.IdIngre = :id";
            $arre = [":id"=>$idIngre];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }



       

    }

?>