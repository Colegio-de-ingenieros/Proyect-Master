<?php

include_once('../../model/Reg_Cursos.php');
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
        echo json_encode('duracion'. $this->duracion);
        $idt=0;
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
                            $this->obj->insertaTema($idt, $this->tema);
                            $this->obj->cursoTema($this->clave,$idt);
                            
                        }
                        else{
                            $idt=0;
                            $this->tema = $lista1[$i][$j];
                            $this->obj->insertaTema($idt, $this->tema);
                            $this->obj->cursoTema($this->clave,$idt);

                        }
                        
                    }
                    else{
                        $res1=$this->obj->idsub();
                        $idsub=$res1[0][0];
                        
                        $ids=$idsub+1;
                       
                        if ($ids!=0){
                           
                            //Agrega subtema  ala base
                            $this->subtema = $lista1[$i][$j];
                            $this->obj->insertaSubtema($ids, $this->subtema,$idt);
                        }
                        else{
                            $ids=0;
                            $this->subtema = $lista1[$i][$j];
                            $this->obj->insertaSubtema($ids, $this->subtema,$idt);

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


