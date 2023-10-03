
const expresiones = {
    descripcion: /^[a-zA-ZÁ-Ýá-ý\.\;\:\_\-\"\#\s]{1,200}$/, // Letras y espacios, pueden llevar acentos.
    monto: /^[0-9]+(.([0-9])+)*$/
}
const banderas = {
    descripcion:true,
    monto:true
}
