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
    guardarCesta();
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

//Funciones JSON

function datosProducto(){
    fetch('https://localhost:3000/Proyecto/datos.php')
    .then(response => response.json())
    .then(json => console.log(json))
    .catch(err => console.log("Error al leer el JSON:", err));
}

function inyectarProducto(json){
    for(var producto of json){
        var id = producto.product_id;
        var nombre = producto.name;
        var precio = producto.price;
        var urlImagen = producto.foto_url;

        prod2ID[nombre] = id;

        let pelicula = document.createElement('option');
        pelicula.value = nombre;
        document.getElementById('peliculas').appendChild(pelicula);

        let div = document.createElement('div');
        div.className = "item"; 
        div.id = id;

        let img = document.createElement('img');
        //img.setAttribute(src, urlImagen);
        img.src = urlImagen;
        img.width = 270;
        img.height = 380;
        div.appendChild(img);

        let pNombre = document.createElement('p');
        pNombre.innerText = "Nombre: " + nombre;
        let pPrecio = document.createElement('p');
        pPrecio.innerText= "Precio: " + precio + "€";

        let boton = document.createElement('button');
        boton.textContent = 'Comprar';
        boton.onclick = visorAnyadirProducto;
        boton.classList.add('boton');

        div.appendChild(pNombre);
        div.appendChild(pPrecio);
        div.appendChild(boton);

        document.getElementById('visor').appendChild(div);
    }
}

function visorAnyadirProducto(){
    anyadirProducto(this.id);
    guardarCesta();
}

var prod2ID = {};

function scrollProducto(){
    var nombreProducto = document.getElementById("pelicula").value;
    var id = prod2ID[nombreProducto]
    document.getElementById(id).scrollIntoView()
}

 
function fecthPrecio(){
    var min = document.getElementById('min').value;
    var max = document.getElementById('max').value;
    let ruta = 'precios.php?min='+min+'&max='+max;

    fetch(ruta)
    .then(response => response.json())
	//.then(json => console.log(json))
	.then(data => filtrarPorPrecios(data))
    .catch(err => console.log("Error al leer el JSON:", err));
}

function filtrarPorPrecios(json){
    if (json != ""){
        while(document.getElementById('visor').hasChildNodes()){
            document.getElementById('visor').removeChild(document.getElementById('visor').lastChild);
            document.getElementById('visor');
        }
        document.getElementById('peliculas').innerHTML = "";
        inyectarProducto(json);
    }
    else{
        alert('No existen productos entre esos precios');
    }
}

