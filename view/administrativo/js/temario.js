window.onload = function () {
  let url = "../../controller/administrativo/Mostrar_Temario.php";
  var id = document.getElementById("id-usuario").textContent;

  let form = new FormData();
  form.append("id_usuario", id);

  fetch(url, {
    method: "POST",
    body: form
  }).then(response => response.json())
    .then(json => respuesta(json))
    .catch(error => alert(error));

  const respuesta = (json) => {
    /* Validación de los campos generales */
    list = json.map(obj => Object.values(obj));

    var datos_generales = list[0];
    var data = list[1];

    const nombre = document.getElementById("nombre-curso");
    const clave = document.getElementById("clave-curso");
    const duracion = document.getElementById("duración");
    const objetivo = document.getElementById("objetivo");

    nombre.value = datos_generales[0];
    clave.value = datos_generales[1];
    duracion.value = datos_generales[2];
    objetivo.value = datos_generales[3];

    var expresiones = {
      clave: /^[0-9]{6}$/,
      duracion: /^[0-9]{0,3}$/,
      nombres: /^[a-zA-ZÁ-ý0-9\s .,]{1,40}$/,
      objetivosjhg: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
      objetivo: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]+$/,
      tema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
      subtema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    }

    nombre.addEventListener('keyup', (e) => {
      let valorInput = e.target.value;

      nombre.value = valorInput
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

      if (!expresiones.nombres.test(valorInput)) {
        nombre.style.border = "3px solid red";
        nom = false
      } else {
        nombre.removeAttribute("style");
        nom = true
      }
    });

    objetivo.addEventListener('keyup', (e) => {
      let valorInput = e.target.value;

      objetivo.value = valorInput
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


      if (!expresiones.objetivo.test(valorInput)) {
        objetivo.style.border = "3px solid red";
        objetiv = false
      } else {
        objetivo.removeAttribute("style");
        objetiv = true
      }
    });

    duracion.addEventListener('keyup', (e) => {
      let valorInput = e.target.value;
      duracion.value = valorInput.replace(/\s/g, '').replace(/[üâäàåçê♪ëèïîìÄÅÉæ·°¨´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '').replace(/[a-zA-ZáéíóúÁÉÍÓÚñÑ.,]/g, '').trim();

      if (!expresiones.duracion.test(valorInput)) {
        duracion.style.border = "3px solid red";
        dura = false
      } else {
        duracion.removeAttribute("style");
        dura = true
      }
    });

    /* Generación del temario  */
    if (data.length > 0) {
      generarTemario();
    }
    else {
      sin_temario();
    }

    function sin_temario() {
      temario.innerHTML = '';
      const newLabel = document.createElement('label');
      newLabel.classList.add("label-2")
      newLabel.textContent = "No hay temas registrados";

      const addButtonEmpty = document.createElement('button');
      addButtonEmpty.classList.add("btn", "btn-small", "btn-add")
      addButtonEmpty.textContent = "Agregar tema";
      addButtonEmpty.style.display = "block";

      addButtonEmpty.addEventListener('click', () => {
        data.push({ title: '', subtitles: [''] });
        generarTemario();
      });

      temario.appendChild(newLabel);
      temario.appendChild(addButtonEmpty);
    }

    function generarTemario() {
      temario.innerHTML = '';
      data.forEach((item, index) => {
        const titleContainer = document.createElement('div');
        titleContainer.classList.add("row")

        const titleInput = document.createElement('input');
        titleInput.type = 'text';
        titleInput.value = item.title;
        titleInput.classList.add("input-format-2")
        titleInput.placeholder = "Nuevo tema"
        titleInput.maxLength = 40;

        titleInput.addEventListener('keyup', (e) => {
          let valorInput = e.target.value;
          titleInput.value = valorInput.replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')
          tema = titleInput.value;

          if (!expresiones.tema.test(valorInput)) {
            titleInput.style.border = "3px solid red";
          } else {
            titleInput.removeAttribute("style");
          }
        });

        titleInput.addEventListener('input', () => {
          item.title = titleInput.value;
        });

        const addButtonAbove = document.createElement('button');
        addButtonAbove.classList.add("btn", "btn-small", "btn-add")

        const icon = document.createElement('i');
        icon.classList.add("ti", "ti-arrow-big-up-line-filled");
        addButtonAbove.appendChild(icon);

        addButtonAbove.addEventListener('click', () => {
          data.splice(index, 0, { title: '', subtitles: [''] });
          render_2();
        });

        const addButtonBelow = document.createElement('button');
        addButtonBelow.classList.add("btn", "btn-small", "btn-add")

        const icon2 = document.createElement('i');
        icon2.classList.add("ti", "ti-arrow-big-down-line-filled");
        addButtonBelow.appendChild(icon2);

        addButtonBelow.addEventListener('click', () => {
          data.splice(index + 1, 0, { title: '', subtitles: [''] });
          render_2();
        });

        const deleteTitleButton = document.createElement('button');
        deleteTitleButton.classList.add("btn", "btn-small", "btn-danger")

        const icon3 = document.createElement('i');
        icon3.classList.add("ti", "ti-backspace-filled");
        deleteTitleButton.appendChild(icon3);

        deleteTitleButton.addEventListener('click', () => {
          data.splice(index, 1);
          let longitud = data.length;

          if (longitud == 0) {
            sin_temario();
          }
          else{
            render_2();
          }
        });

        const linkSubtemas = document.createElement('Button');
        linkSubtemas.classList.add("btn", "btn-small", "btn-link")
        linkSubtemas.textContent = "Subtemas";

        linkSubtemas.addEventListener('click', () => {
          alert("Se abrirá una nueva ventana");
          window.location.href = "../../../../CISCIG/view/administrativo/Modi_Subtemas.php?index=" + index + "&id=" + id;
        });

        titleContainer.appendChild(titleInput);
        titleContainer.appendChild(addButtonAbove);
        titleContainer.appendChild(addButtonBelow);
        titleContainer.appendChild(deleteTitleButton);
        titleContainer.appendChild(linkSubtemas);

        temario.appendChild(titleContainer);

        const list = document.createElement('ul');

        const render_2 = () => {
          temario.innerHTML = '';

          data.forEach((item, index) => {
            const titleContainer = document.createElement('div');
            titleContainer.classList.add("row")

            const titleInput = document.createElement('input');
            titleInput.type = 'text';
            titleInput.value = item.title;
            titleInput.classList.add("input-format-2")
            titleInput.placeholder = "Nuevo tema"
            titleInput.maxLength = 40;

            titleInput.addEventListener('keyup', (e) => {
              let valorInput = e.target.value;
              titleInput.value = valorInput.replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')
              tema = titleInput.value;

              if (!expresiones.tema.test(valorInput)) {
                titleInput.style.border = "3px solid red";
              } else {
                titleInput.removeAttribute("style");
              }
            });

            titleInput.addEventListener('input', () => {
              item.title = titleInput.value;
            });

            const addButtonAbove = document.createElement('button');
            addButtonAbove.classList.add("btn", "btn-small", "btn-add")

            const icon = document.createElement('i');
            icon.classList.add("ti", "ti-arrow-big-up-line-filled");
            addButtonAbove.appendChild(icon);

            addButtonAbove.addEventListener('click', () => {
              data.splice(index, 0, { title: '', subtitles: [] });
              render_2();
            });

            const addButtonBelow = document.createElement('button');
            addButtonBelow.classList.add("btn", "btn-small", "btn-add")

            const icon2 = document.createElement('i');
            icon2.classList.add("ti", "ti-arrow-big-down-line-filled");
            addButtonBelow.appendChild(icon2);

            addButtonBelow.addEventListener('click', () => {
              data.splice(index + 1, 0, { title: '', subtitles: [''] });
              render_2();
            });

            const deleteTitleButton = document.createElement('button');
            deleteTitleButton.classList.add("btn", "btn-small", "btn-danger")

            const icon3 = document.createElement('i');
            icon3.classList.add("ti", "ti-backspace-filled");
            deleteTitleButton.appendChild(icon3);

            deleteTitleButton.addEventListener('click', () => {
              data.splice(index, 1);
              let longitud = data.length;

              if(longitud == 0){
                sin_temario();
              }
              else{
                render_2();
              }
            });

            const linkSubtemas = document.createElement('Button');
            linkSubtemas.classList.add("btn", "btn-small", "btn-link")
            linkSubtemas.textContent = "Subtemas";

            linkSubtemas.addEventListener('click', () => {
              alert("Se abrirá una nueva ventana");
              window.location.href = "../../../../CISCIG/view/administrativo/Modi_Subtemas.php?index=" + index + "&id=" + id;
            });

            titleContainer.appendChild(titleInput);
            titleContainer.appendChild(addButtonAbove);
            titleContainer.appendChild(addButtonBelow);
            titleContainer.appendChild(deleteTitleButton);
            titleContainer.appendChild(linkSubtemas);

            temario.appendChild(titleContainer);

            const list = document.createElement('ul');

            temario.appendChild(list);
          });
        }
        temario.appendChild(list);
      });
    }
  }
}