const boton = document.getElementById('boton_pdf');

boton.addEventListener('click', () => {
    // Obtenemos el id del cliente de la url con el URLSearchParams
    const id_cliente = new URLSearchParams(window.location.search).get('usuario');
    const url = "../administrativo/Pdf_polizas.php"

    const id = encodeURIComponent(id_cliente);

    window.location.href = url+"?id="+id;
});