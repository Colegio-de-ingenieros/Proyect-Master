const Modalidad = document.getElementById("forma_trabajo");
        fetch("../../controller/empresa/LlenarSelect_Modalidad.php")
          .then(response => response.json())
          .then(data => {
            // Itera sobre los datos recibidos y crea las opciones del select
            data.forEach(item => {
              const option = document.createElement("option");
              option.value = item.IdMod; // Asigna el valor deseado a la opción
              option.text = item.TipoMod; // Asigna el texto deseado a la opción
              Modalidad.appendChild(option); // Agrega la opción al select
            });
          })
          .catch(error => {
            console.log("Error al obtener los datos:", error);
          });