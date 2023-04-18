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
}

const respuesta = (json) => {
  const temario = document.getElementById("temario")

  list = json.map(obj => Object.values(obj));

  var datos_generales = list[0]
  var data = list[1]

  const nombre = document.getElementById("nombre-curso");
  const clave = document.getElementById("clave-curso");
  const duracion = document.getElementById("duración");
  const objetivo = document.getElementById("objetivo");

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

      titleInput.id = "title-" + index;

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
        // Agrega el id para validad los campos
        input.id = "subtitle-" + index;

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

    const actualizar_curso = document.getElementById("update-form");
    actualizar_curso.addEventListener('click', () => {
      datos_generales = [nombre.value, clave.value, duracion.value, objetivo.value]

      lista_temario = convertirData(data);
      console.log(lista_temario);
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