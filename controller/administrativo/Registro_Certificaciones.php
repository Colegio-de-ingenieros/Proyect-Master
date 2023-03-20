<?php
include_once('../../model/Registro_Certificaciones.php');

class RegistroCert{
    private $obj, $idc, $idh, $precio, $logo, $desc, $nombre;

    //inicializa los valores que ocupan las demas funciones
    function instancias(){
        $this->obj = new NuevaCertificacion();
        $this->obj->conexion();
        $this->idc = $this->generarID('cert');
        $this->idh = $this->generarID('histo');
        $this->nombre = $_POST["inputNombre"];
        $this->precio = $_POST["inputPrecio"];
        $this->desc = $_POST["inputDescripcion"];
        $this->logo = $_FILES["inputLogo"]['name'];
        $this->validarFoto();

    }

    //busca el ultimo ID de la tabla que le piden y genera el siguiente
    function generarID($tipo){
        if($tipo == 'cert'){
            $ids = $this->obj->buscarUltimoIdCert();
        }

        else{
            $ids = $this->obj->buscarUltimoIdHist();
        }
        
        $id = floatval($ids) +1; 

        $ids = strval($id);


        for($i=strlen($ids); $i<6; $i++){
            $ids = '0'.$ids;
        }

        return $ids;
    }

    //manda a llamar al archivo de model para meter los datos a la base
    function insertar(){
        $fecha = date('y-m-d');
        $this->obj->insertar($this->idc, $this->logo, $this->desc,$this->nombre, $this->precio, $fecha, $this->idh);

        //verifica que los datos se insertarin en la base de datos
        $resultados = $this->obj->buscarPorId($this->idc);

        if($resultados == true){
            echo json_encode('todo chido');
        }

        else{
            echo json_encode('Ha ocurrido un error al conectar con la base de datos');
        }
    }

    function validarFoto(){
        //verifica que si se subio un archivo
        if($this->logo != null and $this->logo != ''){
            $tipo = $_FILES['inputLogo']['type'];
            $tamano = $_FILES['inputLogo']['size'];
            $temp = $_FILES['inputLogo']['tmp_name'];

            //verifica que el archivo sea una imagen
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")))) {
                echo json_encode("El archivo debe estar en un formato de imágen (.gif, .jepg, .jpg o .png)");
            }
            
            else{
                $this->logo = file_get_contents($temp);
                $this->insertar();
            }

        }

        else{
            echo json_encode('No se ha subido nungún archivo');
        }
        

    }
}

/*$base = new NuevaCertificacion();
$base->conexion();
$id = $base->buscarUltimoId();

echo($id[0]);*/

$obj = new RegistroCert();
$obj->instancias();

?>