
<?php
require_once 'controllers/home.php';
require_once 'helpers/Encriptar.php';
require_once 'libs/session.php';

class Usuario extends Controller{
private $session;
        function __construct(){
            parent::__construct();
            $this->view->mensaje= "";
            $this->session = new Session();
            $this->session->init();
            //$this->view->usuarios = [];

            //$this->view->render('Usuario/login');
            //$this->view->render('Account/register');
            //echo "<p>Nuevo controlador Main</p>";
        }

        function render(){
            /*$usuario = $this->model->get();
            $this->view->usuarios = $usuario;*/

            $this->view->render('Usuario/register');

        }

        function register_docente() {

            $this->view->render('Usuario/docente');
        }

        function register_student() {

          $this->view->render('Usuario/estudiante');
        }

        function addEstudiante() {
          $estado = 0;
          $mensaje = "";
          //recepcion de variables por metodo POST para el estudiante

          $tipo_documento = $_POST['IdTipoDocumento'];
          $numero_documento = $_POST['CedulaEstudiante'];
          $nombre = $_POST['NombreEstudiante'];
          $apellido = $_POST['ApellidoEstudiante'];
          $programa = $_POST['CodigoPrograma'];
          $numero_semestre = $_POST['NumeroSemestre'];

          //recepcion de variables para el usuario
          $correo_usuario = $_POST['correo_usuario'];
          $clave_usuario = $_POST['clave_usuario'];
          $confirmacion_clave = $_POST['confirmacion_clave'];
          $clave_usuario = encriptar($clave_usuario);

          $rol = "Estudiante";

          if ($this->model->insert(['correo_usuario'=>$correo_usuario, 'clave_usuario'=>$clave_usuario,'rol'=>$rol])) {
                    //insercion para el estudiante
                if ($this->model->insertEstudiante(['correo_usuario'=>$correo_usuario, 'IdTipoDocumento' => $tipo_documento, 'CedulaEstudiante' => $numero_documento, 'NombreEstudiante' => $nombre, 'ApellidoEstudiante' => $apellido, 'CodigoPrograma' => $programa, 'NumeroSemestre' => $numero_semestre])) {
                  // code...

                  $mensaje= '<p style="color: #3DB57D"> ¡Usuario registrado con éxito!. </p>';
                  $estado = 1;

                } else {
                  $mensaje= '<p style="color: red"> El estudiante <strong>'.$nombre." ".$apellido." ".'</strong> ya se encuentra registrado. '.'</p>';
                }



          } else {

            $mensaje= '<p style="color: red"> El Usuario con correo <strong>'.$correo_usuario.'</strong> ya se encuentra registrado. '.'</p>';

          }
          $this->view->mensaje = $mensaje;
          $this->register_student();

          if ($estado == 1) {
          
            $var = $this->session->getCurrentRolUser();
              if ($var == 1) {
                  echo '<script>
                  setTimeout(function(){
                  window.location="http://localhost/HistoriasUsuario-PWEB/administrador/usuarios"
                }, 7000);
                  </script>';
               
             } else{
                 
                  echo '<script>
                  setTimeout(function(){
                  window.location="http://localhost/HistoriasUsuario-PWEB/"
                }, 7000);
                  </script>';
                 
              }
              
           } else {
             $this->view->mensaje = $mensaje;
           }

        }

        function addDocente() {
          $estado = 0;
          $mensaje = "";
          //recepcion de variables por metodo POST para el docente

          $tipo_documento = $_POST['IdTipoDocumento'];
          $numero_documento = $_POST['CedulaDocente'];
          $nombre = $_POST['NombreDocente'];
          $apellido = $_POST['ApellidoDocente'];
          $titulo = $_POST['TituloDocente'];
          //recepcion de variables para el usuario
          $correo_usuario = $_POST['correo_usuario'];
          $clave_usuario = $_POST['clave_usuario'];
          $clave_usuario = encriptar($clave_usuario);
          $rol = "Docente";

          if ($this->model->insert(['correo_usuario'=>$correo_usuario, 'clave_usuario'=>$clave_usuario,'rol'=>$rol])) {
                      //insercion para el Docente
                  if ($this->model->insertDocente(['correo_usuario'=>$correo_usuario, 'IdTipoDocumento' => $tipo_documento, 'CedulaDocente' => $numero_documento, 'NombreDocente' => $nombre, 'ApellidoDocente' => $apellido, 'TituloDocente' => $titulo])) {
                    // code...
                    $estado = 1;
                    $mensaje= '<p style="color: #3DB57D"> ¡Usuario registrado con éxito!. </p>';

                  } else {

                    $mensaje= '<p style="color: red"> El Docente <strong>'.$nombre." ".$apellido." ".'</strong> ya se encuentra registrado. '.'</p>';
                  }

            } else {
              
               $mensaje= '<p style="color: red"> El Usuario con correo <strong>'.$correo_usuario.'</strong> ya se encuentra registrado. '.'</p>';
               
            }

            $this->view->mensaje = $mensaje;
            $this->register_docente();

          //validacion para redireccionamiento.
         
         if ($estado == 1) {
          
          $var = $this->session->getCurrentRolUser();
            if ($var == 1) {
                echo '<script>
                setTimeout(function(){
                window.location="http://localhost/HistoriasUsuario-PWEB/administrador/usuarios"
              }, 7000);
                </script>';
             
           } else{
               
                echo '<script>
                setTimeout(function(){
                window.location="http://localhost/HistoriasUsuario-PWEB/"
              }, 7000);
                </script>';
               
            }
            
         } else {
           $this->view->mensaje = $mensaje;
         }      
           
        }
}

?>
