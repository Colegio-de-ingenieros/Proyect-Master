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

    if ($cedula=="NULL"){
        $cedula="";
    }else{
        $cedula;
    }

    $resultado1=$base->domicilio($idperso);
    $colonia1=$resultado1[0]['IdColonia'];
    $codigo=$resultado1[0]['codpostal'];
    $codigoPostal=$codigo;

    $resultado1_1=$base->domicilio_completo($codigoPostal, $colonia1);
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
        for ($i = 0; $i < count($resultado3); $i++) {
            $id_certificacion=$resultado3[$i]['IdCerExt'];
            $nombre_certificacion=$resultado3[$i]['NomCerExt'];
            $organizacion_certificacion=$resultado3[$i]['OrgCerExt'];
            $inicio_certificacion=$resultado3[$i]['IniCerExt'];
            $fin_certificacion=$resultado3[$i]['FinCerExt'];
            ?>
            <script languaje="javascript">
            llenartabla1();
            function llenartabla1() {
            var tbody = document.getElementById("body_tabla1");
            if ("<?php echo $llenarcer ?>" == "si"){
            var datos = [
            { nombre: "<?php echo $nombre_certificacion ?>", organizacion: "<?php echo $organizacion_certificacion ?>", emision: "<?php echo $inicio_certificacion ?>", vigencia: "<?php echo $fin_certificacion ?>" }
        ];


        for (var i = 0; i < datos.length; i++) {
            var id="<?php echo $id_certificacion ?>"
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
            
            let icono_eliminar = document.createElement("i");
            icono_eliminar.className = "ti ti-backspace-filled";

            var celdaAcciones = document.createElement("td");
            //eldaAcciones.classList.add("btn-small");

            var botonEliminar = document.createElement("button");
            botonEliminar.className = "btn btn-danger btn btn-small btn-danger";
            botonEliminar.type = "button";
            botonEliminar.style.fontSize = "0.8rem"; // Ajustar el tamaño de fuente
            botonEliminar.style.padding = "6px 10px"; // Ajustar el relleno
            botonEliminar.setAttribute('onclick', 'confirmacion('+ id +')');
            
            botonEliminar.appendChild(icono_eliminar);

            celdaAcciones.appendChild(botonEliminar);
            fila.appendChild(celdaAcciones);

            tbody.appendChild(fila);
        }
        }
        
            }   
            function confirmacion(id){
            if (confirm("¿Está seguro que desea eliminar esta certificación?")) {
                var idc = id.toString().padStart(6, '0');
                
                
                // Realizar la solicitud Ajax para eliminar el elemento
                $.ajax({
                    //manda a llamar al php que tiene la logica para eliminar
                    url: '../../controller/socio-asociado/Eliminar_Cert_Perfil_Personal.php', 
                    type: 'GET', 
                    data: {idc: idc}, 
                    success: function (response)
                    {
                        // Procesar la respuesta del servidor en caso de éxito
                        
                        alert('Eliminado con éxito');
                        // volver a la pagina de vista
                        location.href = '../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php';
                    },
                });


            } else {
            }
            };
        
            </script>
            <?php
        }


        
        
        
    } else {
        $llenarcer = "no";
        
    }

    if ($resultado4 == true) {
        $llenarlab = "si";
        for ($i = 0; $i < count($resultado4); $i++) {
            $id_certificacion=$resultado4[$i]['IdEmpPerso'];
            $nombre_empresa=$resultado4[$i]['NomEmpPerso'];
            $puesto_empresa=$resultado4[$i]['PuestoEmpPerso'];
            $correo_empresa=$resultado4[$i]['CorreoEmpPerso'];
            $telefono_empresa=$resultado4[$i]['TelFEmpPerso'];
            $extTelefono_empresa=$resultado4[$i]['ExtenTelFEmpPerso'];

            $idEmp=$id_certificacion;
            $nombreEmp=$nombre_empresa;
            $puestoEmp=$puesto_empresa;
            $correoEmp=$correo_empresa;
            $telEmp= $telefono_empresa;
            $extTelEmp=$extTelefono_empresa;

            $resultado5=$base->funciones($idEmp);
    if ($resultado5== true) {
        for ($i = 0; $i < count($resultado5); $i++) {
            $id_funcion=$resultado5[$i]['IdFuncion'];
            $nombre_funcion=$resultado5[$i]['NomFuncion'];
            ?>
            <script languaje="javascript">

            llenartabla2();
            function llenartabla2() {
            var tbody2 = document.getElementById("body_tabla2");
            var id="<?php echo $id_funcion ?>"
            if ("<?php echo $llenarlab ?>" == "si"){
            var datos = [
            { funcion: "<?php echo $nombre_funcion ?>" }
            ];


            for (var i = 0; i < datos.length; i++) {
            var fila2 = document.createElement("tr");

            var celdafuncion = document.createElement("td");
            celdafuncion.textContent = datos[i].funcion;
            fila2.appendChild(celdafuncion);

            let icono_eliminar = document.createElement("i");
            icono_eliminar.className = "ti ti-backspace-filled";

            var celdaAcciones = document.createElement("td");
            //eldaAcciones.classList.add("btn-small");

            var botonEliminar = document.createElement("button");
            botonEliminar.className = "btn btn-danger btn btn-small btn-danger";
            botonEliminar.type = "button";
            botonEliminar.style.fontSize = "0.8rem"; // Ajustar el tamaño de fuente
            botonEliminar.style.padding = "6px 10px"; // Ajustar el relleno
            botonEliminar.setAttribute('onclick', 'confirmacion1('+ id +')');
            botonEliminar.appendChild(icono_eliminar);

            celdaAcciones.appendChild(botonEliminar);
            fila2.appendChild(celdaAcciones);

            tbody2.appendChild(fila2);
            }
            }
            }

            function confirmacion1(id){
            if (confirm("¿Está seguro que desea eliminar esta función?")) {
                var idc = id.toString().padStart(6, '0');
                
                
                // Realizar la solicitud Ajax para eliminar el elemento
                $.ajax({
                    //manda a llamar al php que tiene la logica para eliminar
                    url: '../../controller/socio-asociado/Eliminar_Fun_Perfil_Personal.php', 
                    type: 'GET', 
                    data: {idc: idc}, 
                    success: function (response)
                    {
                        // Procesar la respuesta del servidor en caso de éxito
                        
                        alert('Eliminado con éxito');
                        // volver a la pagina de vista
                        location.href = '../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php';
                    },
                });
            } else {
            }
            };
            </script>
            <?php
        }

}
        }
    
        
    } else {
        $llenarlab = "no";
        
    }

    
    
}


?>
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
        document.getElementById("checkboxlaboraloculto").value = "activado";
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