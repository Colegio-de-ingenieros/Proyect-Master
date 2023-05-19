<?php
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];
    //obtener el id
    $idV = $_GET["idV"];

    //llamar a los otros archivos que se ocupan
    include_once('../../model/socio-asociado/Mostrar_Cuotas.php');
    include_once('../../view/socio-asociado/Modi_Cuota.html');

    //instancias la clase para buscar y traer los datos
    $base = new MostrarCuota();
    $resultado=$base->buscar_datos($idV);
    $id = $base->usuario($usuario);
    $id = $id[0]['IdPerso'];
    $id_cuota = $base->id_cuotas($id);
    $id_cuota = $id_cuota[0]['IdVigCuo'];

    //guardar los datos en variables
    $tipo=$resultado[0]["IdCuota"];
    $monto = $resultado[0]["MontoVigCuo"];
    $inicio = $resultado[0]["IniVigCuo"];
    $fin = $resultado[0]["FinVigCuo"];
}
?>


<!-- script para poner los valores en los campos correspondientes -->
<script languaje="javascript">
    document.getElementById("idV").value = "<?php echo $idV ?>";
    document.getElementById("tipo").value = "<?php echo $tipo ?>";
    document.getElementById("monto").value = "<?php echo $monto ?>";
    document.getElementById("fechainicio").value = "<?php echo $inicio ?>";
    document.getElementById("fechafin").value = "<?php echo $fin ?>";
    document.getElementById("archivo").setAttribute('href', ('../../controller/comprobantes/<?php echo $id_cuota ?>'));
</script>