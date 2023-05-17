<?php
include_once('../../model/administrativo/Modificar_Certificaciones.php');

class ModificarCert{
    private $obj, $idc, $idhg, $idha, $precioG, $precioA, $logo, $desc, $nombre, $abre;

    //inicializa los valores que ocupan las demas funciones
    function instancias()
    {
        $this->obj = new NuevaCertificacion();
        $this->obj->conexion();
        $this->idc = $_POST["idc"];
        $this->idhg = $this->generarID();
        $this->idha = $this->otroID();
        $this->nombre = $_POST["nombre"];
        $this->precioG = $_POST["precioGen"];
        $this->precioA = $_POST["precioAsoc"];
        $this->desc = $_POST["descripcion"];
        $this->abre = $_POST["abreviacion"];
        $this->logo = $_FILES["inputLogo"]['name'];
        $this->validarPrecio();
        $this->validarFoto();
    }

    //busca el ultimo ID de la tabla que le piden y genera el siguiente
    function generarID()
    {
            $ids = $this->obj->buscarUltimoIdHist();
        

        $id = floatval($ids) + 1;

        $ids = strval($id);


        for ($i = strlen($ids); $i < 6; $i++) {
            $ids = '0' . $ids;
        }

        return $ids;
    }

    function validarFoto()
    {
        //verifica que si se subio un archivo
        if ($this->logo != null and $this->logo != '') {
            $tipo = $_FILES['inputLogo']['type'];
            $tamano = $_FILES['inputLogo']['size'];
            $temp = $_FILES['inputLogo']['tmp_name'];
            //verifica que el archivo sea una imagen
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")))) {
                echo json_encode("El archivo debe estar en un formato de imágen (.gif, .jepg, .jpg o .png)");
            }

            if (intval($tamano) > 1000000) {
                echo json_encode("El tamaño de la imagen debe ser menor a 1 MB");
            } 
            
            else {
                $this->logo = file_get_contents($temp);
                $this->obj->actualizarConLogo($this->idc, $this->logo, $this->desc, $this->nombre, $this->abre);
                echo json_encode('todo chido');
            }
        }
        
        else {
            $this->obj->actualizarSinLogo($this->idc, $this->desc, $this->nombre, $this->abre);
            echo json_encode('todo chido');
        }
    }

    //toma el id de historico que se acaba de generar y genera el siguiente 
    function otroID()
    {
        $id = floatval($this->idhg) + 1;
        $ids = strval($id);

        for ($i = strlen($ids); $i < 6; $i++) {
            $ids = '0' . $ids;
        }

        return $ids;
    }

    function validarPrecio(){
        //$mostrar = new MostrarCertificaciones();

        $precioAsoc = $this->obj->buscarUltimoPrecioA($this->idc);
        $precioGen = $this->obj->buscarUltimoPrecioG($this->idc);
        $idha = '';
        $fecha = date('y-m-d');

        if($precioAsoc != $this->precioA or $precioGen != $this->precioG){
            $idha = $this->generarID();

           //agregar el precio de asociado
            $this->obj->addHistorial($this->idc, $idha, 1, $fecha, $this->precioA);

            $idhg = $this->otroID();

            //agregar el precio de asociado
            $this->obj->addHistorial($this->idc, $idhg, 5, $fecha, $this->precioG);
        }

    }
}

$obj = new ModificarCert();
$obj->instancias();
?>