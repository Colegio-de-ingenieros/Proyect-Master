window.onload = function () {
  let url = "../../controller/administrativo/Mostrar_Temario.php";
  let id = document.getElementById("id-usuario").textContent;

  let form = new FormData();
  form.append("id_usuario", id);

  fetch(url, {
    method: "POST",
    body: form
  })
    .then(response => response.json())
    .then(json => respuesta(json))
    .catch(error => alert(error));

  const respuesta = (json) => {
    const temario = document.getElementById("temario")

    list = json.map(obj => Object.values(obj));

    var datos_generales = list[0]
    var data = list[1]

    const nombre = document.getElementById("nombre-curso");
    const clave = document.getElementById("clave-curso");
    const duracion = document.getElementById("duración");
    const objetivo = document.getElementById("objetivo");

    var expresiones = {
      clave: /^[0-9]{6}$/,
      duracion: /^[0-9]{0,3}$/,
      nombres: /^[a-zA-ZÁ-ý0-9\s .,]{1,40}$/,
      objetivosjhg: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
      objetivo: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]+$/,
      tema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
      subtema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    }

    nombre.value = datos_generales[0];
    clave.value = datos_generales[1];
    duracion.value = datos_generales[2];
    objetivo.value = datos_generales[3];

    if (data.length > 0) {
      data.forEach((item, index) => {
        const titleContainer = document.createElement('div');
        titleContainer.classList.add("row")

        const titleInput = document.createElement('input');
        titleInput.type = 'text';
        titleInput.value = item.title;
        titleInput.classList.add("input-format-2")
        //Agrega un máximo de caracteres al 

        // Creamos un evento a titleInput para realizar validaciones
        titleInput.addEventListener('keyup',(e) => {
          let valorInput = e.target.value;
          titleInput.value = valorInput.replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')
          tema = titleInput.value;

          if (!expresiones.tema.test(valorInput)) {
            titleInput.style.border = "3px solid red";
          } else {
            titleInput.removeAttribute("style");
          }
        });

        // Agregamos el evento 'input' al título para actualizar automáticamente el elemento correspondiente en la lista
        titleInput.addEventListener('input', () => {
          item.title = titleInput.value;
        });

        // Creamos el botón para agregar un tema arriba del elemento actual
        const addButtonAbove = document.createElement('button');
        addButtonAbove.textContent = 'Añadir tema arriba';
        addButtonAbove.classList.add("btn")
        addButtonAbove.classList.add("btn-small")
        addButtonAbove.classList.add("btn-add")

        addButtonAbove.addEventListener('click', () => {
          data.splice(index, 0, { title: 'Nuevo tema', subtitles: ['Nuevo subtema'] });
          render_2();
        });

        // Creamos el botón para agregar un tema debajo del elemento actual
        const addButtonBelow = document.createElement('button');
        addButtonBelow.textContent = 'Añadir tema abajo';
        addButtonBelow.classList.add("btn")
        addButtonBelow.classList.add("btn-small")
        addButtonBelow.classList.add("btn-add")

        addButtonBelow.addEventListener('click', () => {
          data.splice(index + 1, 0, { title: 'Nuevo tema', subtitles: ['Nuevo subtema'] });
          render_2();
        });

        const deleteTitleButton = document.createElement('button');
        deleteTitleButton.textContent = 'Eliminar';
        deleteTitleButton.classList.add("btn")
        deleteTitleButton.classList.add("btn-small")
        deleteTitleButton.classList.add("btn-danger")

        deleteTitleButton.addEventListener('click', () => {
          data.splice(index, 1);
          render_2();
        });

        titleContainer.appendChild(titleInput);
        titleContainer.appendChild(addButtonAbove);
        titleContainer.appendChild(addButtonBelow);
        titleContainer.appendChild(deleteTitleButton);

        temario.appendChild(titleContainer);

        const list = document.createElement('ul');

        item.subtitles.forEach((subtitle, index) => {
          const listItem = document.createElement('li');
          listItem.classList.add("row")

          const input = document.createElement('input');
          input.type = 'text';
          input.value = subtitle;
          input.classList.add("input-format-2")
          

          // Agregamos el evento 'input' al subtítulo para actualizar automáticamente el elemento correspondiente en la lista
          input.addEventListener('input', () => {
            item.subtitles[index] = input.value;
          });

          // Creamos el botón para agregar un subtítulo arriba del elemento actual
          const addButtonAbove = document.createElement('button');
          addButtonAbove.textContent = 'Añadir subtema arriba';
          addButtonAbove.classList.add("btn")
          addButtonAbove.classList.add("btn-small")
          addButtonAbove.classList.add("btn-add")

          addButtonAbove.addEventListener('click', () => {
            item.subtitles.splice(index, 0, 'Nuevo subtema');
            render_2();
          });

          // Creamos el botón para agregar un subtítulo debajo del elemento actual
          const addButtonBelow = document.createElement('button');
          addButtonBelow.textContent = 'Añadir subtema abajo';
          addButtonBelow.classList.add("btn")
          addButtonBelow.classList.add("btn-small")
          addButtonBelow.classList.add("btn-add")

          addButtonBelow.addEventListener('click', () => {
            item.subtitles.splice(index + 1, 0, 'Nuevo subtema');
            render_2();
          });

          const deleteButton = document.createElement('button');
          deleteButton.textContent = 'Eliminar';
          deleteButton.classList.add("btn")
          deleteButton.classList.add("btn-small")
          deleteButton.classList.add("btn-danger")

          deleteButton.addEventListener('click', () => {
            item.subtitles.splice(index, 1);
            render_2();
          });

          listItem.appendChild(input);
          listItem.appendChild(addButtonAbove);
          listItem.appendChild(addButtonBelow);
          listItem.appendChild(deleteButton);

          list.appendChild(listItem);
        });

        const render = () => {
          // Limpiamos la lista de subtítulos
          while (list.firstChild) {
            list.removeChild(list.firstChild);
          }

          // Agregamos cada subtítulo a la lista
          item.subtitles.forEach((subtitle, index) => {
            const listItem = document.createElement('li');
            listItem.classList.add("row")

            const input = document.createElement('input');
            input.type = 'text';
            input.value = subtitle;
            input.classList.add("input-format-2")

            // Agregamos el evento 'input' al subtítulo para actualizar automáticamente el elemento correspondiente en la lista
            input.addEventListener('input', () => {
              item.subtitles[index] = input.value;
            });

            // Creamos el botón para agregar un subtítulo arriba del elemento actual
            const addButtonAbove = document.createElement('button');
            addButtonAbove.textContent = 'Añadir subtema arriba';
            addButtonAbove.classList.add("btn")
            addButtonAbove.classList.add("btn-small")
            addButtonAbove.classList.add("btn-add")

            addButtonAbove.addEventListener('click', () => {
              item.subtitles.splice(index, 0, '');
              render();
            });

            // Creamos el botón para agregar un subtítulo debajo del elemento actual
            const addButtonBelow = document.createElement('button');
            addButtonBelow.textContent = 'Añadir subtema abajo';
            addButtonBelow.classList.add("btn")
            addButtonBelow.classList.add("btn-small")
            addButtonBelow.classList.add("btn-add")

            addButtonBelow.addEventListener('click', () => {
              item.subtitles.splice(index + 1, 0, '');
              render();
            });

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Eliminar';
            deleteButton.classList.add("btn")
            deleteButton.classList.add("btn-small")
            deleteButton.classList.add("btn-danger")

            deleteButton.addEventListener('click', () => {
              item.subtitles.splice(index, 1);
              render();
            });


            listItem.appendChild(input);
            listItem.appendChild(addButtonAbove);
            listItem.appendChild(addButtonBelow);
            listItem.appendChild(deleteButton);

            list.appendChild(listItem); 
          });
        }
        
        const render_2 = () => {
          temario.innerHTML = '';

          data.forEach((item, index) => {
            const titleContainer = document.createElement('div');
            titleContainer.classList.add("row")
      
            const titleInput = document.createElement('input');
            titleInput.type = 'text';
            titleInput.value = item.title;
            titleInput.classList.add("input-format-2")
      
            // Agregamos el evento 'input' al título para actualizar automáticamente el elemento correspondiente en la lista
            titleInput.addEventListener('input', () => {
              item.title = titleInput.value;
            });
      
            // Creamos el botón para agregar un tema arriba del elemento actual
            const addButtonAbove = document.createElement('button');
            addButtonAbove.textContent = 'Añadir tema arriba';
            addButtonAbove.classList.add("btn")
            addButtonAbove.classList.add("btn-small")
            addButtonAbove.classList.add("btn-add")
      
            addButtonAbove.addEventListener('click', () => {
              data.splice(index, 0, { title: 'Nuevo tema', subtitles: ['Nuevo Subtema'] });
              render_2();
            });
      
            // Creamos el botón para agregar un tema debajo del elemento actual
            const addButtonBelow = document.createElement('button');
            addButtonBelow.textContent = 'Añadir tema abajo';
            addButtonBelow.classList.add("btn")
            addButtonBelow.classList.add("btn-small")
            addButtonBelow.classList.add("btn-add")
      
            addButtonBelow.addEventListener('click', () => {
              data.splice(index + 1, 0, { title: 'Nuevo tema', subtitles: ['Nuevo Subtema'] });
              render_2();
            });
      
            const deleteTitleButton = document.createElement('button');
            deleteTitleButton.textContent = 'Eliminar';
            deleteTitleButton.classList.add("btn")
            deleteTitleButton.classList.add("btn-small")
            deleteTitleButton.classList.add("btn-danger")
      
            deleteTitleButton.addEventListener('click', () => {
              data.splice(index, 1);
              render_2();
            });
      
            titleContainer.appendChild(titleInput);
            titleContainer.appendChild(addButtonAbove);
            titleContainer.appendChild(addButtonBelow);
            titleContainer.appendChild(deleteTitleButton);
      
            temario.appendChild(titleContainer);
      
            const list = document.createElement('ul');
      
            item.subtitles.forEach((subtitle, index) => {
              const listItem = document.createElement('li');
              listItem.classList.add("row")
      
              const input = document.createElement('input');
              input.type = 'text';
              input.value = subtitle;
              input.classList.add("input-format-2")
      
              // Agregamos el evento 'input' al subtítulo para actualizar automáticamente el elemento correspondiente en la lista
              input.addEventListener('input', () => {
                item.subtitles[index] = input.value;
              });
      
              // Creamos el botón para agregar un subtítulo arriba del elemento actual
              const addButtonAbove = document.createElement('button');
              addButtonAbove.textContent = 'Añadir subtema arriba';
              addButtonAbove.classList.add("btn")
              addButtonAbove.classList.add("btn-small")
              addButtonAbove.classList.add("btn-add")
      
              addButtonAbove.addEventListener('click', () => {
                item.subtitles.splice(index, 0, 'Nuevo Subtema');
                render_2();
              });
      
              // Creamos el botón para agregar un subtítulo debajo del elemento actual
              const addButtonBelow = document.createElement('button');
              addButtonBelow.textContent = 'Añadir subtema abajo';
              addButtonBelow.classList.add("btn")
              addButtonBelow.classList.add("btn-small")
              addButtonBelow.classList.add("btn-add")
      
              addButtonBelow.addEventListener('click', () => {
                item.subtitles.splice(index + 1, 0, 'Nuevo Subtema');
                render_2();
              });
      
              const deleteButton = document.createElement('button');
              deleteButton.textContent = 'Eliminar';
              deleteButton.classList.add("btn")
              deleteButton.classList.add("btn-small")
              deleteButton.classList.add("btn-danger")
      
              deleteButton.addEventListener('click', () => {
                item.subtitles.splice(index, 1);
                render_2();
              });
      
      
              listItem.appendChild(input);
              listItem.appendChild(addButtonAbove);
              listItem.appendChild(addButtonBelow);
              listItem.appendChild(deleteButton);
      
              list.appendChild(listItem);
            });

            const separator = document.createElement('hr');
            separator.classList.add("separator")
            list.appendChild(separator);
      
            temario.appendChild(list);
      
          });
        }


        const separator = document.createElement('hr');
        separator.classList.add("separator")
        list.appendChild(separator);

        temario.appendChild(list);

      });

      var nom = true;
var dura = true;
var objetiv = true;



var expresiones = {
  clave: /^[0-9]{6}$/,
  duracion: /^[0-9]{0,3}$/,
  nombres: /^[a-zA-ZÁ-ý0-9\s .,]{1,40}$/,
  objetivosjhg: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
  objetivo: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]+$/,
  tema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
  subtema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
}


let nombrecurso = document.getElementById("nombre-curso");
nombrecurso.addEventListener('keyup', (e) => {
  let valorInput = e.target.value;


  nombrecurso.value = valorInput
      // Eliminar caracteres especiales
      //.replace(/[üâäàåçê♪ëèïîìÄÅæ·°¨´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-°¨]/g, '')
      .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


  if (!expresiones.nombres.test(valorInput)) {
      nombrecurso.style.border = "3px solid red";
      nom = false
  } else {
      nombrecurso.removeAttribute("style");
      nom = true
  }
  /* validar(bNom); */
})


let objetivo = document.getElementById("objetivo");
objetivo.addEventListener('keyup', (e) => {
  let valorInput = e.target.value;

  objetivo.value = valorInput

      // Eliminar caracteres especiales
      .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


  if (!expresiones.objetivo.test(valorInput)) {
      objetivo.style.border = "3px solid red";
      objetiv = false
  } else {
      objetivo.removeAttribute("style");
      objetiv = true
  }
  /* validar(Obj); */
})

let duracion = document.getElementById("duración");
duracion.addEventListener('keyup', (e) => {
  let valorInput = e.target.value;

  duracion.value = valorInput
      // Eliminar espacios en blanco
      .replace(/\s/g, '')
      // Eliminar caracteres especiales
      .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·°¨´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '')
      // Eliminar el ultimo espaciado
      .replace(/[a-zA-ZáéíóúÁÉÍÓÚñÑ.,]/g, '')
      .trim();


  if (!expresiones.duracion.test(valorInput)) {
      duracion.style.border = "3px solid red";
      dura = false
  } else {
      duracion.removeAttribute("style");
      dura = true
  }
  /* validar(dur); */
})

      const actualizar_curso = document.getElementById("update-form");
      
      actualizar_curso.addEventListener('click', () => {
        if (nom == false) {
          nombrecurso.style.border = "3px solid red";
      }
      if (dura == false) {
          duracion.style.border = "3px solid red";
      }
      if (objetiv == false) {
          objetivo.style.border = "3px solid red";
      }
      if (dura === true && nom == true && objetiv == true){
        datos_generales = [nombre.value, clave.value, duracion.value, objetivo.value]

        lista_temario = convertirData(data);
        console.log(lista_temario);
        alert("Modificado con éxito");
      }
      else{
        alert("Asegurese que todos los campos sean correctos");
      }
        
      });

      const convertirData = (data) => {
        return data.map(item => [item.title, ...item.subtitles]);
      }
    }
    else {
      //document.getElementById("mensaje").textContent = "No se encontraron datos.";
      var mensaje = "No hay temario disponible.";
      document.getElementById("mensaje").innerHTML = "<b style='text-align:center'>" + mensaje + "</b>";
    }
  }
}



