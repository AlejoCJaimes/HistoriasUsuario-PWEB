<?php
require_once 'libs/session.php';
require_once 'libs/database.php';
require_once 'helpers/Encriptar.php';
class Account extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->validacion= "";
        $this->session= new Session();
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render() {
        $this->view->render('account/login');
    }



    function login() {
        $validacion = "";

        $estado = "";
        //Recepcion de variables
        $rol = 0;
         $correo_usuario = $_POST['correo_usuario'];
         $clave_usuario = $_POST['clave_usuario'];
        $clave_usuario = encriptar($clave_usuario);

        //  if ($this->model->insert(['correo_usuario'=>$correo_usuario, 'clave_usuario'=>$clave_usuario,'rol'=>$rol])) {
        if ($this->model->validar_sesion(['correo_usuario'=>$correo_usuario, 'clave_usuario'=>$clave_usuario , $rol ])) {
          // devolver rol..
            //statement return basic Data _SESSION INFOR & Anottations for validations
            $this->db = new Database();
            $query_2 = $this->db->connect()->query("SELECT IdRol, _status FROM rolusuario JOIN usuario ON rolusuario.IdUsuario = usuario.Id WHERE usuario.correo_usuario = '$correo_usuario' Limit 1; ");

            while($row = $query_2->fetch()){
                $Idrol = $row['IdRol'];
                $_status = $row['_status'];

            }


            switch ($Idrol) {
              case 1:
              $this->session->init();
              $this->session->setCurrentUser('correo_usuario',$correo_usuario);
              $this->session->setCurrentRolUser('IdRol',$Idrol);
              $this->session->setCurrentStatus('_status', $_status);
              header('location: /HistoriasUsuario-PWEB/administrador');
                break;
              case 2:
              $this->session->init();
              $this->session->setCurrentUser('correo_usuario',$correo_usuario);
              $this->session->setCurrentRolUser('IdRol',$Idrol);
              $this->session->setCurrentStatus('_status', $_status);
              header('location: /HistoriasUsuario-PWEB/docente');
              break;

              case 3:

              $this->session->init();
              $this->session->setCurrentUser('correo_usuario',$correo_usuario);
              $this->session->setCurrentRolUser('IdRol',$Idrol);
              $this->session->setCurrentStatus('_status', $_status);
              header('location: /HistoriasUsuario-PWEB/estudiante');
              default:
                // code...
                break;
            }


        } else {
          $this->db = new Database();
          $query_3 = $this->db->connect()->query("SELECT _status FROM rolusuario JOIN usuario ON rolusuario.IdUsuario = usuario.Id WHERE usuario.correo_usuario = '$correo_usuario' ");

          while($row_3 = $query_3->fetch()){
              $_status = $row_3['_status'];

          }
          if ($_status == "Pendiente") {

              $validacion = "<div class='alert alert-info alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <strong>¡Validacion!</strong> El usuario ".$correo_usuario."  se encuentra en proceso de validacion, aún no ha sido activado.
              </div>";

        } elseif ($_status == "Suspendido") {
              $validacion = "<div class='alert alert-warning alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <strong>¡Suspensión!</strong> El usuario ".$correo_usuario."  se encuentra suspendido, por favor contactarse con el administrador.
              </div>";
        } elseif ($_status != "Pendiente") {

                $validacion = "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>¡Error!</strong> Usuario o contraseña incorrecta .
                </div>";
        }

        }


        $this->view->validacion = $validacion;
        $this->render();

    }

    function logout() {
      session_start ();
      session_destroy ();
      echo '<script>
       setTimeout(function(){
       window.location="http://localhost/HistoriasUsuario-PWEB/"
     }, 3000);
       </script>'. "su sesion ha finalizado";


    }

    //Comentario linea 121 de controlador account, by Alejo

}