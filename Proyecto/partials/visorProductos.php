<body>
<main>
    <label for="minimo">Precio mínimo:</label>
    <input type="number" step="0.01" name="min" id="min"/>
    <label for="maximo">Precio máximo:</label>
    <input type="number" step="0.01" name="max" id="max"/>
    <button onclick=fetchPrecio()>Filtrar</button>

    <br/><br/>
    
    <label for="pelicula">Elige una película:</label>
    <input list="peliculas" name="pelicula" id="pelicula" onchange="scrollProducto()">
        <datalist id="peliculas">

        </datalist>
    
    <div id="visor" class="visor">
    
        <!--<div id="1" class="item">
            <img src="img/planetatesoro.jpg" width="100" height="100">
            <p>Chaqueta 50€</p>
            <button>Comprar</button>
        </div> -->
    </div>
</main>
<script src="javascripts/main.js"> </script>
</body>