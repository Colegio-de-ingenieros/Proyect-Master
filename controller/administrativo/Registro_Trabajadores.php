<?php
include_once('../../model/Reg_Trabajadores.php');

class RegistroTrabajadores{
    private $obj, $rfc, $nombre, $apaterno, $amaterno, $correo, $telefono, $pass;
    echo 'console.log("hola")';
    //inicializa los valores que ocupan las demas funciones
    function instancias(){
        $this->obj = new NuevoTrabajador();
        $this->obj->conexion();
        $this->rfc = $_POST["caja_rfc"];
        $this->nombre = $_POST["caja_nombre"];
        $this->apaterno = $_POST["caja_ap_paterno"];
        $this->amaterno = $_POST["caja_ap_materno"];
        $this->correo = $_POST["caja_correo"];
        $this->telefono = $_POST["caja_telefono"];
        $this->pass = $_POST["caja_contra"];
        $this->insertar();
    }
    

    //manda a llamar al archivo de model para meter los datos a la base
    function insertar(){
        $this->obj->insertar($this->rfc, $this->nombre, $this->apaterno, $this->amaterno, $this->correo, $this->telefono, $this->pass);

        //verifica que los datos se insertarin en la base de datos
        $resultados = $this->obj->buscarPorRFC($this->rfc);

        
        if($resultados == true){
            echo json_encode('exito');
        }

        else{
            echo json_encode('Ha ocurrido un error al conectar con la base de datos');
        }
    }

}

$obj = new RegistroTrabajadores();
$obj->instancias();

?>