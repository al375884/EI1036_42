//Carrusel

var prev = function() {
    var carrusel = document.getElementById('carrusel');
    carrusel.prev();
};
  
var next = function() {
    var carrusel = document.getElementById('carrusel');
    carrusel.next();
};
  
ons.ready(function() {
    var carrusel = document.addEventListener('postchange', function(event) {
      console.log('Changed to ' + event.activeIndex)
    });
});

//JSON

/*function datosProducto(){
    fetch('datos.php')
    .then(response => response.json())
	//.then(json => console.log(json))
	.then(data => inyectarProducto(data))
    .catch(err => console.log("Error al leer el JSON:", err));
}*/

function inyectarProducto(json){
    for(var producto of json){
        var id = producto.product_id;
        var nombre = producto.name;
        var precio = producto.price;
        var urlImagen = producto.foto_url;

        //prod2ID[nombre] = id;

        /*let pelicula = document.createElement('option');
        pelicula.value = nombre;
        document.getElementById('peliculas').appendChild(pelicula);*/

        let onsCarrusel = document.createElement('ons-carousel-item')
        
        let div = document.createElement('div');
        div.className = "item"; 
        div.id = id;
        div.style = "text-align: center";

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

        let boton = document.createElement('ons-button');
        boton.textContent = 'Comprar';
        boton.onclick = movilAnyadirProducto;
        boton.classList.add('boton');

        div.appendChild(pNombre);
        div.appendChild(pPrecio);
        div.appendChild(boton);

        onsCarrusel.appendChild(div);

        document.getElementById('carrusel').appendChild(onsCarrusel);
    }
}

function movilAnyadirProducto(){
    anyadirProducto(this.parentNode.id);
    guardarCesta();
}

//CESTA

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
    let onsListItem = document.createElement('ons-list-item');
  
    let span = document.createElement('span');
    span.classList.add('data-producto'); // añadimos una nueva clase al atributo 'class'

    span.textContent = producto;
    onsListItem.appendChild(span);

    let boton = document.createElement('ons-button');
    boton.textContent = 'Eliminar';
    onsListItem.appendChild(boton);
    boton.onclick = eliminarDeCesta;
    boton.classList.add('boton');

    let saltoLinea = document.createElement('br');
    onsListItem.appendChild(saltoLinea);

    document.getElementById('lista').appendChild(onsListItem);
    guardarCesta();
}

function eliminarDeCesta(){
    this.parentNode.remove();
    guardarCesta();
}

function fetchRealizarCompra(){
    guardarCesta();
    let cesta = JSON.parse(localStorage.getItem('cesta'));
    borrarCesta();
    let ruta = "comprar.php?productos=" + cesta;

    fetch(ruta)
    .then(response => response.json())
	.then(data => resultadoCompra(data))
    .catch(err => console.log("Error al leer el JSON:", err));
    
}

function borrarCesta(){
    localStorage.removeItem('cesta');
}

function resultadoCompra(json){
    var resultado = json.resultado;
    if (resultado == "OK"){
        alert('COMPRA REALIZADA!');
    }
    else{
         alert('No se ha podido realizar la compra');
    }
    window.location.reload();
}