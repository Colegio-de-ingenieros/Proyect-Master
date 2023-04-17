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
    .then(data => arrays(data))
    .catch(error => alert(error));

  const arrays = (data) => {
    const temario = document.getElementById("temario")


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
}