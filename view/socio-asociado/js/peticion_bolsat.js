fetch("../../controller/socio-asociado/Bolsa_Trabajo2.php")
   .then(response => response.json())
   .then(respuesta => {
      console.log(respuesta); 
      localStorage.setItem('miVariable', respuesta[0]['IdPerso']);
      let nombre = respuesta[0]['NomPerso'];
      let apellido_paterno = respuesta[0]['ApePPerso'];
      let apellido_materno = respuesta[0]['ApeMPerso'];
      let fecha_nacimiento = respuesta[0]['FechaNacPerso'];
      let telefono = respuesta[0]['TelMPerso'];
      let calle = respuesta[0]['CallePerso'];
      let correo = respuesta[0]['CorreoPerso'];
      let colonia = respuesta[1]['nomcolonia'];
      let municipio = respuesta[1]['nommunicipio'];
      let estado = respuesta[1]['nomestado'];

      document.getElementById("nombre-campo").value = nombre;
      document.getElementById("apellido-paterno-campo").value = apellido_paterno;
      document.getElementById("apellido-materno-campo").value = apellido_materno;
      document.getElementById("fecha-nacimiento-campo").value = fecha_nacimiento;
      document.getElementById("correo-campo").value = correo;
      document.getElementById("telefono-campo").value = telefono;
      document.getElementById("calle-campo").value = calle;
      document.getElementById("colonia-campo").value = colonia;
      document.getElementById("ciudad-campo").value = municipio;
      document.getElementById("estado-campo").value = estado;

      console.log(respuesta.length);

      // Obtener el elemento del DOM al que se añadirá la nueva caja de texto
      const contenedor = document.getElementById('formulario-certificaciones');

      for (let i = 2; i < respuesta.length; i++) {
         console.log (i);
         if (respuesta[i] == "no hay certificaciones"){
            contenedor.textContent = 'No se encontraron certificaciones';
         }
         else if (respuesta[i] == "certificaciones"){
            for (let j = i+1; j < respuesta.length; j++) {
               console.log(i);
               if (respuesta[j] == "bolsa" || respuesta[j] == "academica" || respuesta[j] == "profesional"){
                  i = j-1;
                  break;
               }
               // Crear una nueva caja de texto
               const nuevaCajaTexto = document.createElement('input');
      
               // Establecer los atributos de la nueva caja de texto
               nuevaCajaTexto.type = 'text';
               nuevaCajaTexto.name = 'nuevo-input';
               nuevaCajaTexto.classList = 'input-format-2';
               let certificacion = respuesta[j]['NomCerExt'];
               nuevaCajaTexto.value = certificacion;
               nuevaCajaTexto.readOnly = true;
      
               // Añadir la nueva caja de texto al contenedor
               contenedor.appendChild(nuevaCajaTexto);
      
               const CajaTexto = document.createElement('input');
      
               // Establecer los atributos de la nueva caja de texto
               CajaTexto.type = 'text';
               CajaTexto.name = 'nuevo-input';
               CajaTexto.classList = 'input-format-2';
               let empresa = respuesta[j]['OrgCerExt'];
               CajaTexto.value = empresa;
               CajaTexto.readOnly = true;
      
               // Añadir la nueva caja de texto al contenedor
               contenedor.appendChild(CajaTexto);
            }
         }
         else if (respuesta[i] == "bolsa"){

               combo = respuesta[i+1]['ResidenciaCv'];
               combo = combo++;
               
               document.getElementById("salario").value = respuesta[i+1]['ExpSalCv'];
               document.getElementById("objetivo").value =respuesta[i+1]['DesProCv'];
   
               if (combo === 1) {
                  document.getElementById("residencia-campo").value = "1";
                } else if (combo === 2) {
                  document.getElementById("residencia-campo").value = "2";
                } 
   
         }
         else if (respuesta[i] == "academica"){
            let posicion = i+1;
            for (let j = i+1; j < respuesta.length; j++) {
               console.log(i);
               if (respuesta[j] == "bolsa" || respuesta[j] == "academica" || respuesta[j] == "profesional"){
                  i = j-1;
                  break;
               }
               else if (j == posicion){
                  document.getElementById("carrera-1").value = respuesta[j]['Carrera'];
                  document.getElementById("cedula-1").value = respuesta[j]['NumCedAca'];
               }
               else if (j == posicion+1){
                  document.getElementById("carrera-2").value =  respuesta[j]['Carrera'];
                  document.getElementById("cedula-2").value = respuesta[j]['NumCedAca'];
               }
               else if (j == posicion+2){
                  document.getElementById("carrera-3").value =  respuesta[j]['Carrera'];
                  document.getElementById("cedula-3").value = respuesta[j]['NumCedAca'];
               }
               
            }
         }
         else if (respuesta[i] == "profesional"){
            let posicion = i+1;
            for (let j = i+1; j < respuesta.length; j++) {
               console.log(i);
               if (respuesta[j] == "bolsa" || respuesta[j] == "academica" || respuesta[j] == "profesional"){
                  i = j-1;
                  break;
               }
               else if (j == posicion){
                  document.getElementById("puesto-antiguo-1").value = respuesta[j]['PuestoExpP'];
                  document.getElementById("empresa-antigua-1").value = respuesta[j]['EmpExpP'];
                  document.getElementById("periodo-inicio-antigua-1").value = respuesta[j]['IniExpP'];
                  document.getElementById("periodo-fin-antigua-1").value = respuesta[j]['FinExpP'];
                  document.getElementById("actividad-antigua-1").value = respuesta[j]['ActExpP'];
               }
               else if (j == posicion+1){
                  document.getElementById("puesto-antiguo-2").value = respuesta[j]['PuestoExpP'];
                  document.getElementById("empresa-antigua-2").value = respuesta[j]['EmpExpP'];
                  document.getElementById("periodo-inicio-antigua-2").value = respuesta[j]['IniExpP'];
                  document.getElementById("periodo-fin-antigua-2").value = respuesta[j]['FinExpP'];
                  document.getElementById("actividad-antigua-2").value = respuesta[j]['ActExpP'];
               }
               
               
            }
         }
      }
   });

      // Obtener el elemento del DOM al que se añadirá la nueva caja de texto
/*       const contenedor = document.getElementById('formulario-certificaciones');

      if (respuesta.length > 2 && respuesta[2] != "bolsa"){
         for (let i = 2; i < respuesta.length; i++) {
         // Crear una nueva caja de texto
         const nuevaCajaTexto = document.createElement('input');

         // Establecer los atributos de la nueva caja de texto
         nuevaCajaTexto.type = 'text';
         nuevaCajaTexto.name = 'nuevo-input';
         nuevaCajaTexto.classList = 'input-format-2';
         let certificacion = respuesta[i]['NomCerExt'];
         nuevaCajaTexto.value = certificacion;
         nuevaCajaTexto.readOnly = true;

         // Añadir la nueva caja de texto al contenedor
         contenedor.appendChild(nuevaCajaTexto);

         const CajaTexto = document.createElement('input');

         // Establecer los atributos de la nueva caja de texto
         CajaTexto.type = 'text';
         CajaTexto.name = 'nuevo-input';
         CajaTexto.classList = 'input-format-2';
         let empresa = respuesta[i]['OrgCerExt'];
         CajaTexto.value = empresa;
         CajaTexto.readOnly = true;

         // Añadir la nueva caja de texto al contenedor
         contenedor.appendChild(CajaTexto);
      }
   }
   else{
      contenedor.textContent = 'No se encontraron certificaciones';
   }
   }); */

/* function mostrar(){
   
   
         document.getElementById("puesto-antiguo-1").value = estado;
         document.getElementById("empresa-antigua-1").value = estado;
         document.getElementById("periodo-inicio-antigua-1").value = "2023-12-02";
         document.getElementById("periodo-fin-antigua-1").value = "2023-12-02";
         document.getElementById("actividad-antigua-1").value = estado;
   
         document.getElementById("puesto-antiguo-2").value = estado;
         document.getElementById("empresa-antigua-2").value = estado;
         document.getElementById("periodo-inicio-antigua-2").value = "2023-12-02";
         document.getElementById("periodo-fin-antigua-2").value = "2023-12-02";
         document.getElementById("actividad-antigua-2").value = estado;
} */