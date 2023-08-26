<?php
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    include_once('../../model/socio-asociado/Mostrar_Datos_Perfil_Personal.php');
    include_once('../../view/socio-asociado/Perfil_Personal.html');
    $base = new mostrarDatosPersonales();

    $resultado=$base->datos_personales($usuario);
    $idp=$resultado[0]['IdPerso'];
    $nombre_p=$resultado[0]['NomPerso'];
    $apeP=$resultado[0]['ApePPerso'];
    $apeM=$resultado[0]['ApeMPerso'];
    $cedul=$resultado[0]['CedulaPerso'];
    $telF=$resultado[0]['TelFPerso'];
    $telM=$resultado[0]['TelMPerso'];
    $fech=$resultado[0]['FechaNacPerso'];
    $cal=$resultado[0]['CallePerso'];
    $pasan=$resultado[0]['PasantiaPerso'];
    $ced=$resultado[0]['ceduPerso'];
    $idperso=$idp; 
    $nombre=$nombre_p;
    $apellidoP=$apeP;
    $apellidoM=$apeM;
    $cedula=$cedul;
    $telefonoF=$telF;
    $telefonoM=$telM;
    $fecha=$fech;
    $calle=$cal;  
    $pasantia=$pasan;
    $cedula1=$ced;
    echo $pasantia;

    $resultado1=$base->domicilio($idperso);
    $codigo=$resultado1[0]['codpostal'];
    $codigoPostal=$codigo;

    $resultado2=$base->estudios($idperso);
    $est=$resultado2[0]['IdGrado'];
    $estudios=$est;
    
}
?>

    <!-- script para poner los valores en los campos correspondientes -->
    <script languaje="javascript">
        var cedula = "<?php echo $cedula1 ?>";
        var pasantia = "<?php echo $pasantia ?>";
        document.getElementById("nomPerso").value = "<?php echo $nombre ?>";
        document.getElementById("apePPerso").value = "<?php echo $apellidoP ?>";
        document.getElementById("apeMPerso").value = "<?php echo $apellidoM ?>";
        document.getElementById("fechaNacPerso").value = "<?php echo $fecha ?>";
        document.getElementById("telFPerso").value = "<?php echo $telefonoF ?>";
        document.getElementById("telMPerso").value = "<?php echo $telefonoM ?>";
        document.getElementById("correoPerso").value = "<?php echo $usuario ?>";
        document.getElementById("cedulaPerso").value = "<?php echo $cedula ?>";
        if (cedula==1){
            document.getElementById("ceduPerso1").checked = true;
        }else{
            document.getElementById("ceduPerso2").checked = true;
        }
        document.getElementById("cpPerso").value = "<?php echo $codigoPostal ?>";
        document.getElementById("callePerso").value = "<?php echo $calle ?>";
        document.getElementById("tipoGradoPerso").value = "<?php echo $estudios ?>";
        if (pasantia==1){
            document.getElementById("pasantia1").checked = true;
        }else{
            document.getElementById("pasantia2").checked = true;
        }
    
    
    </script>