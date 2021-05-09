<?php

class factura{

    private $id_factura;
    private $fecha;
    private $cantidad;
    private $nombre_producto;
    private $precio_producto;
    private $nombre_cliente;
    private $apellidos_cliente;
    private $direccion_cliente;
    private $provincia_cliente;
    private $codigo_postal_cliente;



    function __construct($id_factura, $fecha, $cantidad, $nombre_producto, $precio_producto,$nombre_cliente,$apellidos_cliente,$direccion_cliente,$provincia_cliente,$codigo_postal_cliente)
    {
        $this->id_factura = $id_factura;
        $this->fecha = $fecha;
        $this->cantidad = $cantidad;
        $this->nombre_producto = $nombre_producto;
        $this->precio_producto = $precio_producto;
        $this->nombre_cliente = $nombre_cliente;
        $this->apellidos_cliente = $apellidos_cliente;
        $this->direccion_cliente = $direccion_cliente;
        $this->provincia_cliente = $provincia_cliente;
        $this->codigo_postal_cliente = $codigo_postal_cliente;
    }
    
    public function id_factura(){
        return $this->id_factura;
    }
    public function fecha(){
        return $this->fecha;
    }
    public function cantidad(){

        return $this->cantidad;
    }
    public function nombre_producto(){
        return $this->nombre_producto;
    }
    public function precio_producto(){
        return $this->precio_producto;
    }
    public function nombre_cliente(){
        return $this->nombre_cliente;
    }
    public function apellidos_cliente(){
        return $this->apellidos_cliente;
    }
    public function direccion_cliente(){
        return $this->direccion_cliente;
    }
    public function provincia_cliente(){
        return $this->provincia_cliente;
    }
    public function codigo_postal_cliente(){
        return $this->codigo_postal_cliente;
    }


    public function construir_factura(){

        $id_pedido = $this->id_factura();
        $fecha = $this->fecha();
        $cantidad = $this->cantidad();
        $nombre_producto = $this->nombre_producto();
        $precio_producto = $this->precio_producto();
        $nombre_cliente = $this->nombre_cliente();
        $apellidos_cliente = $this->apellidos_cliente();
        $direccion_cliente = $this->direccion_cliente();
        $provincia_cliente = $this->provincia_cliente();
        $codigo_postal_cliente = $this->codigo_postal_cliente();

        $id_factura = $id_pedido;
        $fecha_factura = $fecha;

        //Recibir los datos de la empresa
        $nombre_tienda = "Omnis";
        $direccion_tienda = "Jose EcheGaray 10";
        $provincia_tienda = "Alicante";
        $codigo_postal_tienda = "03150";
        $telefono_tienda = "123456789";

        //Recibir los datos del cliente
        $nombre_cliente = $nombre_cliente;
        $apellidos_cliente = $apellidos_cliente;
        $direccion_cliente = $direccion_cliente;
        $provincia_cliente = $provincia_cliente;
        $codigo_postal_cliente = $codigo_postal_cliente;


        //Recibir los datos de los productos

        $iva = "21";
        $gastos_de_envio = "0";
        $unidades = $cantidad;
        $productos = $nombre_producto;
        $precio_unidad = $precio_producto;

        //variable que guarda el nombre del archivo PDF
        $archivo = "factura-$id_factura.pdf";

        //Llamada al script fpdf
        require('fpdf183/fpdf.php');


        $archivo_de_salida = $archivo;

        $pdf = new FPDF();  //crea el objeto
        $pdf->AddPage();  //añadimos una página. Origen coordenadas, esquina superior izquierda, posición por defeto a 1 cm de los bordes.


        //logo de la tienda
        $pdf->Image('img/logo/logo-Omnis.png', 0, 0, 40, 40, 'PNG');

        // Encabezado de la factura
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 10, "FACTURA", 0, 2, "C");
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->MultiCell(190, 5, "Número de factura: $id_factura" . "\n" . "Fecha: $fecha_factura", 0, "C", false);
        $pdf->Ln(2);

        // Datos de la tienda
        $pdf->SetFont('Arial', 'B', 12);
        $top_datos = 45;
        $pdf->SetXY(40, $top_datos);
        $pdf->Cell(190, 10, "Datos de la tienda:", 0, 2, "J");
        $pdf->SetFont('Arial', '', 9);
        $pdf->MultiCell(
            190, //posición X
            5, //posición Y
            $nombre_tienda . "\n" .
                "Dirección: " . $direccion_tienda . "\n" .
                "Provincia: " . $provincia_tienda . "\n" .
                "Código Postal: " . $codigo_postal_tienda . "\n" .
                "Teléfono: " . $telefono_tienda . "\n",
            0, // bordes 0 = no | 1 = si
            "J", // texto justificado 
            false
        );


        // Datos del cliente
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(125, $top_datos);
        $pdf->Cell(190, 10, "Datos del cliente:", 0, 2, "J");
        $pdf->SetFont('Arial', '', 9);
        $pdf->MultiCell(
            190, //posición X
            5, //posicion Y
            "Nombre: " . $nombre_cliente . "\n" .
                "Apellidos: " . $apellidos_cliente . "\n" .
                "Dirección: " . $direccion_cliente . "\n" .
                "Provincia: " . $provincia_cliente . "\n" .
                "Código Postal: " . $codigo_postal_cliente . "\n",
            0, // bordes 0 = no | 1 = si
            "J", // texto justificado
            false
        );

        //Salto de línea
        $pdf->Ln(2);



        // extracción de los datos de los productos a través de la función explode
        $e_productos = explode(",", $productos);
        $e_unidades = explode(",", $unidades);
        $e_precio_unidad = explode(",", $precio_unidad);

        //Creación de la tabla de los detalles de los productos productos
        $top_productos = 110;
        $pdf->SetXY(45, $top_productos);
        $pdf->Cell(40, 5, 'UNIDADES', 0, 1, 'C');
        $pdf->SetXY(80, $top_productos);
        $pdf->Cell(40, 5, 'PRODUCTOS', 0, 1, 'C');
        $pdf->SetXY(115, $top_productos);
        $pdf->Cell(40, 5, 'PRECIO UNIDAD', 0, 1, 'C');

        $precio_subtotal = 0; // variable para almacenar el subtotal
        $y = 115; // variable para la posición top desde la cual se empezarán a agregar los datos
        $x = 0;
        while ($x <= count($e_productos) - 1) {
            $pdf->SetFont('Arial', '', 8);

            $pdf->SetXY(45, $y);
            $pdf->Cell(40, 5, $e_unidades[$x], 0, 1, 'C');
            $pdf->SetXY(80, $y);
            $pdf->Cell(40, 5, $e_productos[$x], 0, 1, 'C');
            $pdf->SetXY(115, $y);
            $pdf->Cell(40, 5, $e_precio_unidad[$x] . " euros", 0, 1, 'C');

            //Cálculo del subtotal  
            $precio_subtotal += $e_precio_unidad[$x] * $e_unidades[$x];
            $x++;

            // aumento del top 5 cm
            $y = $y + 5;
        }

        //Cálculo del Impuesto
        $add_iva = $precio_subtotal * $iva / 100;

        //Cálculo del precio total
        $total_mas_iva = round($precio_subtotal + $add_iva + $gastos_de_envio, 2);

        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 5, "Gastos de envío: Incluido", 0, 1, "C");
        $pdf->Cell(190, 5, "I.V.A: Incluido", 0, 1, "C");
        $pdf->Cell(190, 5, "TOTAL:" . $precio_subtotal . " euros", 0, 1, "C");
        //$pdf->Cell(190, 5, "TOTAL: ".$total_mas_iva." €", 0, 1, "C");


        $pdf->Output('I', $archivo_de_salida); //cierra el objeto pdf

        //Creacion de las cabeceras que generarán el archivo pdf
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=$archivo");
        header("Content-Length: " . filesize("$archivo"));
        $fp = fopen($archivo, "r");
        fpassthru($fp);
        fclose($fp);

        //Eliminación del archivo en el servidor
        unlink($archivo);
    }
}
