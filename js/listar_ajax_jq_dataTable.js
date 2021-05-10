    $(document).ready(obtenerDatos());

    function obtenerDatos() {

        $("#listar_productos").DataTable({
            pageLength: 5,
            responsive: true,
            processing: true,
            ajax: "./controlador/modi_pro.php?op=listar_productos"
        });


    }