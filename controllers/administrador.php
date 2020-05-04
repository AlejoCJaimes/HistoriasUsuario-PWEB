<?php

require_once 'libs/session.php';
require_once 'libs/database.php';
require_once 'helpers/Encriptar.php';
require_once 'helpers/Util.php';

class Administrador extends Controller{

private $session;
private $correo;
    function __construct(){

        parent::__construct();
        $this->session = new Session();
        $this->session->init();
        if ($this->session->getStatus() === 1 || empty($this->session->get('correo_usuario')) || $this->session->getCurrentRolUser() != 1) {
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
        $this->view->correo = "";
        $this->view->id_correo = "";
        $this->view->cabecera = "";
        $this->view->validacion = "";
        $this->view->_usuarios = [];
        //retorna los datos para el update del administrador;
        $this->view->administrador = [];

        //retorna los datos para el update del docente;
        $this->view->docente = [];

        //retorna los datos para el update del estudiante;
        $this->view->estudiante = [];

        $this->view->datos_perfil = [];
        $this->view->respuesta = "";
        $this->view->confirmacion = "";



        //echo "<p>Nuevo controlador Main</p>";
    }

    function render() {
        $cabecera = "Inicio";
        $this->view->cabecera = $cabecera;
        $this->view->render('administrador/index');


    }


    function usuarios() {
      $cabecera = "";
      $cabecera = "Usuarios";
      $correo = $this->session->getCurrentUser();
      $this->view->correo = $correo;
      $this->view->cabecera = $cabecera;
      $_usuarios = $this->model->loadUsuarios($correo);
      $this->view->_usuarios = $_usuarios;
      $this->view->render('administrador/usuarios');

    }

    function detalleGeneral($param = null) {

        $correo = $param[0];

        ///statement redirect for rol
          // devolver rol..
            //statement return basic Data _SESSION INFOR & Anottations for validations
            $this->db = new Database();
            $query_2 = $this->db->connect()->query("SELECT IdRol FROM rolusuario JOIN usuario ON rolusuario.IdUsuario = usuario.Id WHERE usuario.correo_usuario = '$correo' Limit 1; ");

            while($row = $query_2->fetch()){
                $Idrol = $row['IdRol'];

            }
            switch ($Idrol) {
              case 1:
                $this->detalleAdministrador($correo);
                break;
              case 2:
                $this->detalleDocente($correo);
              break;

              case 3:
                $this->detalleEstudiante($correo);
              default:
                // code...
                break;
            }

    }

    function detalleAdministrador($correo){
      //WORKING 14/04/2020 4:09PM LINE 100
      $idUsuario = $correo;
      $administrador = $this->model->getById($idUsuario);
      $datos_perfil = $this->model->loadPerfil($correo);
      $this->view->datos_perfil = $datos_perfil;
      $this->view->mensaje = "";
      $this->view->administrador = $administrador;
      $this->view->render('administrador/detalleAdministrador');
    }

    function detalleDocente($correo){
      $idUsuario = $correo;
      $docente = $this->model->getById($idUsuario);
      $datos_perfil = $this->model->loadDocente($correo);
      $this->view->datos_perfil = $datos_perfil;
      $this->view->mensaje = "";
      $this->view->docente = $docente;
      $this->view->render('administrador/detalleDocente');
    }

    function detalleEstudiante($correo){
      $idUsuario = $correo;
      $estudiante = $this->model->getById($idUsuario);
      $datos_perfil = $this->model->loadEstudiante($correo);
      $this->view->datos_perfil = $datos_perfil;
      $this->view->mensaje = "";
      $this->view->estudiante = $estudiante;
      $this->view->render('administrador/detalleEstudiante');
    }


    function perfil () {
      $cabecera = "";
      $cabecera = "Perfil";
      $this->view->cabecera = $cabecera;
      $id_correo = $this->session->getCurrentUser();
      $datos_perfil = $this->model->loadPerfil($id_correo);
      $this->view->datos_perfil = $datos_perfil;
      $this->view->render('administrador/perfil');
    }

    function register_admin() {
      $this->view->render('administrador/register');
    }

    function clave() {
      $cabecera = "";
      $cabecera = "Ajustes";
      $this->view->cabecera = $cabecera;
      $this->view->render('administrador/changeClave');

    }


    function actualizarEstudiante() {

      $rconfirmacion = "";
      $nombre = $_POST['NombreEstudiante'];
      $apellido = $_POST['ApellidoEstudiante'];
      $cedula = $_POST['CedulaEstudiante'];
      $cedula = formatoNumeroDocumento($cedula);
      $programa = $_POST['CodigoPrograma'];
      $semestre = $_POST['NumeroSemestre'];
      $tipo_documento = $_POST['IdTipoDocumento'];

      $correo = $_POST['correo_usuario'];

      if ($this->model->updateEstudiante(['NombreEstudiante' => $nombre,'NumeroSemestre' =>$semestre,'CodigoPrograma' =>$programa, 'ApellidoEstudiante' => $apellido, 'CedulaEstudiante' => $cedula, 'IdTipoDocumento' => $tipo_documento, 'correo_usuario' => $correo])) {
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
      $this->detalleEstudiante($correo);


    }
    //Actualiza -> tipo, docu, nombre, apellido, titulo
    function actualizarDocente() {

      $confirmacion = "";
      $nombre = $_POST['NombreDocente'];
      $apellido = $_POST['ApellidoDocente'];
      $cedula = $_POST['CedulaDocente'];
      $cedula = formatoNumeroDocumento($cedula);
      $tipo_documento = $_POST['IdTipoDocumento'];
      $titulo = $_POST['TituloDocente'];
      $correo = $_POST['correo_usuario'];

      if ($this->model->updateDocente(['NombreDocente' => $nombre,'ApellidoDocente' => $apellido,'TituloDocente' => $titulo , 'CedulaDocente' => $cedula, 'IdTipoDocumento' => $tipo_documento, 'correo_usuario' => $correo])) {
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
      $this->detalleDocente($correo);


    }

    function actualizarEstado() {
      require_once 'models/Users.php';
      $respuesta = "";
      $correo = $_POST['correo_usuario'];
      $estado = $_POST['estado'];
      $rol = $_POST['rol'];
      if($this->model->update(['correo' => $correo, 'estado' => $estado])){
        
         //Actualizar estado exito
         $respuesta =  '<div class="alert alert-success" role="alert" > Datos actualizados con éxito!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div> ';
          switch ($rol) {
                case 1:
                $this->view->respuesta = $respuesta;
                $this->detalleAdministrador($correo);
                break; 
                                              
                case 2:
                $this->view->respuesta = $respuesta;
                $this->detalleDocente($correo);
              
                break;
            
                case 3:
                $this->view->respuesta = $respuesta;
                $this->detalleEstudiante($correo);
                break;
            
               default:
          }
        
      }else{
        //Mensaje de error
        $respuesta =  '<div class="alert alert-success" role="alert" > <strong>¡Algo salío mal :( )!<strong> Los datos no puedieron actualizarse correctamente.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
        
        switch ($rol) {
          case 1:
          $this->view->respuesta = $respuesta;
          $this->detalleAdministrador($correo);
          break; 
                                        
          case 2:
          $this->view->respuesta = $respuesta;
          $this->detalleDocente($correo);
        
          break;
      
          case 3:
          $this->view->respuesta = $respuesta;
          $this->detalleEstudiante($correo);
          break;
      
         default:
    }
      }
     /* $this->view->respuesta = $respuesta;
      $this->usuarios();*/
    }

    function eliminarUsuario($param = null){
      $respuesta = "";
      $correo = $param[0];

      if($this->model->delete(['correo' => $correo])){
        $respuesta = '<div class="alert alert-success" role="alert" > Usuario eliminado correctamente
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      }else{
        $respuesta = '<div class="alert alert-danger" role="alert" > Usuario NO eliminado
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>

        </div> ';
      }
      $this->view->respuesta = $respuesta;
      $this->usuarios();
    }



    function validar() {

          $validacion = "";

          $tipo_documento = $_POST['idTipoDocumento'];
          $cedula = $_POST['cedulaAdmin'];
          $nombre = $_POST['NombreAdmin'];
          $apellido = $_POST['ApellidoAdmin'];



        if ($cedula == "" && $nombre == "" && $apellido == "" ) {
          $validacion = '<div class="alert alert-warning" role="alert" > No se pueden guardar datos vacios.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>

          </div> ';
        } else {
          if ($cedula == "" || $nombre == "" || $apellido == "" ) {

              $validacion = '<div class="alert alert-warning" role="alert" ><strong>¡Lo sentimos!</strong> No todos los datos están completos.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>

              </div> ';
          } else {
              $this->EditarPerfil();

        }


        $this->view->validacion = $validacion;
        $this->perfil();
    }


    }

    function addAdmin() {

      $validacion = "";
      //recepcion de variables por metodo POST para el docente

      $tipo_documento = $_POST['IdTipoDocumento'];
      $numero_documento = $_POST['CedulaAdmin'];
      $nombre = $_POST['NombreAdmin'];
      $apellido = $_POST['ApellidoAdmin'];
      $numero_documento = formatoNumeroDocumento($numero_documento);
      //recepcion de variables para el usuario
      $correo_usuario = $_POST['correo_usuario'];
      $clave_usuario = $_POST['clave_usuario'];
      $clave_usuario = encriptar($clave_usuario);

      if ($this->model->insert(['correo_usuario'=>$correo_usuario, 'clave_usuario'=>$clave_usuario])) {


                  //insercion para el Docente
              if ($this->model->insertAdministrador(['correo_usuario'=>$correo_usuario, 'IdTipoDocumento' => $tipo_documento, 'CedulaAdmin' => $numero_documento, 'NombreAdmin' => $nombre, 'ApellidoAdmin' => $apellido])) {
                // code...

                $validacion= '<p style="color: #3DB57D"> ¡Usuario registrado con éxito!. </p>';


              } else {

                $validacion= '<p style="color: red"> El Administrador con  <strong>'.$nombre." ".$apellido." ".'</strong> ya se encuentra registrado. '.'</p>';
              }



        } else {
            $validacion= '<p style="color: red"> El Usuario con correo <strong>'.$correo_usuario.'</strong> ya se encuentra registrado. '.'</p>';
        }

      $this->view->validacion= $validacion;
      $this->register_admin();

      echo '<script>
       setTimeout(function(){
       window.location="http://localhost/HistoriasUsuario-PWEB/administrador/usuarios"
     }, 3000);
       </script>';
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

    function EditarAdmin() {

      $confirmacion = "";
      $nombre = $_POST['NombreAdmin'];
      $apellido = $_POST['ApellidoAdmin'];
      $cedula = $_POST['CedulaAdmin'];
      $cedula = formatoNumeroDocumento($cedula);
      $tipo_documento = $_POST['IdTipoDocumento'];

      $correo = $_POST['correo_usuario'];

      if ($this->model->updatePerfil(['NombreAdmin' => $nombre, 'ApellidoAdmin' => $apellido, 'CedulaAdmin' => $cedula, 'IdTipoDocumento' => $tipo_documento, 'correo_usuario' => $correo])) {
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
      $this->detalleAdministrador($correo);


    }

    function EditarPerfil() {

      $confirmacion = "";
      $nombre = $_POST['NombreAdmin'];
      $apellido = $_POST['ApellidoAdmin'];
      $cedula = $_POST['CedulaAdmin'];
      $cedula = formatoNumeroDocumento($cedula);
      $tipo_documento = $_POST['IdTipoDocumento'];

      $correo = $_POST['correo_usuario'];

      if ($this->model->updatePerfil(['NombreAdmin' => $nombre, 'ApellidoAdmin' => $apellido, 'CedulaAdmin' => $cedula, 'IdTipoDocumento' => $tipo_documento, 'correo_usuario' => $correo])) {
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



}

?>