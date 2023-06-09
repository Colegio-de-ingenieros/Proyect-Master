const check_headhunter = document.getElementById('headhunter');
let headhunter = 0;

const check_outplacement = document.getElementById('outplacement');
let outplacement = 0;

const btn_registrar = document.getElementById('btn-aplicar');

check_headhunter.addEventListener('change', (event) => {
  if (event.target.checked) {
    headhunter = 1;
    console.log(headhunter);
  } else {
    headhunter = 0;
    console.log(headhunter);
  }
});

check_outplacement.addEventListener('change', (event) => {
  if (event.target.checked) {
    outplacement = 1;
    console.log(outplacement);
  } else {
    outplacement = 0;
    console.log(outplacement);
  }
});

btn_registrar.addEventListener('click', () => {
  /* Obten la zona horaria y la fecha del día */
  const date = new Date();

  if (headhunter == 0 && outplacement == 0) {
    alert('Debes seleccionar al menos un servicio');
  }else if(headhunter == 1 || outplacement == 1) {
    
    let url = "";
    
    let form = new FormData();
    form.append("headhunter", headhunter);
    form.append("outplacement", outplacement);
    form.append("fecha", date);

    fetch(url, {
      method: 'POST',
      body: form
    }).then(res => res.json())
      .catch(error => console.error('Error:', error))
      .then(response => resultados(response));
    
    function resultados(response) {
      alert('Servicio registrado exitosamente')
    }
  }
  else if(headhunter == 1 && outplacement == 1) {
    alert('Servicios registrados exitosamente');
  }
});