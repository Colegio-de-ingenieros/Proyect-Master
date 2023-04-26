<?php
    include('../../config/Crud_bd.php');

    class NuevoCurso{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        function buscarClave($clave){
            $querry = "SELECT * FROM cursos  WHERE ClaveCur = :clave";
            $arre = [":clave"=>$clave];
            $resultados = $this->base->mostrar($querry, $arre);

            if($resultados != null){
                return true;
            }
            else{
                return false;
            }
        }
        //Inserta  la tabla cursos
        function insertaCurso($clave,$nombre,$objetivo,$duracion){
            $q1 = "INSERT INTO cursos (ClaveCur, NomCur, ObjCur, DuracionCur,EstatusCur)
            VALUES(:clave, :nombre, :objetivo, :duracion, :estatus)";
            $a1 = [":clave"=>$clave, ":nombre"=>$nombre, ":objetivo"=>$objetivo,  ":duracion"=>$duracion,  "estatus"=>1];

            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertaTema($Idtema, $Nomtema, $orden){ 
            $q1 = "INSERT INTO temas (IdTema, NomTema,orden) VALUES(:clave, :nombre,:orden)";
            $a1 = [":clave"=>$Idtema, ":nombre"=>$Nomtema, ":orden"=>$orden];

            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertaSubtema($IdSubT, $NomSubT, $idTema, $orden){ 
            $q1 = "INSERT INTO subtemas (IdSubT, NomSubT, ordem) VALUES(:clave, :nombre, :orden)";
            $a1 = [":clave"=>$IdSubT, ":nombre"=>$NomSubT, ":orden"=>$orden];

            $q2 = "INSERT INTO temassub (IdTema,IdSubT) VALUES(:IdTema, :IdSub)";
            $a2 = [":IdTema"=>$idTema, ":IdSub"=>$IdSubT];


            $querry = [$q1, $q2];
            $parametros = [$a1, $a2];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function cursoTema($clave, $idTema){
            $q1 = "INSERT INTO cursotema (ClaveCur, IdTema) VALUES(:clave, :IdTema)";
            $a1 = [":clave"=>$clave, ":IdTema"=>$idTema];

            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }



        function verificar_existencia($clave_curso){
            $query = "SELECT ClaveCur FROM cursos WHERE ClaveCur = '$clave_curso'";
            $resultado = $this->base->mostrar($query);
            return $resultado;
        }

        function insertar($arreglo){
            $q1 = "INSERT INTO cursos (ClaveCur,NomCur,ObjCur,DuracionCur) 
            VALUES(:ClaveCur, :NomCur, :ObjCur, :DuracionCur)";
            $a1= [":ClaveCur"=>$arreglo[0], ":NomCur"=>$arreglo[1], ":ObjCur"=>$arreglo[2], ":DuracionCur"=>$arreglo[3]];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertarTema($arreglo,$lista1){
            $q1 = "INSERT INTO temas (IdTema,NomTema)
            VALUES(:IdTema, :NomTema)";
            $a1= [":IdTema"=>$arreglo, ":NomTema"=>$lista1];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertarSub($arreglo,$lista2){
            $q1 = "INSERT INTO subtemas (IdSubT,NomSubT)
            VALUES(:IdSubT, :NomSubT)";
            $a1= [":IdSubT"=>$arreglo, ":NomSubT"=>$lista2];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        function curtem($arreglo,$lista2){
            $q1 = "INSERT INTO cursotema (ClaveCur,IdTema)
            VALUES(:IdSubT, :NomSubT)";
            $a1= [":IdSubT"=>$arreglo, ":NomSubT"=>$lista2];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        function temsub($arreglo,$lista2){
            $q1 = "INSERT INTO temassub (IdTema,IdSubT)
            VALUES(:IdSubT, :NomSubT)";
            $a1= [":IdSubT"=>$arreglo, ":NomSubT"=>$lista2];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        function idtema(){
            $querry = "SELECT Max(CAST(IdTema as int)) FROM temas ";
            $resultados = $this->base->mostrar($querry);
            return $resultados;
    
        }


        function idsub(){
            $querry = "SELECT Max(CAST(IdSubT as int)) FROM subtemas";
            $resultados = $this->base->mostrar($querry);
    
            return $resultados;
        }     
        function esta($identificador){
            $querry ="SELECT ClaveCur FROM cursos where ClaveCur = $identificador";
            $resultados = $this->base->mostrar($querry);
    
            return $resultados;
        }           
    }
?>