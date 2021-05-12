<?php

class Paginacion
{

    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;
    private $_busqueda;
    private $_abc;
    private $_menorMayor;
    

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
    public function cambiar_query2($query2)
    {
        
            $this->_abc=$query2;
            $this->_query=$this->_query .= " $query2";
           
    }

    public function cambiar_query3($query3)
    {
        
            $this->_menorMayor=$query3;
            $this->_query=$this->_query .= " $query3";
            
       
    }

    public function get_datos_productos($limit, $page)
    {
        
        $limit=intval($limit);
        $page=intval($page);

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

            $html       = '<li class="page-item disabled"><a aria-disable class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . ($this->_page - 1) .'&c1='. $this->_abc.'&c2='.$this->_menorMayor.' ">&laquo;</a></li>';
        } else {
            $html       = '<li><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . ($this->_page - 1) . '&c1='. $this->_abc.'&c2='.$this->_menorMayor.'">&laquo;</a></li>';
        }

        if ($start > 1) {
            $html   .= '<li><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=1'.'&c1='. $this->_abc.'&c2='.$this->_menorMayor.'">1</a></li>';
            $html   .= '<li class="disabled"><span>...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($this->_page == $i) {
                $html   .= '<li class="page-item active"><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . $i . '&c1='. $this->_abc.'&c2='.$this->_menorMayor.'">' . $i . '</a></li>';
            }else {
                $html   .= '<li><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . $i . '&c1='. $this->_abc.'&c2='.$this->_menorMayor.'">' . $i . '</a></li>';
            }
           
           
        }

        if ($end < $last) {
            $html   .= '<li class="disabled"><span>...</span></li>';
            $html   .= '<li><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . $last . '&c1='. $this->_abc.'&c2='.$this->_menorMayor.'">' . $last . '</a></li>';
        }

        if ($this->_page == $last) {

            $html       .= '<li class="page-item disabled"><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . ($this->_page + 1) . '&c1='. $this->_abc.'&c2='.$this->_menorMayor.'">&raquo;</a></li>';
        } else {
            $html       .= '<li><a class="page-link" href="?producto_buscar='.$this->_busqueda.'&limit=' . $this->_limit . '&page=' . ($this->_page + 1) .'&c1='. $this->_abc.'&c2='.$this->_menorMayor.'">&raquo;</a></li>';
        }




        return $html;
    }
    
    

}
