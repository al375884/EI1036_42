function	handleFiles(e)	{
    let ctx	=	document.getElementById('canvas').getContext('2d');
    let img	=	new	Image;
    img.src	=	URL.createObjectURL(e.target.files[0]);
    img.onload	=	function()	{
                    ctx.drawImage(img,	20,20);
    }
    validarFoto();
}

function aparecerCaja(){
    document.getElementById('caja').style.display="block";
}

function desaparecerCaja(){
    document.getElementById('caja').style.display="none";
}

function guardarLocalStorage(){
    localStorage.setItem("nombreProducto", document.getElementById("nombreProducto").value);
    localStorage.setItem("precio", document.getElementById("precio").value);
    localStorage.setItem("foto", document.getElementById("upload").files[0].name);
}

function obtenerLocalStorage(){
    var storedNombre = localStorage.getItem("nombreProducto");
    var storedPrecio = localStorage.getItem("precio");
    let nombreProducto = document.getElementById("nombreProducto");
    nombreProducto.value = storedNombre;
    let precio = document.getElementById("precio");
    precio.value = storedPrecio;
    var storedUrl = localStorage.getItem("foto");
    let url = document.getElementById("foto_url");
    url.value = "img/" + storedUrl;
}


if(window.location.href == "http://localhost:3000/Proyecto/portal.php?action=upload"){
    document.onload = obtenerLocalStorage();
    borrarLocalStorage();
}


function borrarLocalStorage(){
    //localStorage.clear();
    localStorage.removeItem('nombreProducto');
    localStorage.removeItem('precio');
    localStorage.removeItem('foto');
}

function validarFoto(){
    let x = document.getElementById('upload');
    let size = x.files[0].size;
    if (size > 2000000){
        printf("La imagen supera el limite de tamaño (2MB)");
        document.getElementById("uploadFoto").disabled = true;
    }
    else{
        document.getElementById("uploadFoto").disabled = false;
    }
}

function validacionFormularioProducto(){
    document.getElementById("errorNombreProducto").style.display = "none";
    document.getElementById("errorPrecio").style.display = "none";
    var nombreProducto = document.getElementById("nombreProducto");
    var precio = document.getElementById("precio");
    if(nombreProducto.value == null || nombreProducto.value.length <= 0){
        document.getElementById("errorNombreProducto").style.display = "inline";
        //alert('Se debe proporcionar un nombre al producto');
        return 0;
    }
    if(precio.value == null || precio.value<0.00){
        document.getElementById("errorPrecio").style.display = "inline";
        //alert('El precio debe ser un numero positivo');
        return 0;
    }
    borrarLocalStorage();
    document.formularioProducto.submit();
}

// Funciones para la cesta

function aparecerCesta(){
    document.getElementById('cesta').style.display="block";
    guardarCesta();
}

function desaparecerCesta(){
    document.getElementById('cesta').style.display="none";
}

function guardarCesta(){
    let lista = document.querySelectorAll('.data-producto')
    lista = Array.from(lista).map(producto => producto.textContent)
    borrarCesta();
    localStorage.setItem('cesta', JSON.stringify(lista))
}

function listarCesta(){
    let lista = JSON.parse(localStorage.getItem('cesta'))
    if(lista && lista.length>0)
      lista.forEach(producto => anyadirProducto(producto))
}

function anyadirProducto(producto){
    let nodo = document.createElement('li');
  
    let span = document.createElement('span');
    span.classList.add('data-producto'); // añadimos una nueva clase al atributo 'class'

    span.textContent = producto;
    nodo.appendChild(span);

    let boton = document.createElement('button');
    boton.textContent = 'Eliminar';
    nodo.appendChild(boton);
    boton.onclick = eliminarDeCesta;
    boton.classList.add('boton');

    let saltoLinea = document.createElement('br');
    nodo.appendChild(saltoLinea);

    document.getElementById('list').appendChild(nodo);
}

function eliminarDeCesta(){
    this.parentNode.remove();
    guardarCesta();
}

function realizarCompra(){
    guardarCesta();
    let cesta = JSON.parse(localStorage.getItem('cesta'));
    //llamar a action=realizar_compra&productos='+lista
    borrarCesta();
    var productos = document.getElementById("items");
    productos.value = cesta;
    var accion = document.getElementById("accion").value;
    window.location.href == "http://localhost:3000/Proyecto/portal.php?" + accion + "&productos=" + cesta;
    //return cesta; 
}

function borrarCesta(){
    localStorage.removeItem('cesta');
}

//document.onload = borrarLocalStorage();


