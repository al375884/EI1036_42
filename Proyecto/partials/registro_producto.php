<body>
<main>
	<h1>Datos de registro del producto: </h1>
    <!-- si da error el formato, cambiar la class de form a form_usuario -->
	<form class="form_producto" id="formularioProducto" name="formularioProducto" action="?action=insertar_producto" method="POST">
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="name" id="nombreProducto" class="item_requerid" size="10" maxlength="50"/>
		<span class="error" id="errorNombreProducto"> Es obligatorio insertar un nombre al producto </span>
		<br/>
		<label for="precio">Precio</label>
		<br/>
		<input type="number" step="0.01" name="price" id="precio" class="item_requerid"/>
		<span class="error" id="errorPrecio"> Es obligatorio insertar un precio y debe ser positivo </span>
		<br/>
		<label for="foto">Foto</label>
		<br/>
		<input type="text" name="foto_url" id="foto_url" maxlength="50"/><br/>
		<input type=button value="Añadir foto" onclick="aparecerCaja()">
		<br/>
		<p> <input type="button" value="Enviar" onclick="validacionFormularioProducto()">
		<input type="reset" value="Deshacer">
		</p>
	</form>
	<div id="caja" class="widget">
		<input type=button id="botonCerrar" value="X" onclick="desaparecerCaja()">
		<form action="?action=upload" method="post" enctype="multipart/form-data">
			<input type="file" style="align:center" accept="image/*" name="foto_url" id="upload" onchange="handleFiles(event)"><br>
			<canvas id="canvas" class="canvas"></canvas><br>
			<input type="submit" value="SUBIR" name="uploadFoto" id="uploadFoto" onclick="guardarLocalStorage()">
		</form>
	</div>
</main>
<script src="javascripts/main.js"> </script>
</body>