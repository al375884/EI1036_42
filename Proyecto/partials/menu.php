<body>
<nav>
	<ul>
		<li>
			<a href="./portal.php?action=home">Home</a>
		</li>
		<li>
			<a href="?action=listar_productos">Productos</a>
		</li>
		<li>
			<a href="?action=registrar_producto">Registrar Producto</a>
		</li>
		<li>
			<input type=button id="botonCesta" value="Cesta" onclick="aparecerCesta()">
		</li>
		<li>
			<a href="?action=listar_compras">Compras</a>
		</li>
		<li><a href="?action=login">Autentificar</a></li>
		<li><a href="?action=registrar_usuario">Registrarme</a></li>
		<?php 
		
		if (!isset($_SESSION['usuario'])){
			echo '<li><a href="?action=login">Autentificar</a></li>';
			echo '<li><a href="?action=registrar_usuario">Registrarme</a></li>';
		 }
		/*elseif (isset($_SESSION['usuario']) and $_SESSION['usuario'] =="admin")
			echo '<li><a href="?action=registrar_producto">Registrar Producto</a></li>';
		elseif (isset($_SESSION['usuario']))
		    echo '<li><a href="?action=ver_cesta">Cesta de Compra</a></li>';*/
        ?>
	</ul>
	<div id="cesta" class="cesta">
		<input type=button id="botonCerrarCesta" value="X" onclick="desaparecerCesta()">
		<form class="form_compra" action="?action=realizar_compra" method="GET">
		<h1> CESTA COMPRA </h1>
		<ul id="list">
		</ul>
		<center>
		<!--<button onclick="realizarCompra()">Comprar</button> -->
		<input type="submit" value="Comprar" onclick="realizarCompra()">
		<input id="accion" hidden name="action" value="realizar_compra"></input>
		<input id="items" hidden name="productos" value="1,2,3"></input>
		</center>
		</form>
	</div>
</nav>
<script src="javascripts/main.js"> </script>
</body>