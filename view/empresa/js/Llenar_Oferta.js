
        const Jornada = document.getElementById("jornada_laboral");
        fetch("../../controller/empresa/LlenarSelect.php")
          .then(response => response.json())
          .then(data => {
            // Itera sobre los datos recibidos y crea las opciones del select
            data.forEach(item => {
              const option = document.createElement("option");
              option.value = item.IdJor; // Asigna el valor deseado a la opción
              option.text = item.TipoJor; // Asigna el texto deseado a la opción
              Jornada.appendChild(option); // Agrega la opción al select
            });
          })
          .catch(error => {
            console.log("Error al obtener los datos:", error);
          });

          