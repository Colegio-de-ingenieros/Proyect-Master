/* window.onload = function () {
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
    
    datos_generales = list[0]
    data = list[1]

    const nombre = document.getElementById("nombre-curso");
    const clave = document.getElementById("clave-curso");
    const duracion = document.getElementById("duración");
    const objetivo = document.getElementById("objetivo");

    nombre.value = datos_generales[0];
    clave.value = datos_generales[1];
    duracion.value = datos_generales[2];
    objetivo.value = datos_generales[3];

    data.forEach((item, index) => {
      const titleContainer = document.createElement('div');
      titleContainer.classList.add("row")

      const titleInput = document.createElement('input');
      titleInput.type = 'text';
      titleInput.value = item.title;
      titleInput.classList.add("input-format-2")


      const updateTitleButton = document.createElement('button');
      updateTitleButton.textContent = 'Actualizar';
      updateTitleButton.classList.add("btn")
      updateTitleButton.classList.add("btn-small")

      updateTitleButton.addEventListener('click', () => {
        item.title = titleInput.value;
      });

      const deleteTitleButton = document.createElement('button');
      deleteTitleButton.textContent = 'Eliminar';
      deleteTitleButton.classList.add("btn")
      deleteTitleButton.classList.add("btn-small")
      deleteTitleButton.classList.add("btn-danger")


      deleteTitleButton.addEventListener('click', () => {
        data.splice(index, 1);
        titleContainer.remove();
        list.remove();
      });

      titleContainer.appendChild(titleInput);
      titleContainer.appendChild(updateTitleButton);
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

        const updateButton = document.createElement('button');
        updateButton.textContent = 'Actualizar';
        updateButton.classList.add("btn")
        updateButton.classList.add("btn-small")

        updateButton.addEventListener('click', () => {
          item.subtitles[index] = input.value;
        });

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Eliminar';
        deleteButton.classList.add("btn")
        deleteButton.classList.add("btn-small")
        deleteButton.classList.add("btn-danger")

        deleteButton.addEventListener('click', () => {
          item.subtitles.splice(index, 1);
          listItem.remove();
        });

        listItem.appendChild(input);
        listItem.appendChild(updateButton);
        listItem.appendChild(deleteButton);

        list.appendChild(listItem);
      });

      const separator = document.createElement('hr');
      separator.classList.add("separator")
      list.appendChild(separator);

      temario.appendChild(list);
    });
  }
} */

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

    // Agregamos el evento 'input' al título para actualizar automáticamente el elemento correspondiente en la lista
    titleInput.addEventListener('input', () => {
      item.title = titleInput.value;
    });

    const deleteTitleButton = document.createElement('button');
    deleteTitleButton.textContent = 'Eliminar';
    deleteTitleButton.classList.add("btn")
    deleteTitleButton.classList.add("btn-small")
    deleteTitleButton.classList.add("btn-danger")

    deleteTitleButton.addEventListener('click', () => {
      data.splice(index, 1);
      titleContainer.remove();
      list.remove();
    });

    titleContainer.appendChild(titleInput);
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

      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Eliminar';
      deleteButton.classList.add("btn")
      deleteButton.classList.add("btn-small")
      deleteButton.classList.add("btn-danger")

      deleteButton.addEventListener('click', () => {
        item.subtitles.splice(index, 1);
        listItem.remove();
      });

      listItem.appendChild(input);
      listItem.appendChild(deleteButton);

      list.appendChild(listItem);
    });

    const separator = document.createElement('hr');
    separator.classList.add("separator")
    list.appendChild(separator);

    temario.appendChild(list);
  });

  const actualizar_curso = document.getElementById("update-form");
  actualizar_curso.addEventListener('click', () => {
    datos_generales = [nombre.value, clave.value, duracion.value, objetivo.value]

    lista_temario = convertirData(data);
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