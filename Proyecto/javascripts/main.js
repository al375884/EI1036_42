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

function validarFoto(){
    let x = document.getElementById('upload');
    let size = x.files[0].size;
    if (size > 2000000){
        printf("La imagen supera el limite de tamaño (2MB)");
        document.getElementById("upladFoto").disabled = true;
    }
    else{
        document.getElementById("upladFoto").disabled = false;
    }
}

function uploadFoto(){
    var inputUrl = document.getElementById("upload");
    localStorage.setItem("upload", inputUrl.value);
    desaparecerCaja();
}

function guardarLocalStorage(){
    var inputNombre = document.getElementById("nombreProducto");
    localStorage.setItem("nombreProducto", inputNombre.value);
    var inputPrecio = document.getElementById("precio");
    localStorage.setItem("precio", inputPrecio.value);
    aparecerCaja();
}

function obtenerLocalStorage(){
    var storedNombre = localStorage.getItem("nombreProducto");
    var storedPrecio = localStorage.getItem("precio");
    var storedUrl = localStorage.getItem("upload");
    let nombre = document.getElementById("nombreProducto");
    nombre.value = storedNombre;
    let precio = document.getElementById("precio");
    precio.value = storedPrecio;
    let url = document.getElementById("url_foto");
    url.value = "img/" + storedUrl;
}

function borrarLocalStorage(){
    localStorage.clear();
}

document.onload = obtenerLocalStorage();