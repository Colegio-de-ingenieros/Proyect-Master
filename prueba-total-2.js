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

const container = document.createElement('div');

data.forEach((item, index) => {
  const titleContainer = document.createElement('div');

  const titleInput = document.createElement('input');
  titleInput.type = 'text';
  titleInput.value = item.title;

  const updateTitleButton = document.createElement('button');
  updateTitleButton.textContent = 'Actualizar';

  updateTitleButton.addEventListener('click', () => {
    item.title = titleInput.value;
  });

  const deleteTitleButton = document.createElement('button');
  deleteTitleButton.textContent = 'Eliminar';

  deleteTitleButton.addEventListener('click', () => {
    data.splice(index, 1);
    titleContainer.remove();
    list.remove();
  });

  titleContainer.appendChild(titleInput);
  titleContainer.appendChild(updateTitleButton);
  titleContainer.appendChild(deleteTitleButton);

  container.appendChild(titleContainer);

  const list = document.createElement('ul');

  item.subtitles.forEach((subtitle, index) => {
    const listItem = document.createElement('li');

    const input = document.createElement('input');
    input.type = 'text';
    input.value = subtitle;

    const updateButton = document.createElement('button');
    updateButton.textContent = 'Actualizar';

    updateButton.addEventListener('click', () => {
      item.subtitles[index] = input.value;
    });

    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Eliminar';

    deleteButton.addEventListener('click', () => {
      item.subtitles.splice(index, 1);
      listItem.remove();
    });

    listItem.appendChild(input);
    listItem.appendChild(updateButton);
    listItem.appendChild(deleteButton);

    list.appendChild(listItem);
  });

  container.appendChild(list);
});

document.body.appendChild(container);