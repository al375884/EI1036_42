<main>
	<h1>Gestión de Usuarios </h1>
	<form class="fom_usuario" action="?action=registrar" method="POST">

		<legend>Datos básicos</legend>
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="name" class="item_requerid" size="20" maxlength="50" />
		<br/>
		<label for="apellidos">Apellidos</label>
		<br/>
		<input type="text" name="surname" class="item_requerid" size="20" maxlength="50" />
		<br/>
		<label for="dirección">Dirección</label>
		<br/>
		<input type="text" name="address" class="item_requerid" size="20" maxlength="50" />
		<br/>
		<label for="ciudad">Ciudad</label>
		<br/>
		<input type="text" name="city" class="item_requerid" size="20" maxlength="50" />
		<br/>
		<label for="codigoPostal">Código Postal</label>
		<br/>
		<input type="text" name="zip_code" class="item_requerid" size="20" maxlength="5" />
		<br/>
		<label for="foto">Foto</label>
		<br/>
		<input type="text" name="foto_file" class="item_requerid" size="20" maxlength="25"/>
		<br/>
		<!--<label for="email">Email</label>
		<br/>
		<input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $email ?>"/>
		<br/>
		<label for="passwd">Clave</label>
		<br/>
		<input type="password" name="passwd" class="item_requerid" size="8" maxlength="25" value="<?php print $passwd ?>"
		/>
		<br/>  -->
		<p><input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
		</p>
	</form>
</main>