function confirmacion(e){
    
    if (confirm("¿Está seguro que desea eliminar el trabajador?")){
        return true;
    }else{
        e.preventDefault();
    }
}
