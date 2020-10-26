<main>
	<h1>Datos de registro: </h1>
	<form class="form_usuario" action="?action=insertar_usuario" method="POST">

		<legend>Datos básicos</legend>
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="name" class="item_requerid" size="10" maxlength="50"/>
		<br/>
		<label for="apellidos">Apellidos</label>
		<br/>
		<input type="text" name="surname" class="item_requerid" size="10" maxlength="50"/>
		<br/>
		<label for="rol">Rol</label>
		<br/>
		<input type="text" name="role" size="10" maxlength="10"/>
		<br/>
		<label for="clave">Clave</label>
		<br/>
		<input type="password" name="passwd" size="10"/>
		<br/>
		<label for="direccion">Direccion</label>
		<br/>
		<input type="text" name="address" size="10" maxlength="50"/>
		<br/>
		<label for="ciudad">Ciudad</label>
		<br/>
		<input type="text" name="city" size="10" maxlength="50"/>
		<br/>
		<label for="codigoPostal">Codigo Postal</label>
		<br/>
		<input type="text" name="zip_code" size="10" maxlength="5"/>
		<br/>
		<label for="foto">Foto</label>
		<br/>
		<input type="text" name="foto_file" size="10" maxlength="50"/>
		<br/>
		
		<p><input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
		</p>
	</form>
</main>