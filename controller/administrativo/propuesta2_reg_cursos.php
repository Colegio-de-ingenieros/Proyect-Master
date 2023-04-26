<?php

include_once('../../model/administrativo/propuesta2_reg_cursos.php');
class RegistroCursos{
    private $obj, $nombre, $objetivo, $duracion, $tema , $subtema;

    
    function instancias(){
        //formulario
        $arreglo = json_decode($_POST["arrayin"]);
        //temas
        $lista1 = json_decode($_POST["lista"]);
        $this->obj = new NuevoCurso();
        $this->obj->conexion();
      

        //clave, nombre,objetivo, duracion
      
        $this->clave = $arreglo[1];
        $this->nombre = $arreglo[0];
        $this->objetivo = $arreglo[3];
        $this->duracion = $arreglo[2];
        $idt=0;
        $numero_orden_subtema = 1;
        $numero_orden_tema = 1;
        //Compara que la clave del curso exista
       $resultados = $this->obj->buscarClave($this->clave);

        if($resultados == true){
            echo json_encode('Ya se encuentra registrada la clave del curso');
        }

        else{
            $this->obj->insertaCurso($this->clave, $this->nombre, $this->objetivo, $this->duracion);

    
            for ($i = 0; $i < count($lista1); $i++) {

                for ($j = 0; $j < count($lista1[$i]); $j++) {
                    if ($j==0) {
                        $res=$this->obj->idtema();
                        $idtema=$res[0][0];
                        $idt=$idtema+1;
                    
                        if ($idt!=0){
                            //Agrega tema  ala base
                            $this->tema = $lista1[$i][$j];
                            $this->obj->insertaTema($idt, $this->tema,$numero_orden_tema);
                            $this->obj->cursoTema($this->clave,$idt);
                            $numero_orden_tema++;
                            
                        }
                        else{
                            $idt=0;
                            $this->tema = $lista1[$i][$j];
                            $this->obj->insertaTema($idt, $this->tema,$numero_orden_tema);
                            $this->obj->cursoTema($this->clave,$idt);
                            $numero_orden_tema++;

                        }
                        
                    }
                    else{
                        $res1=$this->obj->idsub();
                        $idsub=$res1[0][0];
                        
                        $ids=$idsub+1;
                       
                        if ($ids!=0){
                           
                            //Agrega subtema  ala base
                            $this->subtema = $lista1[$i][$j];
                            $this->obj->insertaSubtema($ids, $this->subtema,$idt,$numero_orden_subtema);
                            $numero_orden_subtema++;
                        }
                        else{
                            $ids=0;
                            $this->subtema = $lista1[$i][$j];
                            $this->obj->insertaSubtema($ids, $this->subtema,$idt,$numero_orden_subtema);
                            $numero_orden_subtema++;

                        }
                    }
                    
                    
                    
                }

              
               }
            echo json_encode('Registro exitoso');
        }
        

    

}
}

$obj = new RegistroCursos();
$obj->instancias();
?>
