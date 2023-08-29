
<?php
require_once('../../config/Crud_bd.php');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class Mostrar_perfil_empresa extends Crud_bd {
    function buscar_rfc_empresa($user){

        $this->conexion_bd();
        $datos = $this->mostrar("SELECT RFCUsuaEmp FROM usuaemp WHERE binary(CorreoUsuaEmp)= binary(:user)",[':user'=>$user]);
        $this->cerrar_conexion();

        return $datos;
    }
    /**
     * Get enterpraise data that have certain rfc
     * @param $rfc_empresa
     * @return Array
     */
    function obtener_datos($user): array{
        $rfc_empresa_array = $this->buscar_rfc_empresa($user);
        $datos = [];

        if(count($rfc_empresa_array) > 0){

            $rfc_empresa = $rfc_empresa_array[0][0];
            $this->conexion_bd();
            $sql = "SELECT RFCUsuaEmp, NomUsuaEmp, CorreoUsuaEmp, RazonUsuaEmp, CalleUsuaEmp, HrIniUsuaEmp, HrFinUsuaEmp, acuerdoEmp 
                    FROM usuaemp WHERE RFCUsuaEmp = :rfc ";

            $sql_domicilio = "SELECT usuaemplugares.IdColonia, colonias.codpostal  FROM  usuaemplugares INNER JOIN colonias
                    on usuaemplugares.IdColonia = colonias.IdColonia and RFCUsuaEmp = :rfc";
            $sql_horario = "SELECT IdLab FROM empdias WHERE RFCUsuaEmp = :rfc ";
            $sql_areas = "SELECT areaemptipo.IdArea, areaempresa.*  FROM emparea INNER JOIN areaempresa ON emparea.IdAreaEmp = areaempresa.IdAreaEmp and RFCUsuaEmp = :rfc 
                            INNER JOIN areaemptipo on areaempresa.IdAreaEmp = areaemptipo.IdAreaEmp";

            $parametros = [":rfc"=>$rfc_empresa];
            $datos_generales_ar = $this->mostrar($sql,$parametros);
            $datos_domicilio_ar = $this->mostrar($sql_domicilio,$parametros);
            $datos_dias_ar = $this->mostrar($sql_horario,$parametros);
            $datos_areas_ar = $this->mostrar($sql_areas,$parametros);

            for ($i=0; $i < 8 ; $i++) { 
                $datos_generales[] = $datos_generales_ar[0][$i];
            }
            for ($i=0; $i < count($datos_dias_ar) ; $i++) { 
                $datos_dias[] = $datos_dias_ar[$i][0];
            }
            $datos_areas = [];
            for ($i=0; $i < count($datos_areas_ar) ; $i++) { 
                $temp = [];
                for ($j=0; $j < 8  ; $j++) { 
                    $temp[] = $datos_areas_ar[$i][$j];
                }
                array_push($datos_areas,$temp);
            }
            
            $datos = [ "generales"=> $datos_generales,
                        "domicilio"=> [$datos_domicilio_ar[0][0],$datos_domicilio_ar[0][1]],
                        "dias"=> $datos_dias,
                        "areas" => $datos_areas
                    ];

        }

        
        return $datos;
    }

}





?>