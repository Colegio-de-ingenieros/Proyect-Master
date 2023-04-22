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

    /* Generación del  */
    if (data.length > 0) {
      generarTemario();
    }
    else{
      const newLabel = document.createElement('label');
      newLabel.classList.add("label-2")
      newLabel.textContent = "No hay temas registrados";

      const addButtonEmpty = document.createElement('button');
      addButtonEmpty.classList.add("btn", "btn-small", "btn-add")
      
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
          render_2();
        });

        titleContainer.appendChild(titleInput);
        titleContainer.appendChild(addButtonAbove);
        titleContainer.appendChild(addButtonBelow);
        titleContainer.appendChild(deleteTitleButton);

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
              render_2();
            });

            titleContainer.appendChild(titleInput);
            titleContainer.appendChild(addButtonAbove);
            titleContainer.appendChild(addButtonBelow);
            titleContainer.appendChild(deleteTitleButton);

            temario.appendChild(titleContainer);

            const list = document.createElement('ul');

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
    }
  }
}
/* window.onload = function () {
  let url = "../../controller/administrativo/Mostrar_Temario.php";
  var id = document.getElementById("id-usuario").textContent;

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

    var datos_generales = list[0]
    var data = list[1]

    const nombre = document.getElementById("nombre-curso");
    const clave = document.getElementById("clave-curso");
    const duracion = document.getElementById("duración");
    const objetivo = document.getElementById("objetivo");

    var expresiones = {
      clave: /^[0-9]{6}$/,
      duracion: /^[0-9]{0,3}$/,
      nombres: /^[a-zA-ZÁ-ý0-9\s .,]{1,40}$/,
      objetivosjhg: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
      objetivo: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]+$/,
      tema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
      subtema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    }

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
          render_2();
        });

        titleContainer.appendChild(titleInput);
        titleContainer.appendChild(addButtonAbove);
        titleContainer.appendChild(addButtonBelow);
        titleContainer.appendChild(deleteTitleButton);

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
              render_2();
            });

            titleContainer.appendChild(titleInput);
            titleContainer.appendChild(addButtonAbove);
            titleContainer.appendChild(addButtonBelow);
            titleContainer.appendChild(deleteTitleButton);

            temario.appendChild(titleContainer);

            const list = document.createElement('ul');

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

      var nom = true;
      var dura = true;
      var objetiv = true;

      var expresiones = {
        clave: /^[0-9]{6}$/,
        duracion: /^[0-9]{0,3}$/,
        nombres: /^[a-zA-ZÁ-ý0-9\s .,]{1,40}$/,
        objetivosjhg: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
        objetivo: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]+$/,
        tema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
        subtema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
      }

      let nombre = document.getElementById("nombre-curso");
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
      })

      let objetivo = document.getElementById("objetivo");
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
      })

      let duracion = document.getElementById("duración");
      duracion.addEventListener('keyup', (e) => {
        let valorInput = e.target.value;

        duracion.value = valorInput
          .replace(/\s/g, '')
          .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·°¨´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '')
          .replace(/[a-zA-ZáéíóúÁÉÍÓÚñÑ.,]/g, '')
          .trim();


        if (!expresiones.duracion.test(valorInput)) {
          duracion.style.border = "3px solid red";
          dura = false
        } else {
          duracion.removeAttribute("style");
          dura = true
        }
      })

      const actualizar_curso = document.getElementById("update-form");

      actualizar_curso.addEventListener('click', () => {
        if (nom == false) {
          nombre.style.border = "3px solid red";
        }
        if (dura == false) {
          duracion.style.border = "3px solid red";
        }
        if (objetiv == false) {
          objetivo.style.border = "3px solid red";
        }
        if (dura === true && nom == true && objetiv == true) {
          datos_generales = [clave.value,nombre.value, objetivo.value, duracion.value]

          lista_temario = convertirData(data);
          console.log(datos_generales);
          console.log(lista_temario);
          alert("Curso modificado con éxito");

          let url = "../../controller/administrativo/Eliminar_Temario.php";

          let form = new FormData();
          form.append("id", id)
          form.append("arrayin", JSON.stringify(datos_generales));
          form.append("lista", JSON.stringify(lista_temario));

          fetch(url,{
            method: 'POST',
            body: form
          })
          .then(response => response.json())
          .then(data => eliminar_temario(data))
          .catch(error => console.log(error))
        }
        else {
          alert("Asegurese que todos los campos sean correctos");
        }

      });

      const convertirData = (data) => {
        return data.map(item => [item.title, ...item.subtitles]);
      }
    }
    else {
      var mensaje = "No hay temario disponible.";
      document.getElementById("mensaje").innerHTML = "<b style='text-align:center'>" + mensaje + "</b>";
    }
  }
}  */