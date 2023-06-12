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
  const date = new Date();

  if (headhunter == 0 && outplacement == 0) {
    alert('Debes seleccionar al menos un servicio');
  }
  else if (headhunter == 1 && outplacement == 1) {
    let dd = date.getDate();
    let mm = date.getMonth() + 1;
    let yyyy = date.getFullYear();

    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    let fecha = yyyy + '-' + mm + '-' + dd;

    let url = "../../controller/socio-asociado/Registro_Servicios.php";
    let form = new FormData();
    form.append("headhunter", headhunter);
    form.append("outplacement", outplacement);
    form.append("fecha", fecha);

    fetch(url, {
      method: 'POST',
      body: form
    }).then(res => res.json())
      .catch(error => console.error('Error:', error))
      .then(response => {
        alert("Servicios registrados correctamente")
        check_headhunter.checked = false;
        check_outplacement.checked = false;
      });
  }
  else if (headhunter == 1 || outplacement == 1) {
    let dd = date.getDate();
    let mm = date.getMonth() + 1;
    let yyyy = date.getFullYear();

    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    let fecha = yyyy + '-' + mm + '-' + dd;

    let url = "../../controller/socio-asociado/Registro_Servicios.php";

    let form = new FormData();
    form.append("headhunter", headhunter);
    form.append("outplacement", outplacement);
    form.append("fecha", fecha);

    fetch(url, {
      method: 'POST',
      body: form
    }).then(res => res.json())
      .catch(error => console.error('Error:', error))
      .then(response => {
        alert("Servicio registrado correctamente");
        check_headhunter.checked = false;
        check_outplacement.checked = false;
      });
  }

});
