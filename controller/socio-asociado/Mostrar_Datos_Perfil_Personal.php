<?php
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    include_once('../../model/socio-asociado/Mostrar_Datos_Perfil_Personal.php');
    include_once('../../view/socio-asociado/Perfil_Personal.html');
    $salida = '';
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

    $resultado1=$base->domicilio($idperso);
    $codigo=$resultado1[0]['codpostal'];
    $codigoPostal=$codigo;

    $resultado1_1=$base->domicilio_completo($codigoPostal);
    $col=$resultado1_1[0]['nomcolonia'];
    $muni=$resultado1_1[0]['nommunicipio'];
    $esta=$resultado1_1[0]['nomestado'];
    $colonia=$col;
    $municipio=$muni;
    $estado=$esta;

    $resultado2=$base->estudios($idperso);
    $est=$resultado2[0]['IdGrado'];
    $estudios=$est;

    $resultado3=$base->certificaciones($idperso);
    $nombreCer="";
    $organizacionCer="";
    $iniCer="";
    $finCer="";
    

    $resultado4=$base->datos_laborales($idperso);
    $nombreEmp="";
    $puestoEmp="";
    $correoEmp="";
    $telEmp="";
    $extTelEmp="";

  

    if ($resultado3 == true) {
        $llenarcer = "si";
        $nombre_certificacion=$resultado3[0]['NomCerExt'];
        $organizacion_certificacion=$resultado3[0]['OrgCerExt'];
        $inicio_certificacion=$resultado3[0]['IniCerExt'];
        $fin_certificacion=$resultado3[0]['FinCerExt'];

        $nombreCer=$nombre_certificacion;
        $organizacionCer=$organizacion_certificacion;
        $iniCer=$inicio_certificacion;
        $finCer=$fin_certificacion;


        
        
        
    } else {
        $llenarcer = "no";
        
    }

    if ($resultado4 == true) {
        $llenarlab = "si";
        $id_certificacion=$resultado4[0]['IdEmpPerso'];
        $nombre_empresa=$resultado4[0]['NomEmpPerso'];
        $puesto_empresa=$resultado4[0]['PuestoEmpPerso'];
        $correo_empresa=$resultado4[0]['CorreoEmpPerso'];
        $telefono_empresa=$resultado4[0]['TelFEmpPerso'];
        $extTelefono_empresa=$resultado4[0]['ExtenTelFEmpPerso'];

        $idEmp=$id_certificacion;
        $nombreEmp=$nombre_empresa;
        $puestoEmp=$puesto_empresa;
        $correoEmp=$correo_empresa;
        $telEmp= $telefono_empresa;
        $extTelEmp=$extTelefono_empresa;
    
        
    } else {
        $llenarlab = "no";
        
    }

    
    $resultado5=$base->funciones($idEmp);
    $nombre_funcion=$resultado5[0]['NomFuncion'];
    $nomFunc=$nombre_funcion;

}


?>

<script languaje="javascript">
    llenartabla1();
    function llenartabla1() {
    var tbody = document.getElementById("body_tabla1");
    if ("<?php echo $llenarcer ?>" == "si"){
    var datos = [
    { nombre: "<?php echo $nombreCer ?>", organizacion: "<?php echo $organizacionCer ?>", emision: "<?php echo $iniCer ?>", vigencia: "<?php echo $finCer ?>" }
];


for (var i = 0; i < datos.length; i++) {
    var fila = document.createElement("tr");

    var celdaNombre = document.createElement("td");
    celdaNombre.textContent = datos[i].nombre;
    fila.appendChild(celdaNombre);

    var celdaOrganizacion = document.createElement("td");
    celdaOrganizacion.textContent = datos[i].organizacion;
    fila.appendChild(celdaOrganizacion);

    var celdaEmision = document.createElement("td");
    celdaEmision.textContent = datos[i].emision;
    fila.appendChild(celdaEmision);

    var celdaVigencia = document.createElement("td");
    celdaVigencia.textContent = datos[i].vigencia;
    fila.appendChild(celdaVigencia);

    var celdaAcciones = document.createElement("td");
    celdaAcciones.textContent = "Acciones"; // Puedes agregar botones u otros elementos aquí
    fila.appendChild(celdaAcciones);

    tbody.appendChild(fila);
}
}
    }


    llenartabla2();
    function llenartabla2() {
    var tbody2 = document.getElementById("body_tabla2");
    if ("<?php echo $llenarlab ?>" == "si"){
    var datos = [
    { funcion: "<?php echo $nomFunc ?>" }
];


for (var i = 0; i < datos.length; i++) {
    var fila2 = document.createElement("tr");

    var celdafuncion = document.createElement("td");
    celdafuncion.textContent = datos[i].funcion;
    fila2.appendChild(celdafuncion);

    var celdaAcciones = document.createElement("td");
    celdaAcciones.textContent = "Acciones"; // Puedes agregar botones u otros elementos aquí
    fila2.appendChild(celdaAcciones);

    tbody2.appendChild(fila2);
}
}
    }
</script>



    <!-- script para poner los valores en los campos correspondientes -->
    <script languaje="javascript">
        var cedula = "<?php echo $cedula1 ?>";
        var pasantia = "<?php echo $pasantia ?>";
        var laborales = "<?php echo $llenarlab ?>";
        var colonia = "<?php echo $colonia ?>";
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
        
        document.getElementById("ciudadPerso").value = "<?php echo $municipio ?>";
        document.getElementById("estadoPerso").value = "<?php echo $estado ?>";
        document.getElementById("tipoGradoPerso").value = "<?php echo $estudios ?>";

        document.getElementById("coloniaPerso").innerHTML = "";
        var optionElement = document.createElement("option");
        optionElement.value = 0;
        optionElement.text = colonia;
        document.getElementById("coloniaPerso").appendChild(optionElement);
           
        if (pasantia==1){
            document.getElementById("pasantia1").checked = true;
        }else{
            document.getElementById("pasantia2").checked = true;
        }
        if (pasantia==1){
            document.getElementById("pasantia1").checked = true;
        }else{
            document.getElementById("pasantia2").checked = true;
        }
        if (laborales=="si"){
            document.getElementById("checkboxlaboral").checked = true;
            document.getElementById("nomEmpPerso").value = "<?php echo $nombreEmp ?>";
            document.getElementById("puestoEmpPerso").value = "<?php echo $puestoEmp ?>";
            document.getElementById("correoEmpPerso").value = "<?php echo $correoEmp ?>";
            document.getElementById("telFEmpPerso").value = "<?php echo $telEmp ?>";
            document.getElementById("ExtTelFEmp").value = "<?php echo $extTelEmp ?>";
        }else{
            document.getElementById("checkboxlaboral").checked = false;
        }
    
    
    </script>