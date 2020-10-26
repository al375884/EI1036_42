<main>
	<h1>Datos de registro: </h1>
    <!-- si da error el formato, cambiar la class de form a form_usuario -->
	<form class="form_producto" action="?action=insertar_producto" method="POST">

		<legend>Datos básicos del producto</legend>
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="name" class="item_requerid" size="10" maxlength="50"/>
		<br/>
		<label for="precio">Precio</label>
		<br/>
		<input type="float" name="price" class="item_requerid"/>
		<br/>
		<label for="foto">Foto</label>
		<br/>
		<input type="text" name="foto_url" size="10" maxlength="25"/>
		<br/>
		
		<p><input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
		</p>
	</form>
</main>