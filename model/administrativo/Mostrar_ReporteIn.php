<?php
require_once ('../../config/Crud_bd.php');

class Reportes_in extends Crud_bd{

    public function buscarCertificaciones()
    {
        # buscamos Certificaciones
        $this->conexion_bd();
        $sql = "SELECT seguimiento.IdSeg, NomCertInt, segcertint.IdCerInt FROM certinterna,segcertint,seguimiento
                WHERE certinterna.IdCerInt = segcertint.IdCerInt AND
                seguimiento.IdSeg = segcertint.IdSeg";
        $datos = $this->mostrar($sql);
        $this->cerrar_conexion();

        return $datos;

    
    }
    public function buscarCursos()
    {
        # buscamos Cursos
        $this->conexion_bd();
        $sql = "SELECT seguimiento.IdSeg, NomCur, segcursos.ClaveCur FROM cursos,segcursos,seguimiento
                WHERE seguimiento.IdSeg = segcursos.IdSeg AND
                cursos.ClaveCur = segcursos.ClaveCur";
        $datos = $this->mostrar($sql);
        $this->cerrar_conexion();

        return $datos;

    
    }
    public function buscarProyectos()
    {
        # buscamos Proyectos
        $this->conexion_bd();
        $sql = "SELECT seguimiento.IdSeg, NomProyecto, segproyectos.IdPro FROM proyectos, segproyectos, seguimiento
                WHERE seguimiento.IdSeg = segproyectos.IdSeg
                AND	proyectos.IdPro = segproyectos.IdPro";
        $datos = $this->mostrar($sql);
        $this->cerrar_conexion();

        return $datos;

    
    }

    # apartir de aqui comiensan las consultas de gastos e ingresos

    public function consultaEmpresa($id_seguimiento)
    {
        # trae wl nombre, los gastos, e ingresos de las empresas con ese id de seguimiento
        $this->conexion_bd();
        $sql = "SELECT empparticipa.IdParE as id ,CONCAT('Emp. ',usuaemp.NomUsuaEmp) as nombre 
                FROM empparticipa 
                INNER JOIN usuaemp on usuaemp.RFCUsuaEmp = empparticipa.RFCUsuaEmp 
                WHERE empparticipa.IdSeg = :id
                GROUP BY nombre
                ORDER BY empparticipa.IdParE";
        $dato = $this->mostrar($sql,[":id"=>$id_seguimiento]);

        $sql2 = "SELECT empgastos.IdParE as id,SUM(controlgas.MontoGas) as total, tipogastos.TipoGas as tipo FROM empparticipa
                INNER JOIN empgastos on empgastos.IdParE = empparticipa.IdParE
                INNER JOIN controlgas on controlgas.IdGas = empgastos.IdGas
                INNER JOIN  contipogas on contipogas.IdGas = controlgas.IdGas and empparticipa.IdSeg = :id
                RIGHT JOIN tipogastos on tipogastos.IdGasto = contipogas.IdGasto
                GROUP BY empgastos.IdParE,tipogastos.IdGasto
                ORDER BY empparticipa.IdParE, tipogastos.IdGasto";
        $datos2 = $this->mostrar($sql2,[":id"=>$id_seguimiento]);


        $sql3 = "SELECT empparticipa.IdParE as id,SUM(controlingre.MontoIngre) as ingresosTotales 
                FROM empparticipa 
                INNER JOIN empingresos on empingresos.IdParE = empparticipa.IdParE 
                INNER JOIN controlingre on controlingre.IdIngre = empingresos.IdIngre and empparticipa.IdSeg = :id
                GROUP BY  empparticipa.IdParE
                ORDER BY empparticipa.IdParE";
        $datos3 = $this->mostrar($sql3,[":id"=>$id_seguimiento]);
        
        $this->cerrar_conexion();

        $datos = array($dato,$datos2,$datos3);

        return $datos;
        
    }

    public function consultaSocio($id_seguimiento)
    {
        # trae el nombre, los gastos, e ingresos de los socios con ese id de seguimiento
        $this->conexion_bd();
        $sql1 = "SELECT persoparticipa.IdParP as id,CONCAT('Asoc. ',usuaperso.NomPerso,' ',COALESCE(usuaperso.ApePPerso, ''),' ',COALESCE(usuaperso.ApeMPerso, '')) as nombre FROM persoparticipa 
                INNER JOIN usuaperso on usuaperso.IdPerso = persoparticipa.IdPerso  
                WHERE persoparticipa.IdSeg = :id
                GROUP BY nombre
                ORDER BY persoparticipa.IdParP";
        $datos1 = $this->mostrar($sql1,[":id"=>$id_seguimiento]);

        $sql2 = "SELECT persogastos.IdParP as id,SUM(controlgas.MontoGas) as total, tipogastos.TipoGas as tipo FROM persoparticipa
                INNER JOIN persogastos on persogastos.IdParP = persoparticipa.IdParP
                INNER JOIN controlgas on controlgas.IdGas = persogastos.IdGas
                INNER JOIN  contipogas on contipogas.IdGas = controlgas.IdGas and persoparticipa.IdSeg = :id
                INNER JOIN tipogastos on tipogastos.IdGasto = contipogas.IdGasto
                GROUP BY  persogastos.IdParP,tipogastos.TipoGas
                ORDER BY  persoparticipa.IdParP ,tipogastos.IdGasto";
        $datos2 = $this->mostrar($sql2,[":id"=>$id_seguimiento]);

        $sql3 = "SELECT persoparticipa.IdParP as id ,SUM(controlingre.MontoIngre) as ingresosTotales FROM persoparticipa 
                INNER JOIN usuaperso on usuaperso.IdPerso = persoparticipa.IdPerso 
                INNER JOIN persoingresos on persoingresos.IdParP = persoparticipa.IdParP 
                INNER JOIN controlingre on controlingre.IdIngre = persoingresos.IdIngre and persoparticipa.IdSeg = :id
                GROUP BY  persoparticipa.IdParP
                ORDER BY persoparticipa.IdParP";
        $datos3 = $this->mostrar($sql3,[":id"=>$id_seguimiento]);
        $this->cerrar_conexion();

        $datos = array($datos1,$datos2,$datos3);

        return $datos;
    }
    public function consultaInstructor($id_seguimiento)
    {
        # trae el nombre, los gastos, e ingresos de los instructores con ese id de seguimiento
        $this->conexion_bd();
        $sql1 = "SELECT insparticipa.IdParI as id,CONCAT('Instr. ',instructor.NomIns,' ',COALESCE(instructor.ApePIns, ''),' ',COALESCE(instructor.ApeMIns, '')) as nombre FROM insparticipa
                INNER JOIN instructor on instructor.ClaveIns = insparticipa.ClaveIns
                WHERE insparticipa.IdSeg = :id
                GROUP BY nombre
                ORDER BY insparticipa.IdParI";
        $datos1 = $this->mostrar($sql1,[":id"=>$id_seguimiento]);

        $sql2 = "SELECT insparticipa.IdParI as id ,SUM(controlgas.MontoGas) as total, tipogastos.TipoGas as tipo FROM insparticipa
                INNER JOIN insgastos on insgastos.IdParI = insparticipa.IdParI
                INNER JOIN controlgas on controlgas.IdGas = insgastos.IdGas
                INNER JOIN  contipogas on contipogas.IdGas = controlgas.IdGas and insparticipa.IdSeg = :id
                INNER JOIN tipogastos on tipogastos.IdGasto = contipogas.IdGasto
                GROUP BY  insgastos.IdParI,tipogastos.TipoGas
                ORDER BY  insparticipa.IdParI ,tipogastos.IdGasto;";
        $datos2 = $this->mostrar($sql2,[":id"=>$id_seguimiento]);

        $sql3 = "SELECT  insparticipa.IdParI as id,SUM(controlingre.MontoIngre) as ingresosTotales FROM insparticipa
                INNER JOIN insingresos on insingresos.IdParI = insparticipa.IdParI
                INNER JOIN controlingre on controlingre.IdIngre = insingresos.IdIngre 
                WHERE insparticipa.IdSeg = :id
                GROUP BY insparticipa.IdParI
                ORDER BY insparticipa.IdParI";
        $datos3 = $this->mostrar($sql3,[":id"=>$id_seguimiento]);
        $this->cerrar_conexion();

        $datos = array($datos1,$datos2,$datos3);

        return $datos;
    }

    // confecha ----------------------------------------------------------------------------------
    

    public function consultaEmpresaFecha($id_seguimiento,$inicio,$fin)
    {
        # trae wl nombre, los gastos, e ingresos de las empresas con ese id de seguimiento
        $this->conexion_bd();
        $sql = "SELECT empparticipa.IdParE as id ,CONCAT('Emp. ',usuaemp.NomUsuaEmp) as nombre 
                FROM empparticipa 
                INNER JOIN usuaemp on usuaemp.RFCUsuaEmp = empparticipa.RFCUsuaEmp 
                WHERE empparticipa.IdSeg = :id
                GROUP BY nombre
                ORDER BY empparticipa.IdParE";
        $dato = $this->mostrar($sql,[":id"=>$id_seguimiento]);

        $sql2 = "SELECT empgastos.IdParE as id,SUM(controlgas.MontoGas) as total, tipogastos.TipoGas as tipo FROM empparticipa
                INNER JOIN empgastos on empgastos.IdParE = empparticipa.IdParE
                INNER JOIN (SELECT * FROM controlgas WHERE controlgas.FechaGas BETWEEN :inicio AND :fin ) as controlgas on controlgas.IdGas = empgastos.IdGas 
                INNER JOIN  contipogas on contipogas.IdGas = controlgas.IdGas and empparticipa.IdSeg = :id
                RIGHT JOIN tipogastos on tipogastos.IdGasto = contipogas.IdGasto 
                GROUP BY empgastos.IdParE,tipogastos.IdGasto
                ORDER BY empparticipa.IdParE, tipogastos.IdGasto";
        $datos2 = $this->mostrar($sql2,[":id"=>$id_seguimiento,":inicio"=>$inicio, ":fin"=>$fin]);


        $sql3 = "SELECT empparticipa.IdParE as id,SUM(controlingre.MontoIngre) as ingresosTotales 
                FROM empparticipa 
                INNER JOIN empingresos on empingresos.IdParE = empparticipa.IdParE 
                INNER JOIN (SELECT * FROM controlingre WHERE controlingre.FechaIngre BETWEEN :inicio AND :fin ) as controlingre on controlingre.IdIngre = empingresos.IdIngre and empparticipa.IdSeg = :id
                GROUP BY  empparticipa.IdParE
                ORDER BY empparticipa.IdParE";
        $datos3 = $this->mostrar($sql3,[":id"=>$id_seguimiento,":inicio"=>$inicio, ":fin"=>$fin]);
        
        $this->cerrar_conexion();

        $datos = array($dato,$datos2,$datos3);

        return $datos;
        
    }

    public function consultaSocioFecha($id_seguimiento,$inicio,$fin)
    {
        # trae el nombre, los gastos, e ingresos de los socios con ese id de seguimiento
        $this->conexion_bd();
        $sql1 = "SELECT persoparticipa.IdParP as id,CONCAT('Asoc. ',usuaperso.NomPerso,' ',COALESCE(usuaperso.ApePPerso, ''),' ',COALESCE(usuaperso.ApeMPerso, '')) as nombre FROM persoparticipa 
                INNER JOIN usuaperso on usuaperso.IdPerso = persoparticipa.IdPerso  
                WHERE persoparticipa.IdSeg = :id
                GROUP BY nombre
                ORDER BY persoparticipa.IdParP";
        $datos1 = $this->mostrar($sql1,[":id"=>$id_seguimiento]);

        $sql2 = "SELECT persogastos.IdParP as id,SUM(controlgas.MontoGas) as total, tipogastos.TipoGas as tipo FROM persoparticipa
                INNER JOIN persogastos on persogastos.IdParP = persoparticipa.IdParP
                INNER JOIN (SELECT * FROM controlgas WHERE controlgas.FechaGas BETWEEN :inicio AND :fin ) as controlgas on controlgas.IdGas = persogastos.IdGas
                INNER JOIN  contipogas on contipogas.IdGas = controlgas.IdGas and persoparticipa.IdSeg = :id
                INNER JOIN tipogastos on tipogastos.IdGasto = contipogas.IdGasto
                GROUP BY  persogastos.IdParP,tipogastos.TipoGas
                ORDER BY  persoparticipa.IdParP ,tipogastos.IdGasto";
        $datos2 = $this->mostrar($sql2,[":id"=>$id_seguimiento,":inicio"=>$inicio, ":fin"=>$fin]);

        $sql3 = "SELECT persoparticipa.IdParP as id ,SUM(controlingre.MontoIngre) as ingresosTotales FROM persoparticipa 
                INNER JOIN usuaperso on usuaperso.IdPerso = persoparticipa.IdPerso 
                INNER JOIN persoingresos on persoingresos.IdParP = persoparticipa.IdParP 
                INNER JOIN (SELECT * FROM controlingre WHERE controlingre.FechaIngre BETWEEN :inicio AND :fin ) as controlingre on controlingre.IdIngre = persoingresos.IdIngre and persoparticipa.IdSeg = :id
                GROUP BY  persoparticipa.IdParP
                ORDER BY persoparticipa.IdParP";
        $datos3 = $this->mostrar($sql3,[":id"=>$id_seguimiento,":inicio"=>$inicio, ":fin"=>$fin]);
        $this->cerrar_conexion();

        $datos = array($datos1,$datos2,$datos3);

        return $datos;
    }
    public function consultaInstructorFecha($id_seguimiento,$inicio,$fin)
    {
        # trae el nombre, los gastos, e ingresos de los instructores con ese id de seguimiento
        $this->conexion_bd();
        $sql1 = "SELECT insparticipa.IdParI as id,CONCAT('Instr. ',instructor.NomIns,' ',COALESCE(instructor.ApePIns, ''),' ',COALESCE(instructor.ApeMIns, '')) as nombre FROM insparticipa
                INNER JOIN instructor on instructor.ClaveIns = insparticipa.ClaveIns
                WHERE insparticipa.IdSeg = :id
                GROUP BY nombre
                ORDER BY insparticipa.IdParI";
        $datos1 = $this->mostrar($sql1,[":id"=>$id_seguimiento]);

        $sql2 = "SELECT insparticipa.IdParI as id ,SUM(controlgas.MontoGas) as total, tipogastos.TipoGas as tipo FROM insparticipa
                INNER JOIN insgastos on insgastos.IdParI = insparticipa.IdParI
                INNER JOIN (SELECT * FROM controlgas WHERE controlgas.FechaGas BETWEEN :inicio AND :fin ) as controlgas on controlgas.IdGas = insgastos.IdGas
                INNER JOIN  contipogas on contipogas.IdGas = controlgas.IdGas and insparticipa.IdSeg = :id
                INNER JOIN tipogastos on tipogastos.IdGasto = contipogas.IdGasto
                GROUP BY  insgastos.IdParI,tipogastos.TipoGas
                ORDER BY  insparticipa.IdParI ,tipogastos.IdGasto;";
        $datos2 = $this->mostrar($sql2,[":id"=>$id_seguimiento,":inicio"=>$inicio, ":fin"=>$fin]);

        $sql3 = "SELECT  insparticipa.IdParI as id,SUM(controlingre.MontoIngre) as ingresosTotales FROM insparticipa
                INNER JOIN insingresos on insingresos.IdParI = insparticipa.IdParI
                INNER JOIN (SELECT * FROM controlingre WHERE controlingre.FechaIngre BETWEEN :inicio AND :fin ) as controlingre on controlingre.IdIngre = insingresos.IdIngre 
                WHERE insparticipa.IdSeg = :id
                GROUP BY insparticipa.IdParI
                ORDER BY insparticipa.IdParI";
        $datos3 = $this->mostrar($sql3,[":id"=>$id_seguimiento,":inicio"=>$inicio, ":fin"=>$fin]);
        $this->cerrar_conexion();

        $datos = array($datos1,$datos2,$datos3);

        return $datos;
    }

    public function periodoHistorico($id_seguimiento)
    {
        # te da la fecha mas antigua y la mas nueva en la quye se ha registrado un gasto
        # o un ingreso del id de seguimiento que le des
        $this->conexion_bd();
        $sql = "SELECT DATE_FORMAT(MIN(fechas), '%d/%m/%Y') as antigua, DATE_FORMAT(MAX(fechas), '%d/%m/%Y')  as reciente from ((select controlgas.FechaGas as fechas from controlgas
                INNER JOIN ((SELECT empgastos.IdGas as IdGas from empparticipa
                INNER JOIN empgastos ON empgastos.IdParE = empparticipa.IdParE and empparticipa.IdSeg = :id)
                UNION ALL
                (SELECT persogastos.IdGas as IdGas from persoparticipa
                INNER JOIN persogastos ON persogastos.IdParP = persoparticipa.IdParP and persoparticipa.IdSeg = :id)
                UNION ALL
                (SELECT insgastos.IdGas as IdGas from insparticipa
                INNER JOIN insgastos ON insgastos.IdParI = insparticipa.IdParI and insparticipa.IdSeg = :id)) 
                as tablaGas
                ON tablaGas.IdGas = controlgas.IdGas)
                UNION All 
                (select controlingre.FechaIngre as fechas from controlingre
                INNER JOIN ((SELECT empingresos.IdIngre as IdIngre from empparticipa
                INNER JOIN empingresos ON empingresos.IdParE = empparticipa.IdParE and empparticipa.IdSeg = :id)
                UNION ALL
                (SELECT persoingresos.IdIngre as IdIngre from persoparticipa
                INNER JOIN persoingresos ON persoingresos.IdParP = persoparticipa.IdParP and persoparticipa.IdSeg = :id)
                UNION ALL
                (SELECT insingresos.IdIngre as IdIngre from insparticipa
                INNER JOIN insingresos ON insingresos.IdParI = insparticipa.IdParI and insparticipa.IdSeg = :id)) 
                as tablaIds
                ON tablaIds.IdIngre = controlingre.IdIngre)) as m";
        $fechas = $this->mostrar($sql,[":id"=>$id_seguimiento]);
        $this->cerrar_conexion();
        
        return $fechas;

    }

}






?>