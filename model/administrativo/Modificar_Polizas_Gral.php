<?php
    include('../../config/Crud_bd.php');

    class Mostrar_Pol_Gral extends Crud_bd{
        public function buscar_datos($id){
            $lista=[];
            $tipoPol=$this->buscar_tipo_pol();
            $tiposUsua=$this->buscar_tipo_usuarios();
            $tipoSer=$this->buscar_tipo_servicios();
            $lista[0]=$tipoPol;
            $lista[1]=$tiposUsua;
            $lista[2]=$tipoSer;

            $datosPol=$this->buscar_poliza_perso($id, 1);
            $usuarios=$this->buscar_perso(1);
            if ($datosPol==NULL){
                $datosPol=$this->buscar_poliza_perso($id, 2);
                $usuarios=$this->buscar_perso(2);
                if ($datosPol==NULL){
                    $datosPol=$this->buscar_poliza_emp($id);
                    $usuarios=$this->buscar_empresa();
                }
            }
            $lista[3]=$datosPol;
            $lista[4]=$usuarios;

            $datosSer=$this->buscar_cursoPol($id);
            $servicios=$this->buscar_curso();
            if ($datosSer==NULL){
                $datosSer=$this->buscar_certPol($id);
                $servicios=$this->buscar_certificaciones();
                if ($datosSer==NULL){
                    $datosSer=$this->buscar_otro_servicio($id);
                    $aux=$datosSer[0];
                    $servicios=$this->buscar_otros_servicios($aux[0]);
                }
            }
            $lista[5]=$datosSer;
            $lista[6]=$servicios;
            return $lista;
        }

        public function buscar_tipo_pol(){
            $this->conexion_bd();
            $sql = "SELECT*
                    FROM tipopol";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_tipo_usuarios(){
            $this->conexion_bd();
            $sql = "SELECT*
                    FROM tipousua";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_tipo_servicios(){
            $this->conexion_bd();
            $sql = "SELECT*
                    FROM serviciospol";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_poliza_perso($id, $idUs){
            $this->conexion_bd();
            $sql = "SELECT polgeneral.NomElaPol, polgeneral.ApePElaPol, polgeneral.ApeMElaPol, polgeneral.CoceptoGral, tipopol.IdTipoPol, serviciospol.IdSerPol, tipousua.IdUsua, usuaperso.IdPerso
                    FROM polgeneral, tipogralpol, tipopol, sergralpol, serviciospol, persogralpol, usuaperso, persotipousua, tipousua
                    WHERE polgeneral.IdPolGral = :id and polgeneral.IdPolGral=tipogralpol.IdPolGral and tipogralpol.IdTipoPol=tipopol.IdTipoPol and polgeneral.IdPolGral=sergralpol.IdPolGral and sergralpol.IdSerPol=serviciospol.IdSerPol and polgeneral.IdPolGral=persogralpol.IdPolGral and persogralpol.IdPerso=usuaperso.IdPerso and usuaperso.IdPerso=persotipousua.IdPerso and persotipousua.IdUsua=tipousua.IdUsua and tipousua.IdUsua = :idUs";
            $arre = [":id"=>$id, ":idUs"=>$idUs];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_poliza_emp($id){
            $this->conexion_bd();
            $sql = "SELECT polgeneral.NomElaPol, polgeneral.ApePElaPol, polgeneral.ApeMElaPol, polgeneral.CoceptoGral, tipopol.IdTipoPol, serviciospol.IdSerPol, tipousua.IdUsua, usuaemp.RFCUsuaEmp
                    FROM polgeneral, tipogralpol, tipopol, sergralpol, serviciospol, empgralpol, usuaemp, emptipousua,tipousua
                    WHERE polgeneral.IdPolGral = :id and polgeneral.IdPolGral=tipogralpol.IdPolGral and tipogralpol.IdTipoPol=tipopol.IdTipoPol and polgeneral.IdPolGral=sergralpol.IdPolGral and sergralpol.IdSerPol=serviciospol.IdSerPol and polgeneral.IdPolGral=empgralpol.IdPolGral and empgralpol.RFCUsuaEmp=usuaemp.RFCUsuaEmp and usuaemp.RFCUsuaEmp=emptipousua.RFCUsuaEmp and emptipousua.IdUsua=tipousua.IdUsua";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_perso($idUs){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso) as Nombre
                    FROM usuaperso, persotipousua, tipousua
                    WHERE usuaperso.IdPerso = persotipousua.IdPerso and persotipousua.IdUsua = tipousua.IdUsua and tipousua.IdUsua = :id";
            $arre = [":id"=>$idUs];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_empresa(){
            $this->conexion_bd();
            $sql = "SELECT usuaemp.RFCUsuaEmp, CONCAT_WS(' ', usuaemp.NomUsuaEmp) as Nombre
                    FROM usuaemp";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_cursoPol($id){
            $this->conexion_bd();
            $sql = "SELECT cursos.ClaveCur
                    FROM polgeneral, cursoserpol, cursos
                    WHERE polgeneral.IdPolGral= :id and polgeneral.IdPolGral=cursoserpol.IdPolGral and cursoserpol.ClaveCur=cursos.ClaveCur";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_certPol($id){
            $this->conexion_bd();
            $sql = "SELECT certinterna.IdCerInt
                    FROM polgeneral, cerserpol, certinterna
                    WHERE polgeneral.IdPolGral= :id and polgeneral.IdPolGral=cerserpol.IdPolGral and cerserpol.IdCerInt=certinterna.IdCerInt";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_curso(){
            $this->conexion_bd();
            $sql = "SELECT cursos.ClaveCur, cursos.NomCur
                    FROM cursos";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_certificaciones(){
            $this->conexion_bd();
            $sql = "SELECT certinterna.IdCerInt, certinterna.NomCertInt
                    FROM certinterna";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_otro_servicio($id){
            $this->conexion_bd();
            $sql = "SELECT serviciospol.IdSerPol
                    FROM polgeneral, sergralpol, serviciospol
                    WHERE polgeneral.IdPolGral= :id and polgeneral.IdPolGral=sergralpol.IdPolGral and sergralpol.IdSerPol=serviciospol.IdSerPol";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_otros_servicios($id){
            $this->conexion_bd();
            $sql = "SELECT*
                    FROM serviciospol
                    WHERE IdSerPol=:id";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function modificar_pol_gral($idPol, $nombreEla, $apePEla, $apeMEla, $concepto){
            $this->conexion_bd();
            $querry = "UPDATE polgeneral SET NomElaPol=:nombre, ApePElaPol=:apeP, ApeMElaPol=:apeM, CoceptoGral=:concepto
                        WHERE IdPolGral=:id";
            $arre = [":id"=>$idPol, ":nombre"=>$nombreEla, ":apeP"=>$apePEla, ":apeM"=>$apeMEla, ":concepto"=>$concepto];
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function modificar_pol_tipo($idPol, $tipoPol){
            $this->conexion_bd();
            $querry = "UPDATE tipogralpol SET IdTipoPol=:tipo
                        WHERE IdPolGral=:id";
            $arre = [":id"=>$idPol, ":tipo"=>$tipoPol];
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function modificar_pol_ser($idPol, $tipoSer, $servicio){
            $this->conexion_bd();
            $querry = "UPDATE sergralpol SET IdSerPol=:tipo
                        WHERE IdPolGral=:id";
            $arre = [":id"=>$idPol, ":tipo"=>$tipoSer];
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);

            if ($tipoSer==4){
                $q2 = "INSERT INTO cursoserpol (IdPolGral, ClaveCur) VALUES(:idPol, :clave)";
                $a2 = [":idPol"=>$idPol, ":clave"=>$servicio];
                $querry2 = [$q2];
                $parametros2 = [$a2];

                $resultado = $this->insertar_eliminar_actualizar($querry2, $parametros2);
            }else if ($tipoSer==5){
                $q3 = "INSERT INTO cerserpol (IdPolGral, IdCerInt) VALUES(:idPol, :clave)";
                $a3 = [":idPol"=>$idPol, ":clave"=>$servicio];
                $querry3 = [$q3];
                $parametros3 = [$a3];

                $resultado = $this->insertar_eliminar_actualizar($querry3, $parametros3);
            }
            $this->cerrar_conexion();
            return $resultado;
        }

        public function eliminar_pol_ser_curso_certi($idPol){
            $this->conexion_bd();
            $arre = [":id"=>$idPol];
            $querry = "DELETE FROM cursoserpol  WHERE IdPolGral=:id";               
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);

            $querry = "DELETE FROM cerserpol  WHERE IdPolGral=:id";         
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);

            $this->cerrar_conexion();
            return $resultado;
        }

        public function eliminar_pol_usua($idPol){
            $this->conexion_bd();
            $arre = [":id"=>$idPol];
            $querry = "DELETE FROM persogralpol  WHERE IdPolGral=:id";               
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);

            $querry = "DELETE FROM empgralpol  WHERE IdPolGral=:id";         
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);

            $this->cerrar_conexion();
            return $resultado;
        }

        public function modificar_pol_usua($idPol, $tipoUsua, $usuario){
            $this->conexion_bd();
            if ($tipoUsua<=2){
                $q2 = "INSERT INTO persogralpol (IdPolGral, IdPerso) VALUES(:idPol, :usuario)";
                $a2 = [":idPol"=>$idPol, ":usuario"=>$usuario];
                $querry2 = [$q2];
                $parametros2 = [$a2];

                $resultado = $this->insertar_eliminar_actualizar($querry2, $parametros2);
            }else if ($tipoUsua==3){
                $q3 = "INSERT INTO empgralpol (IdPolGral, RFCUsuaEmp) VALUES(:idPol, :usuario)";
                $a3 = [":idPol"=>$idPol, ":usuario"=>$usuario];
                $querry3 = [$q3];
                $parametros3 = [$a3];

                $resultado = $this->insertar_eliminar_actualizar($querry3, $parametros3);
            }
            $this->cerrar_conexion();
            return $resultado;
        }
    }
?>