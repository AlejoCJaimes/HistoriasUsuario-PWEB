<?php

class Model {

    //application logic ->cada modelo tiene una conexión a la base de datos.
    function __construct() {
        $this->db = new Database();
        
    }
}

?>