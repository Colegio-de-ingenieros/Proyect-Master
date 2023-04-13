const data = [
  {
    id: 'title-1',
    title: 'TEMA 1',
    subtitles: ['Subtema 1', 'Subtema 2', 'Subtema 3', 'Subtema 4']
  },
  {
    id: 'title-2',
    title: 'TEMA 2',
    subtitles: ['Subtema 1', 'Subtema 2', 'Subtema 3', 'Subtema 4']
  },
  {
    id: 'title-3',
    title: 'TEMA 3',
    subtitles: ['Subtema 1', 'Subtema 2', 'Subtema 3', 'Subtema 4']
  },
  {
    id: 'title-4',
    title: 'TEMA 4',
    subtitles: []
  },
  {
    id: 'title-5',
    title: 'TEMA 5',
    subtitles: ['Subtema 1', 'Subtema 2', 'Subtema 3', 'Subtema 4']
  }
];
const temario = document.getElementById("temario")
/* const container = document.createElement('div'); */

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
  /* Agrega un separador */
  const separator = document.createElement('hr');
  separator.classList.add("separator")
  list.appendChild(separator);
  
  temario.appendChild(list);
});

/* document.body.appendChild(container); */