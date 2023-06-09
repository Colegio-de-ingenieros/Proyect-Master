<?php
include_once('../../model/administrativo/Reg_Certificaciones.php');

class RegistroCert{
    private $obj, $idc, $idhg, $idha, $precioG, $precioA, $logo, $desc, $nombre, $abre;

    //inicializa los valores que ocupan las demas funciones
    function instancias(){
        $this->obj = new NuevaCertificacion();
        $this->obj->conexion();
        $this->idc = $this->generarID('cert');
        $this->idhg = $this->generarID('histo');
        $this->idha = $this->otroID('histo');
        $this->nombre = $_POST["nombre"];
        $this->precioG = $_POST["precioGen"];
        $this->precioA = $_POST["precioAsoc"];
        $this->desc = $_POST["descripcion"];
        $this->abre = $_POST["abreviacion"];
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
        $this->obj->insertar($this->idc, $this->logo, $this->desc,$this->nombre, $this->precioG, $this->precioA, $fecha, $this->idhg, $this->idha, $this->abre);

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
            if(intval($tamano)>1000000){
                echo json_encode("El tamaño de la imagen debe ser menor a 1 MB");
            }
            else{
                $this->logo = file_get_contents($temp);
                $this->insertar();
            }

        }

        else{
            echo json_encode('No se ha subido ningún archivo');
        }
        

    }

    //toma el id de historico que se acaba de generar y genera el siguiente
    function otroID(){
        $id = floatval($this->idhg) + 1;
        $ids = strval($id);

        for ($i = strlen($ids); $i < 6; $i++) {
            $ids = '0' . $ids;
        }
        
        return $ids;
    }
}

$obj = new RegistroCert();
$obj->instancias();

?>