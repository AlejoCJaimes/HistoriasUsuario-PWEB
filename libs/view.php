<?php

class View {

    function __construct() {
        //echo"<p> Vista Base</p>";
        
    }

    function render($nombre) {
        require 'views/'.$nombre. '.php';
    }

    function home() {
        require 'views/home/index.php';
    }
}

?>