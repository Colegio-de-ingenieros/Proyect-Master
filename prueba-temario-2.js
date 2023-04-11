const data = [
  {
    id: 'title-1',
    title: 'Titulo 1',
    subtitles: ['Subtitulo 1', 'Subtitulo 2', 'Subtitulo 3', 'Subtitulo 4', 'Subtitulo 5']
  },
  {
    id: 'title-2',
    title: 'Titulo 2',
    subtitles: ['Subtitulo 1', 'Subtitulo 2', 'Subtitulo 3']
  },
  {
    id: 'title-3',
    title: 'Titulo 3',
    subtitles: []
  },
  {
    id: 'title-4',
    title: 'Titulo 4',
    subtitles: ['Subtitulo 1', 'Subtitulo 2']
  }
];

const list = document.createElement('ul');
list.id = 'mi-lista';

data.forEach((item, index) => {
  const listItem = document.createElement('li');
  
  const input = document.createElement('input');
  input.type = 'text';
  input.value = item.title;
  
  const updateButton = document.createElement('button');
  updateButton.textContent = 'Actualizar';
  
  updateButton.addEventListener('click', () => {
    data[index].title = input.value;
  });
  
  const deleteButton = document.createElement('button');
  deleteButton.textContent = 'Eliminar';
  
  deleteButton.addEventListener('click', () => {
    // Código para eliminar el elemento
  });
  
  listItem.appendChild(input);
  listItem.appendChild(updateButton);
  listItem.appendChild(deleteButton);
  
  list.appendChild(listItem);
});

document.body.appendChild(list);