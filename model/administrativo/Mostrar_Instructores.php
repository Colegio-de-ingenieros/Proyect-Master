<?php
require_once('../../config/Crud_bd.php');

class Mostrar_Instructor extends Crud_bd{

    public function extraerInstructores(){
        $this->conexion_bd();
        $consulta = "SELECT ClaveIns, NomIns, ApePIns, ApeMIns, EstatusIns FROM instructor";
        $resultados = $this->mostrar($consulta);
        $this->cerrar_conexion();

        return $resultados;
    }

    public function mostrar_instructor_individual($id){
        //* Extraemos la información individual del instructor 
        $this->conexion_bd();
        $consulta = "SELECT NomIns, ApePIns, ApeMIns 
        FROM instructor 
        WHERE ClaveIns = :id";
        $parametros = [":id"=>$id];
        $resultados_datos_basicos = $this->mostrar($consulta,$parametros);

        //* Extraemos las certificaciones internas del instructor 
        $consulta = "SELECT certinterna.NomCertInt, certinterna.DesCerInt, certinterna.EstatusCertInt 
        from certinterna, inscertint
        WHERE inscertint.ClaveIns = :id
        and inscertint.IdCerInt = certinterna.IdCerInt";
        $parametros = [":id"=>$id];
        $resultados_certificaciones_internas = $this->mostrar($consulta,$parametros);

        //* Extraemos las certificaciones externas del instructor
        $consulta = "SELECT certexterna.NomCerExt, certexterna.OrgCerExt, certexterna.IniCerExt, certexterna.FinCerExt
        from certexterna, inscertext
        WHERE inscertext.ClaveIns = :id
        and inscertext.IdCerExt = certexterna.IdCerExt";
        $parametros = [":id"=>$id];
        $resultados_certificaciones_externas = $this->mostrar($consulta,$parametros);

        //* Extraemos las especialidades del instructor
        $consulta = "SELECT especialidades.NomEspIns 
        FROM especialidades, especialins 
        WHERE especialins.ClaveIns = :id 
        AND especialins.IdEspIns = especialidades.IdEspIns";
        $parametros = [":id"=>$id];
        $resultados_especialidades = $this->mostrar($consulta,$parametros);

        //* Juntamos todas las variables en un solo arreglo
        $resultados = [
            "datos_basicos"=>$resultados_datos_basicos,
            "especialidades"=>$resultados_especialidades,
            "certificaciones_internas"=>$resultados_certificaciones_internas,
            "certificaciones_externas"=>$resultados_certificaciones_externas
        ];

        $this->cerrar_conexion();
        //* Retorna el arreglo con toda la información
        return $resultados;
    }

    public function busquedainteligente($busqueda)
    {
        $this->conexion_bd();
        $consulta = "SELECT ClaveIns, NomIns, ApePIns, ApeMIns, EstatusIns 
                    FROM instructor 
                    WHERE  (CONCAT(instructor.NomIns,' ',COALESCE(instructor.ApePIns, ''),' ',COALESCE(instructor.ApeMIns, ''))) LIKE '".$busqueda."%'
                    OR instructor.NomIns LIKE '".$busqueda."%' OR instructor.NomIns LIKE '%".$busqueda."'
                    OR instructor.ApePIns LIKE '".$busqueda."%' OR instructor.ApePIns LIKE '%".$busqueda."'
                    OR (COALESCE(instructor.ApeMIns, '')) LIKE '".$busqueda."%' OR (COALESCE(instructor.ApeMIns, '')) LIKE '%".$busqueda."'";
        $resultados = $this->mostrar($consulta);
        $this->cerrar_conexion();

        return $resultados;

    }

}

?>