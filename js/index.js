
function mostrarCodigo(codigo){

    document.getElementById('codigoGrande').innerText = codigo;

    document.getElementById('modalCodigo').style.display = 'block';
}

function fecharCodigo(){

    document.getElementById('modalCodigo').style.display = 'none';
}

