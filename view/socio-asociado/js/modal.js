const abrir_modal = document.getElementById('open');
const cerrar_modal = document.getElementById('close');
const modal = document.getElementById('modal-container');

function mostrar_modal() {
    modal.classList.add('show');
}
function ocultar_modal() {
    modal.classList.remove('show');
}
