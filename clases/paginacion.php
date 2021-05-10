<?php

class Paginacion
{

    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;
    private $_busqueda;
    

    public function __construct($conn, $query)
    {

        $this->_conn = $conn;
        $this->_query = $query;

        $numero_filas = $this->_conn->query($this->_query);
        $this->_total = $numero_filas->num_rows;
    }
    
    public function get_busqueda()
    {
       return $this->_busqueda;
    }
    public function get_con()
    {
        return $this->_conn;
    }
    public function get_query()
    {
        return $this->_query;
    }
    public function set_busqueda($valor)
    {
       $this->_busqueda=$valor;
    }
    public function cambiar_query()
    {
        if (isset($this->_busqueda)) {

            $this->_query=$this->_query .= " WHERE nombre_producto like'%".$this->_busqueda."%'";
            $numero_filas = $this->_conn->query($this->_query);
            $this->_total = $numero_filas->num_rows;
        }
    }

    public function get_datos_productos($limit, $page)
    {

        $this->_limit  = $limit;
        $this->_page   = $page;


        if ($this->_limit == $this->_total) {
            $query      = $this->_query;
        } else {
            $query      = $this->_query . " LIMIT " . (($this->_page - 1) * $this->_limit) . ", $this->_limit";
        }

        $numero_filas   = $this->_conn->query($query);

        while ($row = $numero_filas->fetch_assoc()) {
            $results[]  = $row;
        }


        return $results;
    }
    
    public function createLinks($links)
    {
        if ($this->_limit == $this->_total) {
            return '';
        }

        $last       = ceil($this->_total / $this->_limit);

        $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
        $end      = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;


        if ($this->_page == 1) {

            $html       = '<li class="page-item disabled"><a aria-disable class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . ($this->_page - 1) . '">&laquo;</a></li>';
        } else {
            $html       = '<li><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . ($this->_page - 1) . '">&laquo;</a></li>';
        }

        if ($start > 1) {
            $html   .= '<li><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=1">1</a></li>';
            $html   .= '<li class="disabled"><span>...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($this->_page == $i) {
                $html   .= '<li class="page-item active"><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . $i . '">' . $i . '</a></li>';
            }else {
                $html   .= '<li><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . $i . '">' . $i . '</a></li>';
            }
           
           
        }

        if ($end < $last) {
            $html   .= '<li class="disabled"><span>...</span></li>';
            $html   .= '<li><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . $last . '">' . $last . '</a></li>';
        }

        if ($this->_page == $last) {

            $html       .= '<li class="page-item disabled"><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . ($this->_page + 1) . '">&raquo;</a></li>';
        } else {
            $html       .= '<li><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . ($this->_page + 1) . '">&raquo;</a></li>';
        }




        return $html;
    }
    
    

}
