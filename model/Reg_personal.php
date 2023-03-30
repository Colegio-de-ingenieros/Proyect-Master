<?php
    include('../../config/Crud_bd.php');

    class Personal extends Crud_bd{

        public function buscar_colonias($codigoPostal){
            # esta funcion trae todas las colonias en base al codigo postal
            $this->conexion_bd();
            $sql = "SELECT IdColonia,nomcolonia,nommunicipio,nomestado FROM"
                    ." estados,municipios,colonias WHERE estados.idestado = municipios.idestado AND"
                    ." municipios.idmunicipio =colonias.idmunicipio AND colonias.codpostal = :cod ";
            $resultado = $this->mostrar($sql,[":cod"=>$codigoPostal]);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function id_usuaperso(){
            
            $this->conexion_bd();//convertimos el numero de char a integer para tomar el mayor
            
            $sql = "SELECT COUNT(IdPerso) FROM usuaperso";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();

            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;
                
            }else{
                $numero = $arreglo[0][0];
                $numero++;
                
            }

            $numero_con_ceros = $this->agregar_ceros($numero, 4);
            $idUsuaPerso = "P".$numero_con_ceros;
        
            return $idUsuaPerso;
        }

        public function obtener_id_emp_perso(){

            $this->conexion_bd();
            $sql = "SELECT Count(IdEmpPerso) FROM empresaperso";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();
        
            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;
                
            }else{
                $numero = $arreglo[0][0];
                $numero++;
                
            }

            $idEmpPerso = $this->agregar_ceros($numero, 4);
        
            return $idEmpPerso;
        }

        public function obtener_id_empresa_funcion(){

            $this->conexion_bd();
            $sql = "SELECT Count(IdFuncion) FROM funciones";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();
        
            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;
                
            }else{
                $numero = $arreglo[0][0];
                $numero++;
                
            }

            $idFuncion = $this->agregar_ceros($numero, 6);
        
            return $idFuncion;
        }

        public function obtener_id_certificacion(){

            $this->conexion_bd();
            $sql = "SELECT Count(IdCerExt) FROM certexterna";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();
        
            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;
                
            }else{
                $numero = $arreglo[0][0];
                $numero++;
                
            }

            $idCertExt = $this->agregar_ceros($numero, 6);
        
            return $idCertExt;
        }

        public function obtener_numero_consecutivo()
        {
            # esta funcion te dara el numero en el que se quedaron

            $this->conexion_bd();//convertimos el numero de char a integer para tomar el mayor
            
            $sql = "SELECT MAX(CAST(SUBSTRING(IdNIntel,2) AS INT)) FROM numinteligentes";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
        
            return $resultado;

        }

        public function numero_inteligente($idUsua)
        {
            # genera el numero inteligente
            $mydate=getdate(date("U"));
            $year = $mydate["year"];
            $mes = date('m');
            $arreglo = $this->obtener_numero_consecutivo();
            $numero = "";


            if (is_null($arreglo[0][0]) == 1) {
                # significa que no hay registros por eso hay que generarlo
                $numero = 1;
            }else{
                $numero = $arreglo[0][0];
                $numero++;
            
            }
            $numero_con_ceros = $this->agregar_ceros($numero, 4);
            
            $numero_inteligente = $year.$mes.$numero_con_ceros;
            $numero_consecutivo = "P".$numero_con_ceros;

            return array($numero_consecutivo, $numero_inteligente);
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

        public function insertar_usuaCompleto($idUsua, $nombre, $apeP, $apeM, $correo, $cedula, $telF, $telM, $fecha, $calle, $pasan, $antece, $veridi, $aviso, $password, $idEmpPerso, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp, $idFuncion, $funcionEmp, 
        $idCertExt, $certifi, $orgCert, $fechaICert, $fechaFCert, $gradoEst, $colonia, $consecutivo, $numIntel){

            $this->conexion_bd();

            //consultas para la tabla de usuaperso
            $q1 = "INSERT INTO usuaperso (IdPerso, NomPerso, ApePPerso, ApeMPerso, CorreoPerso, CedulaPerso, TelFPerso, TelMPerso, FechaNacPerso, CallePerso, PasantiaPerso, AntecePerso, DatosVerPerso, AvisoPerso, ContraPerso)
            VALUES(:id, :nombre, :apeP, :apeM, :correo, :cedula, :telF, :telM, :fecha, :calle, :pasan, :antece, :veridi, :aviso, :contra)";

            $a1 = [":id"=>$idUsua, ":nombre"=>$nombre, ":apeP"=>$apeP, ":apeM"=>$apeM, ":correo"=>$correo, ":cedula"=>$cedula, ":telF"=>$telF, ":telM"=>$telM, ":fecha"=>$fecha, ":calle"=>$calle, ":pasan"=>$pasan, ":antece"=>$antece, ":veridi"=>$veridi, ":aviso"=>$aviso, ":contra"=>$password];

            //consultas para la tabla de empresaperso
            $q2 = "INSERT INTO empresaperso (IdEmpPerso, NomEmpPerso, PuestoEmpPerso, CorreoEmpPerso, TelFEmpPerso, ExtenTelFEmpPerso)
            VALUES(:idEmpre, :nombre, :puesto, :correo, :telFEmp, :extTelFEmp)";

            $a2 = [":idEmpre"=>$idEmpPerso, ":nombre"=>$empresaLab, ":puesto"=>$puestoEmp, ":correo"=>$correoEmp, ":telFEmp"=>$telFEmp, ":extTelFEmp"=>$extTelFEmp];

            //consultas para la tabla de funciones
            $q3 = "INSERT INTO funciones (IdFuncion, NomFuncion)
            VALUES(:idFun, :nomfun)";

            $a3 = [":idFun"=>$idFuncion, ":nomfun"=>$funcionEmp];

            //consultas para insertar registros en la relacion certexterna
            $q4 = "INSERT INTO certexterna (IdCerExt, NomCerExt, OrgCerExt, IniCerExt, FinCerExt) VALUES(:idCE,:nombreC, :orgCer, :iniFecha, :finFecha)";
            $a4 = [":idCE"=>$idCertExt,":nombreC"=>$certifi,":orgCer"=>$orgCert,":iniFecha"=>$fechaICert,":finFecha"=>$fechaFCert];


            //consultas para insertar registros en la relacion usuapersoemp
            $q5 = "INSERT INTO usuapersoemp (IdPerso, IdEmpPerso) VALUES(:id, :idEmpre)";

            $a5 = [":id"=>$idUsua,":idEmpre"=>$idEmpPerso];

            //consultas para insertar registros en la relacion persoempfun
            $q6 = "INSERT INTO persoempfun (IdEmpPerso, IdFuncion) VALUES(:idEmpre, :idFun)";

            $a6 = [":idEmpre"=>$idEmpPerso,":idFun"=>$idFuncion];

            //Ingresa datos en la tabla persocertexterna
            $q7 = "INSERT INTO persocertexterna (IdPerso,IdCertExt) VALUES(:id,:idCE)";
            $a7 = [":id"=>$idUsua,":idCE"=>$idCertExt];

            //consultas para insertar registros en la relacion persoestudios
            $q8 = "INSERT INTO persoestudios (IdPerso, IdGrado) VALUES(:id, :idGra)";

            $a8 = [":id"=>$idUsua,":idGra"=>$gradoEst];

            //consultas para insertar registros en la relacion persolugares
            $q9 = "INSERT INTO persolugares (IdPerso, IdColonia) VALUES(:id, :IdCol)";

            $a9 = [":id"=>$idUsua,":IdCol"=>$colonia];

            //consultas para insertar registros en la relacion persotipousua
            $idU=1;
            $q10 = "INSERT INTO persotipousua (IdUsua, IdPerso) VALUES(:idU, :id)";

            $a10 = [":idU"=>$idU,":id"=>$idUsua];

            //consultas para la tabla de numinteligentes
            $q11 = "INSERT INTO numinteligentes (IdNIntel,NInteligente) VALUES(:consecutivo, :numIntel)";
 
            $a11 = [":consecutivo"=>$consecutivo, ":numIntel"=>$numIntel];

            //consultas para insertar registros en la relacion personintel
            $q12 = "INSERT INTO personintel (IdPerso, IdNIntel) VALUES(:idU, :numIntel)";

            $a12 = [":idU"=>$idUsua,":numIntel"=>$consecutivo];


            $querry = [$q1, $q2, $q3, $q4, $q5, $q6, $q7,  $q8, $q9, $q10, $q11, $q12];
            $parametros = [$a1, $a2, $a3, $a4, $a5, $a6, $a7,  $a8, $a9, $a10, $a11, $a12];
            //acomoda todo en arreglos para mandarlos al CRUD

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            return $ejecucion;

        }

        public function insertar_conCerti($idUsua, $nombre, $apeP, $apeM, $fecha, $telF, $telM, $correo, $password, $cedula, $calle, $colonia,
        $gradoEst, $pasan,  $idCertExt, $certifi, $orgCert, $fechaICert, $fechaFCert, $antece, $veridi, $aviso, $consecutivo, $numIntel){
            $this->conexion_bd();

            //consultas para la tabla de usuaperso
            $q1 = "INSERT INTO usuaperso (IdPerso, NomPerso, ApePPerso, ApeMPerso, CorreoPerso, CedulaPerso, TelFPerso, TelMPerso, FechaNacPerso, CallePerso, PasantiaPerso, AntecePerso, DatosVerPerso, AvisoPerso, ContraPerso)
            VALUES(:id, :nombre, :apeP, :apeM, :correo, :cedula, :telF, :telM, :fecha, :calle, :pasan, :antece, :veridi, :aviso, :contra)";

            $a1 = [":id"=>$idUsua, ":nombre"=>$nombre, ":apeP"=>$apeP, ":apeM"=>$apeM, ":correo"=>$correo, ":cedula"=>$cedula, ":telF"=>$telF, ":telM"=>$telM, ":fecha"=>$fecha, ":calle"=>$calle, ":pasan"=>$pasan, ":antece"=>$antece, ":veridi"=>$veridi, ":aviso"=>$aviso, ":contra"=>$password];

            //consultas para insertar registros en la relacion certexterna
            $q4 = "INSERT INTO certexterna (IdCerExt, NomCerExt, OrgCerExt, IniCerExt, FinCerExt) VALUES(:idCE,:nombreC, :orgCer, :iniFecha, :finFecha)";
            $a4 = [":idCE"=>$idCertExt,":nombreC"=>$certifi,":orgCer"=>$orgCert,":iniFecha"=>$fechaICert,":finFecha"=>$fechaFCert];

            //Ingresa datos en la tabla persocertexterna
            $q7 = "INSERT INTO persocertexterna (IdPerso,IdCertExt) VALUES(:id,:idCE)";
            $a7 = [":id"=>$idUsua,":idCE"=>$idCertExt];

            //consultas para insertar registros en la relacion persoestudios
            $q8 = "INSERT INTO persoestudios (IdPerso, IdGrado) VALUES(:id, :idGra)";

            $a8 = [":id"=>$idUsua,":idGra"=>$gradoEst];

            //consultas para insertar registros en la relacion persolugares
            $q9 = "INSERT INTO persolugares (IdPerso, IdColonia) VALUES(:id, :IdCol)";

            $a9 = [":id"=>$idUsua,":IdCol"=>$colonia];

            //consultas para insertar registros en la relacion persotipousua
            $idU=1;
            $q10 = "INSERT INTO persotipousua (IdUsua, IdPerso) VALUES(:idU, :id)";

            $a10 = [":idU"=>$idU,":id"=>$idUsua];

            //consultas para la tabla de numinteligentes
            $q11 = "INSERT INTO numinteligentes (IdNIntel,NInteligente) VALUES(:consecutivo, :numIntel)";
 
            $a11 = [":consecutivo"=>$consecutivo, ":numIntel"=>$numIntel];

            //consultas para insertar registros en la relacion personintel
            $q12 = "INSERT INTO personintel (IdPerso, IdNIntel) VALUES(:idU, :numIntel)";

            $a12 = [":idU"=>$idUsua,":numIntel"=>$consecutivo];

            $querry = [$q1, $q4, $q7, $q8, $q9, $q10, $q11, $q12];
            $parametros = [$a1, $a4, $a7, $a8, $a9, $a10, $a11, $a12];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            return $ejecucion;
        }

        public function insertar_conLaboral($idUsua, $nombre, $apeP, $apeM, $fecha, $telF, $telM, $correo, $password, $cedula, $calle, $colonia,
        $gradoEst, $pasan,  $antece, $veridi, $aviso, $consecutivo, $numIntel, $idEmpPerso, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp, $idFuncion, $funcionEmp,){
            $this->conexion_bd();
            //consultas para la tabla de usuaperso
            $q1 = "INSERT INTO usuaperso (IdPerso, NomPerso, ApePPerso, ApeMPerso, CorreoPerso, CedulaPerso, TelFPerso, TelMPerso, FechaNacPerso, CallePerso, PasantiaPerso, AntecePerso, DatosVerPerso, AvisoPerso, ContraPerso)
            VALUES(:id, :nombre, :apeP, :apeM, :correo, :cedula, :telF, :telM, :fecha, :calle, :pasan, :antece, :veridi, :aviso, :contra)";

            $a1 = [":id"=>$idUsua, ":nombre"=>$nombre, ":apeP"=>$apeP, ":apeM"=>$apeM, ":correo"=>$correo, ":cedula"=>$cedula, ":telF"=>$telF, ":telM"=>$telM, ":fecha"=>$fecha, ":calle"=>$calle, ":pasan"=>$pasan, ":antece"=>$antece, ":veridi"=>$veridi, ":aviso"=>$aviso, ":contra"=>$password];

            //consultas para la tabla de empresaperso
            $q2 = "INSERT INTO empresaperso (IdEmpPerso, NomEmpPerso, PuestoEmpPerso, CorreoEmpPerso, TelFEmpPerso, ExtenTelFEmpPerso)
            VALUES(:idEmpre, :nombre, :puesto, :correo, :telFEmp, :extTelFEmp)";

            $a2 = [":idEmpre"=>$idEmpPerso, ":nombre"=>$empresaLab, ":puesto"=>$puestoEmp, ":correo"=>$correoEmp, ":telFEmp"=>$telFEmp, ":extTelFEmp"=>$extTelFEmp];

            //consultas para la tabla de funciones
            $q3 = "INSERT INTO funciones (IdFuncion, NomFuncion)
            VALUES(:idFun, :nomfun)";

            $a3 = [":idFun"=>$idFuncion, ":nomfun"=>$funcionEmp];

            //consultas para insertar registros en la relacion usuapersoemp
            $q5 = "INSERT INTO usuapersoemp (IdPerso, IdEmpPerso) VALUES(:id, :idEmpre)";

            $a5 = [":id"=>$idUsua,":idEmpre"=>$idEmpPerso];

            //consultas para insertar registros en la relacion persoempfun
            $q6 = "INSERT INTO persoempfun (IdEmpPerso, IdFuncion) VALUES(:idEmpre, :idFun)";

            $a6 = [":idEmpre"=>$idEmpPerso,":idFun"=>$idFuncion];

            //consultas para insertar registros en la relacion persoestudios
            $q8 = "INSERT INTO persoestudios (IdPerso, IdGrado) VALUES(:id, :idGra)";

            $a8 = [":id"=>$idUsua,":idGra"=>$gradoEst];

            //consultas para insertar registros en la relacion persolugares
            $q9 = "INSERT INTO persolugares (IdPerso, IdColonia) VALUES(:id, :IdCol)";

            $a9 = [":id"=>$idUsua,":IdCol"=>$colonia];

            //consultas para insertar registros en la relacion persotipousua
            $idU=1;
            $q10 = "INSERT INTO persotipousua (IdUsua, IdPerso) VALUES(:idU, :id)";

            $a10 = [":idU"=>$idU,":id"=>$idUsua];

            //consultas para la tabla de numinteligentes
            $q11 = "INSERT INTO numinteligentes (IdNIntel,NInteligente) VALUES(:consecutivo, :numIntel)";
 
            $a11 = [":consecutivo"=>$consecutivo, ":numIntel"=>$numIntel];

            //consultas para insertar registros en la relacion personintel
            $q12 = "INSERT INTO personintel (IdPerso, IdNIntel) VALUES(:idU, :numIntel)";

            $a12 = [":idU"=>$idUsua,":numIntel"=>$consecutivo];

            $querry = [$q1, $q2, $q3, $q5, $q6, $q8, $q9, $q10, $q11, $q12];
            $parametros = [$a1, $a2, $a3, $a5, $a6, $a8, $a9, $a10, $a11, $a12];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            return $ejecucion;

        }

        public function insertar_normal($idUsua, $nombre, $apeP, $apeM, $fecha, $telF, $telM, $correo, $password, $cedula, $calle, $colonia,
        $gradoEst, $pasan, $antece, $veridi, $aviso, $consecutivo, $numIntel){
            $this->conexion_bd();
             //consultas para la tabla de usuaperso
             $q1 = "INSERT INTO usuaperso (IdPerso, NomPerso, ApePPerso, ApeMPerso, CorreoPerso, CedulaPerso, TelFPerso, TelMPerso, FechaNacPerso, CallePerso, PasantiaPerso, AntecePerso, DatosVerPerso, AvisoPerso, ContraPerso)
             VALUES(:id, :nombre, :apeP, :apeM, :correo, :cedula, :telF, :telM, :fecha, :calle, :pasan, :antece, :veridi, :aviso, :contra)";
 
             $a1 = [":id"=>$idUsua, ":nombre"=>$nombre, ":apeP"=>$apeP, ":apeM"=>$apeM, ":correo"=>$correo, ":cedula"=>$cedula, ":telF"=>$telF, ":telM"=>$telM, ":fecha"=>$fecha, ":calle"=>$calle, ":pasan"=>$pasan, ":antece"=>$antece, ":veridi"=>$veridi, ":aviso"=>$aviso, ":contra"=>$password];

             //consultas para insertar registros en la relacion persoestudios
            $q8 = "INSERT INTO persoestudios (IdPerso, IdGrado) VALUES(:id, :idGra)";

            $a8 = [":id"=>$idUsua,":idGra"=>$gradoEst];

            //consultas para insertar registros en la relacion persolugares
            $q9 = "INSERT INTO persolugares (IdPerso, IdColonia) VALUES(:id, :IdCol)";

            $a9 = [":id"=>$idUsua,":IdCol"=>$colonia];

            //consultas para insertar registros en la relacion persotipousua
            $idU=1;
            $q10 = "INSERT INTO persotipousua (IdUsua, IdPerso) VALUES(:idU, :id)";

            $a10 = [":idU"=>$idU,":id"=>$idUsua];

            //consultas para la tabla de numinteligentes
            $q11 = "INSERT INTO numinteligentes (IdNIntel,NInteligente) VALUES(:consecutivo, :numIntel)";
 
            $a11 = [":consecutivo"=>$consecutivo, ":numIntel"=>$numIntel];

            //consultas para insertar registros en la relacion personintel
            $q12 = "INSERT INTO personintel (IdPerso, IdNIntel) VALUES(:idU, :numIntel)";

            $a12 = [":idU"=>$idUsua,":numIntel"=>$consecutivo];

            $querry = [$q1, $q8, $q9, $q10, $q11, $q12];
            $parametros = [$a1, $a8, $a9, $a10, $a11, $a12];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            return $ejecucion;

        }


        function mandar_correo($destinatario,$numero_inteligente,$nombre)
        {   
            $remitente = "ColegioCISCIG@outlook.com";
            $asunto = "Bienvenido a CISCIG!!!";
            $cuerpo = "<p>Hola ".$nombre ." ahora eres asociado del Colegio de Ingenieros en Sistemas Computacionales.Este será tu número inteligente:".$numero_inteligente."</p>";
            //manda el correo electronico
            ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $headers = "From:<" . $remitente . "> \r\n";
            $headers .= "Cc:afgh@somedomain.com \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8 \r\n";
            mail($destinatario,$asunto,$cuerpo, $headers);
    }

    
    }
?>