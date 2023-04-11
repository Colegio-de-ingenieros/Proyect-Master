const temarios = [
  {
    id: 1,
    nombre: 'TEMA 1',
    subtemas: [
      'Subtema 1',
      'Subtema 2',
      'Subtema 3',
      'Subtema 4'
    ]
  },
  {
    id: 2,
    nombre: 'TEMA 2',
    subtemas: [
      'Subtema 1',
      'Subtema 2',
      'Subtema 3',
      'Subtema 4'
    ]
  },
  {
    id: 3,
    nombre: 'TEMA 3',
    subtemas: [
      'Subtema 1',
      'Subtema 2',
      'Subtema 3',
      'Subtema 4'
    ]
  },
  {
    id: 4,
    nombre: 'TEMA 4',
    subtemas: []
  },
  {
    id: 5,
    nombre: 'TEMA 5',
    subtemas: [
      'Subtema 1',
      'Subtema 2',
      'Subtema 3',
      'Subtema 4'
    ]
  }
];

const temariosLista = document.getElementById('temarios-lista');

// Iterar sobre los datos y generar el código HTML para cada uno
temarios.forEach(temario => {
  const li = document.createElement('li');
  li.id = `tema-${temario.id}`;
  li.innerHTML = `<strong>${temario.nombre}</strong>`;
  temariosLista.appendChild(li);

  temario.subtemas.forEach((subtema, index) => {
    const div = document.createElement('div');
    div.className = 'subtema';
    
    const input = document.createElement('input');
    input.type = 'text';
    input.value = subtema;
    div.appendChild(input);
    
    const button = document.createElement('button');
    button.innerHTML = 'Eliminar';
    button.onclick = function() {
        // Encontrar el elemento correspondiente en el arreglo de objetos
        const elemento = temario.subtemas.find((s, i) => i === index);
        // Eliminar el elemento del arreglo de objetos
        temario.subtemas.splice(temario.subtemas.indexOf(elemento), 1);
        // Eliminar el elemento de la lista
        div.parentNode.removeChild(div);
    };
    div.appendChild(button);

    // Agregar el elemento a la lista
    li.appendChild(div);
  });
});
