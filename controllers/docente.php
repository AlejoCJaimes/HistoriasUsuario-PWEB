<?php
require_once 'libs/session.php';
require_once 'helpers/Encriptar.php';
class Docente extends Controller{

    function __construct(){
      parent::__construct();

      $this->session = new Session();

      $this->session->init();
      if ($this->session->getStatus() === 1 || empty($this->session->get('correo_usuario')) || $this->session->getCurrentRolUser() != 2) {
        exit('<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Error!</strong> Acceso denegado, por favor iniciar sesión.
        </div>". "<script>
         setTimeout(function(){
         window.location="http://localhost/HistoriasUsuario-PWEB/account"}, 1000);
         </script>"

          ');

      }
      $this->view->mensaje= $this->session->getCurrentUser();
      $this->view->datos_perfil = [];
      $this->view->id_correo = "";
      $this->view->confirmacion = "";

        //echo "<p>Nuevo controlador Main</p>";
    }

    function render() {

        $this->view->render('docente/index');

    }

    function perfil () {

      $id_correo = $this->session->getCurrentUser();
      $datos_perfil = $this->model->loadPerfil($id_correo);
      $this->view->datos_perfil = $datos_perfil;
      $this->view->render('docente/perfil');
    }


    function EditarPerfil() {

      $confirmacion = "";
      $nombre = $_POST['NombreDocente'];
      $apellido = $_POST['ApellidoDocente'];
      $cedula = $_POST['CedulaDocente'];


      if ($this->model->updatePerfil(['NombreDocente' => $nombre, 'ApellidoDocente' => $apellido, 'CedulaDocente' => $cedula])) {
        // code...
        $confirmacion = '<div class="alert alert-info" role="alert" ><strong>¡Oye!</strong>Tus datos se actualizaron correctamente.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      } else {
        $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> sus datos no pudieron ser actualizados.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';

      }

      $this->view->confirmacion = $confirmacion;
      $this->perfil();


    }
    function clave() {

        $this->view->render('docente/changeClave');

    }


    function ActualizarClave() {

      $confirmacion = "";
      $id_correo = $this->session->getCurrentUser();
      $confirmar_clave = $_POST['confirmar_clave'];
      $clave = $_POST['clave_usuario'];
      if ($clave != $confirmar_clave) {
        $confirmacion = '<div class="alert alert-warning" role="alert" ><strong>¡Ups!</strong> Las contraseñas no coinciden.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>

        </div> ';
      } else {
        $clave = encriptar($clave);
        if ($this->model->updateClave(['clave_usuario' => $clave, 'correo_usuario' => $id_correo ])) {
          $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Correcto!</strong> Su contraseña ha sido actualizada correctamente.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>

          </div> ';
        } else {
          $confirmacion = '<div class="alert alert-danger" role="alert" ><strong>¡Lo sentimos!</strong> Ha ocurrido un error inesperado.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>

          </div> ';
        }

      }


      $this->view->confirmacion = $confirmacion;
      $this->clave();

    }

/* CONTROLADOR VISTA PROYECTO.PHP*/
      function Proyecto(){
        $this->view->render('docente/proyecto');
      }

      function crearProyecto(){
        $this->view->render('docente/crearProyecto');
      }

      function detallesProyecto(){
        $this->view->render('docente/detallesProyecto');
      }

/* CONTROLADOR VISTA METOLOGIA.PHP*/

      function Metodologia(){
        $this->view->render('docente/metodologia');
      }

      function crearMetodologia(){
        $this->view->render('docente/crearMetodologia');
      }

      function detallesMetodologia(){
        $this->view->render('docente/detallesMetodologia');
      }

/* CONTROLADOR VISTA METOLOGIA.PHP*/
      function Grupo(){
        $this->view->render('docente/grupo');
      }

      function crearGrupo(){
        $this->view->render('docente/crearGrupo');
      }


}

?>
