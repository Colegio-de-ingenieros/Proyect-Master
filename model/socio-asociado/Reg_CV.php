<?php
    include('../../config/Crud_bd.php');

    class funciones_cv{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }
        function eliminar_persobolsa_cv($id){
            $q2 = "DELETE FROM persobolsacv WHERE IdPerso = :id"; 
            $a2= [":id"=>$id];
            $querry = [$q2];
            $parametros = [$a2];
    
            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        function eliminar_bolsa_cv($id){
            $q2 = "DELETE FROM bolsacv WHERE IdBolCv = :id"; 
            $a2= [":id"=>$id];
            $querry = [$q2];
            $parametros = [$a2];
    
            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        function eliminar_expaca_cv($id){
            $q2 = "DELETE FROM expacacv WHERE IdBolCv = :id"; 
            $a2= [":id"=>$id];
            $querry = [$q2];
            $parametros = [$a2];
    
            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        function eliminar_exppro_cv($id){
            $q2 = "DELETE FROM expprocv WHERE IdBolCv = :id"; 
            $a2= [":id"=>$id];
            $querry = [$q2];
            $parametros = [$a2];
    
            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        function eliminar_expacademica($id){
            $q2 = "DELETE FROM expacademica WHERE IdExpAca = :id"; 
            $a2= [":id"=>$id];
            $querry = [$q2];
            $parametros = [$a2];
    
            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        function eliminar_expprofesional($id){
            $q2 = "DELETE FROM expprofesional WHERE IdExpP = :id"; 
            $a2= [":id"=>$id];
            $querry = [$q2];
            $parametros = [$a2];
    
            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        

        function seleccion_bolsa_cv ($id){
            $consulta = "SELECT bolsacv.IdBolCv FROM usuaperso,persobolsacv,bolsacv
            WHERE usuaperso.IdPerso = '$id' 
            and usuaperso.IdPerso =persobolsacv.IdPerso
            and persobolsacv.IdBolCv = bolsacv.IdBolCv;";
            $datos = $this->base->mostrar($consulta);
            return $datos;
        }
        function seleccion_xp_academica ($id){
            $consulta = "SELECT expacademica.IdExpAca FROM usuaperso,persobolsacv,bolsacv,expacacv,expacademica
            WHERE usuaperso.IdPerso = '$id' 
            and usuaperso.IdPerso =persobolsacv.IdPerso
            and persobolsacv.IdBolCv = bolsacv.IdBolCv
            and bolsacv.IdBolCv = expacacv.IdBolCv
            and expacacv.IdExpAca = expacademica.IdExpAca;";
            $datos = $this->base->mostrar($consulta);
            return $datos;
        }
        function seleccion_xp_profesional ($id){
            $consulta = "SELECT expprofesional.IdExpP FROM usuaperso,persobolsacv,bolsacv,expprocv,expprofesional
            WHERE usuaperso.IdPerso = '$id' 
            and usuaperso.IdPerso =persobolsacv.IdPerso
            and persobolsacv.IdBolCv = bolsacv.IdBolCv
            and persobolsacv.IdBolCv = expprocv.IdBolCv 
            and expprocv.IdExpP = expprofesional.IdExpP ;";
            $datos = $this->base->mostrar($consulta);
            return $datos;
        }

        function insertar_expprocv($ide, $idb){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO expprocv (IdExpP, IdBolCv)
            VALUES(:ide, :idb)";

            $a1 = [":ide"=>$ide, ":idb"=>$idb];

            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertar_persobolsa($idp, $idb){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO persobolsacv (IdPerso, IdBolCv)
            VALUES(:idp, :idb)";

            $a1 = [":idp"=>$idp, ":idb"=>$idb];

            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertar_expacacv($ide, $idb){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO expacacv (IdExpAca, IdBolCv)
            VALUES(:ide, :idb)";

            $a1 = [":ide"=>$ide, ":idb"=>$idb];

            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertar_exppro($idb, $empresa, $inicio, $fin, $puesto, $actividades){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO expprofesional (IdExpP, EmpExpP, IniExpP, FinExpP, PuestoExpP, ActExpP)
            VALUES(:id, :empresa, :inicio, :fin, :puesto, :actividades)";

            $a1 = [":id"=>$idb, ":empresa"=>$empresa, ":inicio"=>$inicio, ":fin"=>$fin, ":puesto"=>$puesto, ":actividades"=>$actividades];

            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertar_expaca($idb, $carrera, $cedula){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO expacademica (IdExpAca, Carrera, NumCedAca)
            VALUES(:id, :carrera, :cedula)";

            $a1 = [":id"=>$idb, ":carrera"=>$carrera, ":cedula"=>$cedula];

            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertar_bolsacv($idb, $descripcion, $residencia, $salario){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO bolsacv (IdBolCv, DesProCv, ResidenciaCv, ExpSalCv)
            VALUES(:id, :descripcion, :residencia, :salario)";

            $a1 = [":id"=>$idb, ":descripcion"=>$descripcion, ":residencia"=>$residencia, ":salario"=>$salario];

            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function agregar_ceros($numero, $lon){
            $ceros = "";
            $numero_nuevo="";
            for ($i=0; $i < $lon ; $i++) { 
                $numero_nuevo = $ceros . $numero;
                if(strlen($numero_nuevo) == $lon){
                    break;
                }else{
                    $ceros = $ceros . "0";
                }
            }
            return $numero_nuevo;
        }

        function buscarUltimoIdexpprofesional(){
            $querry = "SELECT * FROM expprofesional";

            $resultados = $this->base->mostrar($querry);

            //guarda los valores como flotantes para ordenarlos bien
            $aux = [];

            for($i=0; $i<count($resultados);$i++){
                array_push($aux, floatval($resultados[$i]["IdExpP"]));
            }

            sort($aux, 0);

            $id = 0;

            if(count($aux)>= 1){
                $id = $aux[count($aux) - 1];
            }
            $id = $id + 1;
            return $id;
        }

        function buscarUltimoIdexpacademica(){
            $querry = "SELECT * FROM expacademica";

            $resultados = $this->base->mostrar($querry);

            //guarda los valores como flotantes para ordenarlos bien
            $aux = [];

            for($i=0; $i<count($resultados);$i++){
                array_push($aux, floatval($resultados[$i]["IdExpAca"]));
            }

            sort($aux, 0);

            $id = 0;

            if(count($aux)>= 1){
                $id = $aux[count($aux) - 1];
            }
            $id = $id + 1;
            return $id;
        }

        function buscarUltimoIdbolsacv(){
            $querry = "SELECT * FROM bolsacv";

            $resultados = $this->base->mostrar($querry);

            //guarda los valores como flotantes para ordenarlos bien
            $aux = [];

            for($i=0; $i<count($resultados);$i++){
                array_push($aux, floatval($resultados[$i]["IdBolCv"]));
            }

            sort($aux, 0);

            $id = 0;

            if(count($aux)>= 1){
                $id = $aux[count($aux) - 1];
            }
            $id = $id + 1;
            return $id;
        }

        function extraer_datos_usuario($id){
            $query = "SELECT usuaperso.NomPerso, 
                            usuaperso.ApePPerso, 
                            usuaperso.ApeMPerso, 
                            usuaperso.FechaNacPerso, 
                            usuaperso.TelMPerso, 
                            usuaperso.CallePerso, 
                            usuaperso.CorreoPerso, 
                            colonias.nomcolonia, 
                            municipios.nommunicipio, 
                            estados.nomestado 
                        FROM usuaperso, persolugares, colonias, municipios, estados 
                        WHERE usuaperso.IdPerso = :id 
                        and usuaperso.IdPerso = persolugares.IdPerso 
                        and persolugares.IdColonia = colonias.IdColonia 
                        and colonias.idmunicipio = municipios.idmunicipio 
                        and municipios.idestado = estados.idestado";
            $array = [":id"=>$id];
            $resultados = $this->base->mostrar($query, $array);

            if ($resultados != null){
                return $resultados;
            }
            else{
                return "No se encontraron resultados";
            }
        }
    }
?>