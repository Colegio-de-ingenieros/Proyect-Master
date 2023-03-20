<?php
    include('../../config/Crud_bd.php')

    class Personal{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        //busca el ultimo id de la tabla usuaperso
        function buscarUltimoID(){
            $querry = "SELECT * FROM usuaperso";

            $resultados = $this->base->mostrar($querry);

            //guarda los valores como flotantes para ordenarlos bien
            $aux = [];

            for($i=0; $i<count($resultados);$i++){
                array_push($aux, floatval($resultados[$i]["IdPerso"]));
            }

            sort($aux, 0);

            $id = 0;

            if(count($aux)>= 1){
                $id = $aux[count($aux) - 1];
            }

            return $id;
        }

        //busca el ultimo id de la tabla usuapersoemp
        function buscarUltimoID(){
            $querry = "SELECT * FROM usuapersoemp";

            $resultados = $this->base->mostrar($querry);

            //guarda los valores como flotantes para ordenarlos bien
            $aux = [];

            for($i=0; $i<count($resultados);$i++){
                array_push($aux, floatval($resultados[$i]["IdPerso"]));
            }

            sort($aux, 0);

            $id = 0;

            if(count($aux)>= 1){
                $id = $aux[count($aux) - 1];
            }

            return $id;
        }

        //manda las consultas para insertar en las tablas de certificaciones internas e historicos
        function insertar($idP, $nombre, $apeP, $apeM, $correo, $cedula, $telF, $telM, $fecha, $calle, $pasan, $antece, $veridi, $aviso, $contra){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO usuaperso (IdPerso, NomPerso, ApePPerso, ApeMPerso, CorreoPerso, CedulaPerso, TelFPerso, TelMPerso, FechaNacPerso, CallePerso, PasantiaPerso, AntecePerso, DatosVerPerso, AvisoPerso, ContraPerso)
            VALUES(:id, :nombre, :apeP, :apeM, :correo, :cedula, :telF, :telM, :fecha, :calle, :pasan, :antece, :veridi, :aviso, :contra)";

            $a1 = [":id"=>$idP, ":nombre"=>$nombre, ":apeP"=>$apeP, ":apeM"=>$apeM, ":correo"=>$correo, ":cedula"=>$cedula, ":telF"=>$telF, ":telM"=>$telM, ":fecha"=>$fecha, ":calle"=>$calle, ":pasan"=>$pasan, ":antece"=>$antece, ":veridi"=>$veridi, ":aviso"=>$aviso, ":contra"=>$contra];

            //consulta para la tabla de historicos
            $q2 = "INSERT INTO usuapersoemp (IdPerso, IdEmpPerso)
            VALUES(:id, :idE)";

            $a2 =[":id"=>$idP, ":idE"=>$idEmp];

            //consulta para insertar en la tabla de relacion certh
            $q3 = "INSERT INTO empresaperso (IdEmpPerso, NomEmpPerso, PuestoEmpPerso, CorreoEmpPerso, TelFEmpPerso, ExtenTelFEmpPerso)
            VALUES(:id, :nombreEmp, :puestoEmp, :correoEmp, :telFEmp, :extTelFEmp)";

            $a3 = [":id"=>$idEmp, ":nombreEmp"=>$empresaLab, ":puestoEmp"=>$puestoEmp, ":correoEmp"=>$correoEmp, ":telFEmp"=>$telFEmp, ":extTelFEmp"=>$extTelFEmp];

            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1, $q2, $q3];
            $parametros = [$a1, $a2, $a3];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        
    }
    

?>