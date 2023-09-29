let tipo;
window.onload = function () {
    document.getElementById("radio_ingreso").checked=false;
    document.getElementById("egreso").checked=false;
    tipo="egreso";
    $(buscar_datos());
}