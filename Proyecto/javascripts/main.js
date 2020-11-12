function	handleFiles(e)	{
    let ctx	=	document.getElementById('canvas').getContext('2d');
    let img	=	new	Image;
    img.src	=	URL.createObjectURL(e.target.files[0]);
    img.onload	=	function()	{
                    ctx.drawImage(img,	20,20);
    }
}

function aparecerCaja(){
    document.getElementById('caja').style.display="block";
}

function desaparecerCaja(){
    document.getElementById('caja').style.display="none";
}