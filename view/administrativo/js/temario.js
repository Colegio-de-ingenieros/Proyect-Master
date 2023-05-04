var DataGlobal;

window.onload = function () {
  let url = "../../controller/administrativo/Mostrar_Temario.php";
  var id = document.getElementById("id-usuario").textContent;

  let form = new FormData();
  form.append("id_usuario", id);

  fetch(url, {
    method: "POST",
    body: form,
  })
    .then((response) => response.json())
    .then((json) => respuesta(json))
    .catch((error) => alert(error));

  const respuesta = (json) => {
    /* Validación de los campos generales */
    list = json.map((obj) => Object.values(obj));

    var datos_generales = list[0];
    var data = list[1];
    DataGlobal = list[1];

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
      duracion: /^[0-9]{1,3}$/,
      nombres: /^[a-zA-ZÁ-ý0-9\s .,]{1,40}$/,
      objetivosjhg: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
      objetivo: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]+$/,
      tema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
      subtema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    }

    nombre.addEventListener("keyup", (e) => {
      let valorInput = e.target.value;

      nombre.value = valorInput.replace(
        /[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g,
        ""
      );

      if (!expresiones.nombres.test(valorInput)) {
        nombre.style.border = "3px solid red";
        nom = false;
      } else {
        nombre.removeAttribute("style");
        nom = true;
      }
    });

    objetivo.addEventListener("keyup", (e) => {
      let valorInput = e.target.value;

      objetivo.value = valorInput.replace(
        /[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g,
        ""
      );

      if (!expresiones.objetivo.test(valorInput)) {
        objetivo.style.border = "3px solid red";
        objetiv = false;
      } else {
        objetivo.removeAttribute("style");
        objetiv = true;
      }
    });

    duracion.addEventListener("keyup", (e) => {
      let valorInput = e.target.value;
      duracion.value = valorInput
        .replace(/\s/g, "")
        .replace(
          /[üâäàåçê♪ëèïîìÄÅÉæ·°¨´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g,
          ""
        )
        .replace(/[a-zA-ZáéíóúÁÉÍÓÚñÑ.,]/g, "")
        .trim();

      if (!expresiones.duracion.test(valorInput)) {
        duracion.style.border = "3px solid red";
        dura = false;
      } else {
        duracion.removeAttribute("style");
        dura = true;
      }
    });

    /* Generación del temario  */
    if (DataGlobal.length > 0) {
      generarTemario();
    } else {
      sin_temario();
    }

    function sin_temario() {
      temario.innerHTML = "";
      const newLabel = document.createElement("label");
      newLabel.classList.add("label-2");
      newLabel.textContent = "No hay temas registrados";

      const addButtonEmpty = document.createElement("button");
      addButtonEmpty.classList.add("btn", "btn-small", "btn-add");
      addButtonEmpty.textContent = "Agregar tema";
      addButtonEmpty.style.display = "block";

      addButtonEmpty.addEventListener("click", () => {
        DataGlobal.push({
          title: "",
          subtitles: [],
        });

        generarTemario();

      });

      temario.appendChild(newLabel);
      temario.appendChild(addButtonEmpty);
    }

    function generarTemario() {
      temario.innerHTML = "";
      DataGlobal.forEach((item, index) => {

        const titleContainer = document.createElement("div");
        titleContainer.classList.add("row");

        const titleInput = document.createElement("input");
        titleInput.type = "text";
        titleInput.value = item.title;
        titleInput.classList.add("input-format-2");
        titleInput.placeholder = "Nuevo tema";
        titleInput.maxLength = 40;

        titleInput.addEventListener("keyup", (e) => {
          let valorInput = e.target.value;
          titleInput.value = valorInput.replace(
            /[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g,
            ""
          );
          tema = titleInput.value;

          if (!expresiones.tema.test(valorInput)) {
            titleInput.style.border = "3px solid red";
          } else {
            titleInput.removeAttribute("style");
          }
        });

        titleInput.addEventListener("input", () => {
          item.title = titleInput.value;
        });

        const addButtonAbove = document.createElement("button");
        addButtonAbove.classList.add("btn", "btn-small", "btn-add");

        const icon = document.createElement("i");
        icon.classList.add("ti", "ti-arrow-big-up-line-filled");
        addButtonAbove.appendChild(icon);

        addButtonAbove.addEventListener("click", () => {
          data.splice(index, 0, { title: "", subtitles: [] });
          render_2();
        });

        const addButtonBelow = document.createElement("button");
        addButtonBelow.classList.add("btn", "btn-small", "btn-add");

        const icon2 = document.createElement("i");
        icon2.classList.add("ti", "ti-arrow-big-down-line-filled");
        addButtonBelow.appendChild(icon2);

        addButtonBelow.addEventListener("click", () => {
          data.splice(index + 1, 0, { title: "", subtitles: [] });
          render_2();
        });

        const deleteTitleButton = document.createElement("button");
        deleteTitleButton.classList.add("btn", "btn-small", "btn-danger");

        const icon3 = document.createElement("i");
        icon3.classList.add("ti", "ti-backspace-filled");
        deleteTitleButton.appendChild(icon3);

        deleteTitleButton.addEventListener("click", () => {
          data.splice(index, 1);
          let longitud = data.length;

          if (longitud == 0) {
            sin_temario();
          } else {
            render_2();
          }
        });

        const linkSubtemas = document.createElement("Button");
        linkSubtemas.classList.add("btn", "btn-small", "btn-link");
        linkSubtemas.textContent = "Subtemas";
        linkSubtemas.setAttribute("onclick", "mostrar_modal('" + index + "')");



        titleContainer.appendChild(titleInput);
        titleContainer.appendChild(addButtonAbove);
        titleContainer.appendChild(addButtonBelow);
        titleContainer.appendChild(deleteTitleButton);
        titleContainer.appendChild(linkSubtemas);

        temario.appendChild(titleContainer);

        const list = document.createElement("ul");

        const render_2 = () => {
          temario.innerHTML = "";

          DataGlobal.forEach((item, index) => {
            const titleContainer = document.createElement("div");
            titleContainer.classList.add("row");

            const titleInput = document.createElement("input");
            titleInput.type = "text";
            titleInput.value = item.title;
            titleInput.classList.add("input-format-2");
            titleInput.placeholder = "Nuevo tema";
            titleInput.maxLength = 40;

            titleInput.addEventListener("keyup", (e) => {
              let valorInput = e.target.value;
              titleInput.value = valorInput.replace(
                /[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g,
                ""
              );
              tema = titleInput.value;

              if (!expresiones.tema.test(valorInput)) {
                titleInput.style.border = "3px solid red";
              } else {
                titleInput.removeAttribute("style");
              }
            });

            titleInput.addEventListener("input", () => {
              item.title = titleInput.value;
            });

            const addButtonAbove = document.createElement("button");
            addButtonAbove.classList.add("btn", "btn-small", "btn-add");

            const icon = document.createElement("i");
            icon.classList.add("ti", "ti-arrow-big-up-line-filled");
            addButtonAbove.appendChild(icon);

            addButtonAbove.addEventListener("click", () => {
              data.splice(index, 0, { title: "", subtitles: [] });
              render_2();
            });

            const addButtonBelow = document.createElement("button");
            addButtonBelow.classList.add("btn", "btn-small", "btn-add");

            const icon2 = document.createElement("i");
            icon2.classList.add("ti", "ti-arrow-big-down-line-filled");
            addButtonBelow.appendChild(icon2);

            addButtonBelow.addEventListener("click", () => {
              data.splice(index + 1, 0, { title: "", subtitles: [] });
              render_2();
            });

            const deleteTitleButton = document.createElement("button");
            deleteTitleButton.classList.add("btn", "btn-small", "btn-danger");

            const icon3 = document.createElement("i");
            icon3.classList.add("ti", "ti-backspace-filled");
            deleteTitleButton.appendChild(icon3);

            deleteTitleButton.addEventListener("click", () => {
              DataGlobal.splice(index, 1);
              let longitud = data.length;

              if (longitud == 0) {
                sin_temario();
              } else {
                render_2();
              }
            });

            const linkSubtemas = document.createElement("Button");
            linkSubtemas.classList.add("btn", "btn-small", "btn-link");
            linkSubtemas.textContent = "Subtemas";
            linkSubtemas.setAttribute("onclick", "mostrar_modal(" + index + ")");

            titleContainer.appendChild(titleInput);
            titleContainer.appendChild(addButtonAbove);
            titleContainer.appendChild(addButtonBelow);
            titleContainer.appendChild(deleteTitleButton);
            titleContainer.appendChild(linkSubtemas);

            temario.appendChild(titleContainer);

            const list = document.createElement("ul");

            temario.appendChild(list);
          });
        };
        temario.appendChild(list);
      });
    }
  };
};

const abrir_modal = document.getElementById("open");
const cerrar_modal = document.getElementById("close");
const modal = document.getElementById("modal-container");
const modalContainer = document.getElementById("modal");
const modalTitle = document.getElementById("modal-title");

function mostrar_modal(position) {
  modalContainer.innerHTML = "";
  modal.classList.add("show");

  var expresiones = {
    clave: /^[0-9]{6}$/,
    duracion: /^[0-9]{0,3}$/,
    nombres: /^[a-zA-ZÁ-ý0-9\s .,]{1,40}$/,
    objetivosjhg: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    objetivo: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]+$/,
    tema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    subtema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
  };

  const cerarModal = document.getElementById("close");
  cerarModal.setAttribute("onclick", "ocultar_modal(" + position + ")");

  DataGlobal.forEach((item, index) => {
    const modalContainer = document.getElementById("modal");
    const list = document.createElement("ul");

    if (index == position) {
      /* Verifica que la cantidad de subtitulos sea superior a 1 */
      let longitud_subtemas = item.subtitles.length;

      if (longitud_subtemas >= 1) {
        list.classList.add("list-items");
        modalTitle.textContent = item.title;

        /* const cerarModal = document.getElementById("close");
        cerarModal.setAttribute("onclick", "ocultar_modal(" + position + ")");
 */
        item.subtitles.forEach((subtitle, index) => {
          const listItem = document.createElement("li");
          listItem.classList.add("row-s");

          const input = document.createElement("input");
          input.type = "text";
          input.value = subtitle;
          input.classList.add("input-format-2");
          input.placeholder = "Nuevo subtema";
          input.maxLength = 40;

          input.addEventListener("keyup", (e) => {
            let valorInput = e.target.value;
            input.value = valorInput.replace(
              /[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g,
              ""
            );
            subtema = input.value;
            if (!expresiones.subtema.test(valorInput)) {
              input.style.border = "3px solid red";
            } else {
              input.removeAttribute("style");
            }
          });

          // Agregamos el evento 'input' al subtítulo para actualizar automáticamente el elemento correspondiente en la lista
          input.addEventListener("input", () => {
            item.subtitles[index] = input.value;
          });

          // Creamos el botón para agregar un subtítulo arriba del elemento actual
          const addButtonAbove = document.createElement("button");
          addButtonAbove.classList.add("btn", "btn-small", "btn-add");

          const icon = document.createElement("i");
          icon.classList.add("ti", "ti-arrow-big-up-line-filled");
          addButtonAbove.appendChild(icon);

          addButtonAbove.addEventListener("click", () => {
            item.subtitles.splice(index, 0, "");
            render_subtemas();
          });

          // Creamos el botón para agregar un subtítulo debajo del elemento actual
          const addButtonBelow = document.createElement("button");
          addButtonBelow.classList.add("btn", "btn-small", "btn-add");

          const icon2 = document.createElement("i");
          icon2.classList.add("ti", "ti-arrow-big-down-line-filled");
          addButtonBelow.appendChild(icon2);

          addButtonBelow.addEventListener("click", () => {
            item.subtitles.splice(index + 1, 0, "");
            render_subtemas();
          });

          const deleteButton = document.createElement("button");
          deleteButton.classList.add("btn", "btn-small", "btn-danger");

          const icon3 = document.createElement("i");
          icon3.classList.add("ti", "ti-backspace-filled");
          deleteButton.appendChild(icon3);

          deleteButton.addEventListener("click", () => {
            item.subtitles.splice(index, 1);
            let longitud_subtemas = item.subtitles.length;

            if (longitud_subtemas == 0) {
              modalContainer.innerHTML = "";
              const newLabelSubtema = document.createElement("label");
              newLabelSubtema.classList.add("label-2");
              newLabelSubtema.textContent = "No hay subtemas registrados";
              newLabelSubtema.style.marginBottom = "10px";
              newLabelSubtema.style.marginTop = "10px";

              const addButtonSubtitleEmpty = document.createElement("button");
              addButtonSubtitleEmpty.classList.add(
                "btn",
                "btn-small",
                "btn-add"
              );
              addButtonSubtitleEmpty.textContent = "Agregar subtema";

              addButtonSubtitleEmpty.addEventListener("click", () => {
                item.subtitles.splice(index, 0, "");
                render_subtemas();
              });

              modalContainer.appendChild(newLabelSubtema);
              modalContainer.appendChild(addButtonSubtitleEmpty);
            } else {
              render_subtemas();
            }
          });

          listItem.appendChild(input);
          listItem.appendChild(addButtonAbove);
          listItem.appendChild(addButtonBelow);
          listItem.appendChild(deleteButton);

          list.appendChild(listItem);
        });
        /* Crear los elementos en el DOM */
        modalContainer.appendChild(list);
      }
      else if (longitud_subtemas == 0) {
        list.classList.add("list-items");
        modalTitle.textContent = item.title;
        modalContainer.innerHTML = "";

        /* const cerarModal = document.getElementById("close");
        cerarModal.setAttribute("onclick", "ocultar_modal(" + index + ")"); */

        const newLabelSubtema = document.createElement("label");
        newLabelSubtema.classList.add("label-2");
        newLabelSubtema.textContent = "No hay subtemas registrados";
        newLabelSubtema.style.marginBottom = "10px";
        newLabelSubtema.style.marginTop = "10px";
        newLabelSubtema.style.marginLeft = "10px";


        const addButtonSubtitleEmpty = document.createElement("button");
        addButtonSubtitleEmpty.classList.add("btn", "btn-small", "btn-add");
        addButtonSubtitleEmpty.textContent = "Agregar subtema";
        addButtonSubtitleEmpty.style.marginLeft = "10px";

        addButtonSubtitleEmpty.addEventListener("click", () => {
          item.subtitles.splice(index, 0, "");
          render_subtemas();
        });

        modalContainer.appendChild(newLabelSubtema);
        modalContainer.appendChild(addButtonSubtitleEmpty);
      }
    }
  });

  /* Función para la destrucción y nueva renderizacion de subtemas */
  const render_subtemas = () => {
    modalContainer.innerHTML = "";

    DataGlobal.forEach((item, index) => {
      const list = document.createElement("ul");
      list.classList.add("list-items");

      if (index == position) {
        item.subtitles.forEach((subtitle, index) => {
          const listItem = document.createElement("li");
          listItem.classList.add("row-s");

          const input = document.createElement("input");
          input.type = "text";
          input.value = subtitle;
          input.classList.add("input-format-2");
          input.placeholder = "Nuevo subtema";
          input.maxLength = 40;
          
          input.addEventListener("keyup", (e) => {
            let valorInput = e.target.value;
            input.value = valorInput.replace(
              /[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g,
              ""
            );
            subtema = input.value;
            if (!expresiones.subtema.test(valorInput)) {
              input.style.border = "3px solid red";
            } else {
              input.removeAttribute("style");
            }
          });

          // Agregamos el evento 'input' al subtítulo para actualizar automáticamente el elemento correspondiente en la lista
          input.addEventListener("input", () => {
            item.subtitles[index] = input.value;
          });

          // Creamos el botón para agregar un subtítulo arriba del elemento actual
          const addButtonAbove = document.createElement("button");
          addButtonAbove.classList.add("btn", "btn-small", "btn-add");

          const icon = document.createElement("i");
          icon.classList.add("ti", "ti-arrow-big-up-line-filled");
          addButtonAbove.appendChild(icon);

          addButtonAbove.addEventListener("click", () => {
            item.subtitles.splice(index, 0, "");
            render_subtemas();
          });

          // Creamos el botón para agregar un subtítulo debajo del elemento actual
          const addButtonBelow = document.createElement("button");
          addButtonBelow.classList.add("btn", "btn-small", "btn-add");

          const icon2 = document.createElement("i");
          icon2.classList.add("ti", "ti-arrow-big-down-line-filled");
          addButtonBelow.appendChild(icon2);

          addButtonBelow.addEventListener("click", () => {
            item.subtitles.splice(index + 1, 0, "");
            render_subtemas();
          });

          const deleteButton = document.createElement("button");
          deleteButton.classList.add("btn", "btn-small", "btn-danger");

          const icon3 = document.createElement("i");
          icon3.classList.add("ti", "ti-backspace-filled");
          deleteButton.appendChild(icon3);

          deleteButton.addEventListener("click", () => {
            item.subtitles.splice(index, 1);
            let longitud_subtemas = item.subtitles.length;

            if (longitud_subtemas == 0) {
              modalContainer.innerHTML = "";
              const newLabelSubtema = document.createElement("label");
              newLabelSubtema.classList.add("label-2");
              newLabelSubtema.textContent = "No hay subtemas registrados";
              newLabelSubtema.style.marginBottom = "10px";
              newLabelSubtema.style.marginTop = "10px";
              newLabelSubtema.style.marginLeft = "10px";

              const addButtonSubtitleEmpty = document.createElement("button");
              addButtonSubtitleEmpty.classList.add(
                "btn",
                "btn-small",
                "btn-add"
              );
              addButtonSubtitleEmpty.textContent = "Agregar subtema";
              addButtonSubtitleEmpty.style.marginLeft = "10px";

              addButtonSubtitleEmpty.addEventListener("click", () => {
                item.subtitles.splice(index, 0, "");
                render_subtemas();
              });

              modalContainer.appendChild(newLabelSubtema);
              modalContainer.appendChild(addButtonSubtitleEmpty);
            } else {
              render_subtemas();
            }
          });

          listItem.appendChild(input);
          listItem.appendChild(addButtonAbove);
          listItem.appendChild(addButtonBelow);
          listItem.appendChild(deleteButton);

          list.appendChild(listItem);
        });

        modalContainer.appendChild(list);
      }
    });
  };
}

function ocultar_modal(position) {
  let bandera_subtemas = false;

  DataGlobal.forEach((item, index) => {

    if (index == position) {
      let longitud_subtemas = item.subtitles.length;

      if (longitud_subtemas == 0) {
        bandera_subtemas = false;
      }
      else {
        item.subtitles.forEach((subtitle, index) => {
          let contenido_subtitulo = subtitle;
          if (contenido_subtitulo == "") {
            bandera_subtemas = true;
          }
        });
      }
    }
  });


  if (bandera_subtemas == true) {
    alert("No puede haber subtemas vacios");
  }
  else {
    modal.classList.remove("show");
  }
}

const enviar = document.getElementById("update-form");
const regresar = document.getElementById("delete-form");

enviar.addEventListener("click", (e) => {

  let vacio = validar_temas();

  if (vacio == true) {
    alert("No puede haber temas vacios");
  }
  else {
    let temario = convertirData(DataGlobal);
    console.log("Temario: ", temario);

    let nombre_curso = document.getElementById("nombre-curso").value;
    let clave_curso = document.getElementById("clave-curso").value;
    let duracion_curso = document.getElementById("duración").value;
    let objetivo_curso = document.getElementById("objetivo").value;

    let basicos = [nombre_curso, clave_curso, duracion_curso, objetivo_curso];

    let url = "../../controller/administrativo/Eliminar_Temario.php";
    let form = new FormData()

    console.log("Basicos: ", basicos);
    console.log("Temario: ", temario);

    form.append("arrayin", JSON.stringify(basicos));
    form.append("lista", JSON.stringify(temario));
    fetch(url, {
      method: "POST",
      body: form,
    })
      .then((res) => res.json())
      .then((data) => {
        alert("Actualización exitosa");
        window.location.href = "Vista_Cursos.html ";
      });
  }
});

function validar_temas() {
  let bandera = false;
  /* Imprime cada item de la DataGlobal */
  DataGlobal.forEach((item, index) => {
    let titulo = item.title;
    if (titulo == "") {
      bandera = true;
    }
  });

  return bandera;
}

regresar.addEventListener("click", (e) => {
  let respuesta_confirm = confirm("¿Está seguro que desea regresar?");

  if (respuesta_confirm == true) {
    window.location.href = "Vista_Cursos.html ";
  }
});

const convertirData = (data) => {
  return data.map((item) => [item.title, ...item.subtitles]);
};