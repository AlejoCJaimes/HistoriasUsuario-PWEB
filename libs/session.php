<?php

class Session{

    public function __construct(){

    }
    public function init() {
      session_start();
    }

    public function setCurrentUser($key,$user){
        $_SESSION[$key] = $user;
    }

    public function getCurrentUser(){
        return $_SESSION['correo_usuario'];
    }

    public function setCurrentRolUser($key,$rol){
         $_SESSION[$key] = $rol;
    }

    public function getCurrentRolUser(){
        return $_SESSION['IdRol'];
    }

    public function setCurrentStatus($key,$_status){
         $_SESSION[$key] = $_status;
    }

    public function getCurrentStatus(){

        return $_SESSION['_status'];
        //return "Pendiente";
    }


    public function closeSession(){
        session_unset();
        session_destroy();
    }

    public function get($key)
    {
      return !empty($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function getStatus()
    {
      return session_status();
    }
}


?>
