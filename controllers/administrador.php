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

        //variables auxiliares para los módulos de estados y programas.
        $this->view->estados = [];
        $this->view->programas = [];

        //variables de conteo para popoup en index
        $this->view->num_usuarios = 0;
        $this->view->num_programas = 0;
        $this->view->num_estados = 0;



        //echo "<p>Nuevo controlador Main</p>";
    }

    function render() {
      //cabecera
      $cabecera = "Inicio";
      
      //consultas
      $num_usuarios= $this->model->cargarUsuariosIndex();
      $this->view->num_usuarios = $num_usuarios;

      $num_programas= $this->model->cargarProgramaIndex();
      $this->view->num_programas = $num_programas;

      $num_estados= $this->model->cargarEstadosIndex();
      $this->view->num_estados = $num_estados;

      
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
    function actualizarBull($param = null) {
      $correo = $param[0];
      $estado = $param[1];
      $respuesta = "";
      if($this->model->updateBull(['correo' => $correo, 'estado' => $estado])) {
        /*$respuesta =  '<div class="alert alert-info" role="alert" > Estado actualizado correctamente!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div> ';*/
      } else {
        $respuesta =  '<div class="alert alert-danger" role="alert" > No se pudo actualizar el estado del usuario'.$correo.'!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div> ';
      }
      $this->view->respuesta = $respuesta;
      $this->usuarios();

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
        if ($clave!=""){
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
        else {
          $confirmacion = '<div class="alert alert-info" role="alert" ><strong>¡Hey!</strong> No se han hecho cambios, escribe una nueva contraseña.
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
    ////////////////////////////////
    //INICIO ACCIONES PARA PROGRAMA
    ///////////////////////////////
    function Programa() {
     
      //Instancia de la base de datos
      $this->db = new Database();
      //variables auxiliares y cabecera
      $cabecera = "";
      $cabecera = "Programa";
      $programas = [];
      
      //Cargar los programas ya existentes en la base de datos
      $query_programas = $this->db->connect()->query("SELECT * from programa ORDER BY Nombre");
      $programas = $query_programas->fetchAll();

      //retorno de vistas y variables

      $this->view->programas = $programas;
      $this->view->cabecera = $cabecera;
      $this->view->render("administrador/programas/index");
    }

    function addPrograma() {

      //confirmacion
      $confirmacion = "";

      //recepcion por método POST
      $codigo = $_POST['codigo'];
      $programa= $_POST['programa'];

      if ($this->model->insertPrograma(['codigo' => $codigo, 'programa' => $programa])) {
        // code...
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong>Programa creado con éxito.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      } else {
        $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> El programa no se pudo crear.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      }

      $this->view->confirmacion = $confirmacion;
      $this->Programa();


    }

    function editPrograma() {

       //recepcion por método POST
       $codigo = $_POST['codigo'];
       $programa= $_POST['programa'];

       //confirmacion
       $confirmacion = "";

       //recepcion por método POST
       $programa= $_POST['programa'];
 
       if ($this->model->updatePrograma(['codigo' => $codigo, 'programa' => $programa])) {
         // code...
         $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong>Programa actualizado con éxito.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div> ';
       } else {
         $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> El programa no se pudo actualizar.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div> ';
       }
 
       $this->view->confirmacion = $confirmacion;
       $this->Programa();

    }

    function eliminar_programa($param= null) {

      $codigo = $param[0];
       //confirmacion
       $confirmacion = "";

       //recepcion por método POST
 
       if ($this->model->deletePrograma(['codigo' => $codigo])) {
         // code...
         $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong>Programa eliminado con éxito.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div> ';
       } else {
         $confirmacion = '<div class="alert alert-info" role="alert" > <strong> ¡Lo sentimos! </strong> El programa no se pudo eliminar.
         porque este se encuentra en uso.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div> ';
       }
 
       $this->view->confirmacion = $confirmacion;
       $this->Programa();

    }

     ////////////////////////////////
    //FIN ACCIONES PARA PROGRAMA
    ///////////////////////////////


    ////////////////////////////////
    //INICIO ACCIONES PARA ESTADO
    ///////////////////////////////
    function Estado() {
     
      //Instancia de la base de datos
      $this->db = new Database();
      //variables auxiliares y cabecera
      $cabecera = "";
      $cabecera = "Estado";
      $estados = [];
      
      //Cargar los estados ya existentes en la base de datos
      $query_estados = $this->db->connect()->query("SELECT * from estado ORDER BY Id");
      $estados = $query_estados->fetchAll();

      //retorno de vistas y variables

      $this->view->estados = $estados;
      $this->view->cabecera = $cabecera;
      $this->view->render("administrador/estados/index");
    }

    function addEstado() {

      //confirmacion
      $confirmacion = "";

      //recepcion por método POST
      $estado= $_POST['estado'];

      if ($this->model->insertEstado(['estado' => $estado])) {
        // code...
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong>Estado creado con éxito.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      } else {
        $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> El Estado no se pudo crear.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      }

      $this->view->confirmacion = $confirmacion;
      $this->Estado();


    }

    function editEstado() {

       //recepcion por método POST
       $id = $_POST['Id'];
       $estado= $_POST['estado'];
       //confirmacion
       $confirmacion = "";

       //recepcion por método POST
 
       if ($this->model->updateEstado(['Id' => $id, 'estado' => $estado])) {
         // code...
         $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong>Estado actualizado con éxito.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div> ';
       } else {
         $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> El estado no se pudo actualizar.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div> ';
       }
 
       $this->view->confirmacion = $confirmacion;
       $this->Estado();

    }

    function eliminar_estado($param= null) {

      $id = $param[0];
       //confirmacion
       $confirmacion = "";

       //recepcion por método POST
 
       if ($this->model->deleteEstado(['Id' => $id])) {
         // code...
         $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong>Estado eliminado con éxito.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div> ';
       } else {
         $confirmacion = '<div class="alert alert-info" role="alert" > <strong> ¡Lo sentimos! </strong> El Estado no se pudo eliminar.
         porque este se encuentra en uso.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div> ';
       }
 
       $this->view->confirmacion = $confirmacion;
       $this->Estado();

    }


    ////////////////////////////////
    //FIN ACCIONES PARA ESTADO
    ///////////////////////////////


}

?>