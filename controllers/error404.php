<?php

class Error404 extends Controller{

    function __construct(){
        parent:: __construct();
        $this->view->mensaje = "Hubo un error en la solicitud o no existe la página ";
        $this->view->render('error/error404');
        //echo "<p>Error al cargar recurso</p>";
    }
}

?>