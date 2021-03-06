$(document).ready(function () {

    cargar();

    $("#cambiar_modo").click(function () {
        cambiar_modo();

    });

    function cambiar_modo(params) {
        document.querySelector(`#cambiar_modo i`).classList.toggle('fa-moon');
        document.querySelector(`#cambiar_modo i`).classList.toggle('fa-sun');
        document.getElementById('contenedor_central').classList.toggle('modoOscuro');
        document.getElementById('cambiar_modo').classList.toggle('blanco');
        document.getElementById('menu_categorias').classList.toggle('blanco');
        document.getElementById('texto_modo').classList.toggle('blanco');


        guardar(document.getElementById("contenedor_central").classList.contains('modoOscuro'));

        if (document.getElementById("contenedor_central").classList.contains('modoOscuro')) {
            $("#texto_modo").text("Modo Oscuro");
        }else{
            $("#texto_modo").text("Modo Claro");
        }

        var productos = document.getElementsByClassName('contenedor_producto');

        for (let i = 0; i < productos.length; i++) {

            productos[i].classList.toggle('gris');
        }

        var descripcion = document.getElementsByClassName('descripcion_producto');

        for (let i = 0; i < descripcion.length; i++) {

            descripcion[i].classList.toggle('blanco');
        }
        var nombre = document.getElementsByClassName('nombre');

        for (let i = 0; i < nombre.length; i++) {

            nombre[i].classList.toggle('blanco');
        }
        var puntuacion = document.getElementsByClassName('puntuacion');

        for (let i = 0; i < puntuacion.length; i++) {

            puntuacion[i].classList.toggle('blanco');
        }
        var stock = document.getElementsByClassName('stock');

        for (let i = 0; i < stock.length; i++) {

            stock[i].classList.toggle('blanco');
        }

        var img_producto = document.getElementsByClassName('img_producto');

        for (let i = 0; i < img_producto.length; i++) {

            img_producto[i].classList.toggle('bBlanco');
        }

        var btn_comprar = document.getElementsByClassName('btn_comprar');

        for (let i = 0; i < btn_comprar.length; i++) {

            btn_comprar[i].classList.toggle('blanco');
        }
    }

    function guardar(valor) {
        localStorage.setItem('modo_oscuro', valor);

    }

    function cargar() {
        var modo_oscuro = localStorage.getItem('modo_oscuro');

        if (!modo_oscuro) {
            guardar('false');
        } else if (modo_oscuro == 'true') {
            cambiar_modo();
        }
    }

});