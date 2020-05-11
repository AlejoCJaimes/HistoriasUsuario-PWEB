<?php
require_once 'libs/session.php';
require_once 'helpers/Encriptar.php';
class Docente extends Controller{

    function __construct(){
      parent::__construct();
      $this->view->mensaje= "";

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
      $this->view->confirmacion_modal = "";
      $this->view->cabecera = "";
      $this->view->metodologias = [];
      $this->view->grupos = [];
      $this->view->fuentes = [];
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render() {
        $cabecera = "Inicio";
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/index');
    }

    function perfil () {
      $cabecera = "";
      $cabecera = "Perfil";
      $this->view->cabecera = $cabecera;
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
      $cabecera = "";
      $cabecera = "Ajustes";
      $this->view->cabecera = $cabecera;
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
        $cabecera = "";
        $cabecera = "Proyecto";
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/proyecto');
      }

      function crearProyecto(){
        $cabecera = "";
        $cabecera = "Proyecto";
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/crearProyecto');
      }

      function detallesProyecto(){
        $cabecera = "";
        $cabecera = "Proyecto";
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/detallesProyecto');
      }

        ///////////////////////////
       // MÉTODOS PARA METODOLOGIA
       //////////////////////////

      function Metodologia(){
        
        $cabecera = "";
        $cabecera = "Metodología";
        $this->view->cabecera = $cabecera;
        //cargar metodologias
        $metodologias = $this->model->loadMetodologias();
        $this->view->metodologias = $metodologias;
        //var_dump($metodologias);
        
        $this->view->render('docente/metodologia');
      }

      function crearMetodologia(){
        $cabecera = "";
        $cabecera = "Metodología";
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/crearMetodologia');
      }
      function detalleGeneral($param = null){
      $id = $param [0];
      $this->detallesMetodologia($id);
    
      }
      function detallesMetodologia($id){
        $cabecera = "";
        $cabecera = "Metodología";
        $this->view->cabecera = $cabecera;
        $metodologias = [];
        $metodologias = $this->model->getByIdMetodologia($id);
        $fuentes = [];
        $fuentes = $this->model->getByIdFuentes($id);
        $this->view->metodologias = $metodologias;
        $this->view->fuentes = $fuentes;
        $this->view->render('docente/detallesMetodologia');
      }
       
       function addMetodologia(){
        $confirmacion = "";

        $nombreMetodologia = $_POST['nombreMetodologia'];
        $descripcionMetodologia = $_POST['descripcionMetodologia'];
        $fuente = $_POST['fuente'];
        
        if ($this->model->insertarMetodologia(['nombre'=>$nombreMetodologia, 'descripcion'=>$descripcionMetodologia, 'fuente' => $fuente])) {
          $confirmacion = '<div class="alert alert-info" role="alert" ><strong>¡Oye!</strong> se creó la metodología.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';

      
        } else {

          $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> la metodología NO se creó.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';

        }
        $this->view->confirmacion = $confirmacion;
        $this->crearMetodologia();

      }
      function actualizarMetodologia() {

        $confirmacion = "";
        $nombreMetodologia = $_POST['nombreMetodologia'];
        $descripcionMetodologia = $_POST['descripcionMetodologia'];
        $fuente = $_POST['fuente'];
        $cant_fuentes = count($fuente);
        $id = $_POST['id']; 
        $longitud = $_POST['longitud'];
        $IdMetodologias = [];
        
        //Definir si se hace una insercion o una busqueda en las fuentes
        require_once 'libs/database.php';
        $this->db = new Database();
        $busqueda_id = $this->db->connect()->query("SELECT link from fuentes WHERE IdMetodologia = '$id' order by Id desc ");
        while($row_busqueda = $busqueda_id->fetch()) {
        array_push($IdMetodologias,$row_busqueda['link']);
        }
        
        if($cant_fuentes > $longitud) {
          $nuevas_fuentes= array_diff($fuente, $IdMetodologias);
          $cantida_nuevas_fuentes = count($nuevas_fuentes);
          /*for ($i=1; $i <=$cantida_nuevas_fuentes; $i++) { 
            
            echo '<br>'.$nuevas_fuentes[$i].'<br>';
          }*/
          if($this->model->update_Fuentes(['fuentes'=>$nuevas_fuentes, 'id' => $id])) {
            $confirmacion = '<div class="alert alert-info" role="alert" ><strong>¡Éxito!</strong> Se agregó <strong>'.$cantida_nuevas_fuentes.'</strong> nuevas fuentes!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';           
    
          
            } else {
    
            $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> No se puedieron crear las fuentes.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
    
            }
          
        } else {
          if ($this->model->updateMetodologia(['longitud'=>$longitud,'id' => $id,'nombreMetodologia'=>$nombreMetodologia, 'descripcionMetodologia'=>$descripcionMetodologia, 'fuente' => $fuente])) {
            $confirmacion = '<div class="alert alert-info" role="alert" ><strong>¡Éxito!</strong> Metodologia editada correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
    
          
            } else {
    
            $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> la metodología no se pudo editar.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
    
            }
        }
        
        
        $this->view->confirmacion = $confirmacion;
        $this->detallesMetodologia($id);

      }

      function eliminarFuente($param = null) {
        $id = $param[0];
        $id_fuente = $param[1];
        $num_fuentes  = 0;
        $confirmacion = "";
        $link = "";
        require_once 'libs/database.php';
        $this->db = new Database();
        
        $busqueda_id = $this->db->connect()->query("SELECT count(*) as num_fuentes from fuentes WHERE IdMetodologia = '$id' ");
          while($row_busqueda = $busqueda_id->fetch()) {
          $num_fuentes = $row_busqueda['num_fuentes'];
        }
        if ($num_fuentes > 1 ) {
          if ($this->model->eliminarFuentes(['id_fuente' => $id_fuente])) {
            
            $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> Se ha eliminado la fuente correctamente
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
          } else {
            $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> la fuente no se pudo editar.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div> ';
          }
        } else {
          $confirmacion = '<div class="alert alert-warning" role="alert" > <strong> ¡Lo sentimos! </strong> No se pueden eliminar todas las fuentes.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }
        
        
        $this->view->confirmacion = $confirmacion;
        $this->detallesMetodologia($id);
      }

      function eliminarMetodologia($param = null) {
        $confirmacion_modal = "";
        $idMetodologia = $param[0];
        if ($this->model->deleteMetodologia(['id' => $idMetodologia])) {
          $confirmacion_modal = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> Se ha eliminado la metodologia correctamente
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
          //$confirmacion_modal = "Eliminado con exito";
        } else {
          $confirmacion_modal = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> la metodologia correctamente.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }
        $this->view->confirmacion_modal = $confirmacion_modal;
        $this->Metodologia();
      }
      ///////////////////////////
       // MÉTODOS PARA GRUPOS
       //////////////////////////
      
      function agregarProyecto(){
        $nombreProyecto = $_POST['nombreProyecto'];
        $fechaFin = $_POST['fechaFin'];
        $idMetodologia = $_POST['idMetodologia'];
        $idEstado = $_POST['idEstado'];

        if($this->model->insertarProyecto(['nombreProyecto' => $nombreProyecto, 'fechaFin' => $fechaFin, 'idMetodologia' => $idMetodologia, 'idEstado' => $idEstado, 'correo' => $this->session->getCurrentUser()])){
          $confirmacion = '<div class="alert alert-info" role="alert" ><strong>¡Oye!</strong> se creó el proyecto.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }else{
          $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> el Proyecto NO se creó.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }
        $this->view->confirmacion = $confirmacion;
        $this->crearProyecto();
      }

/* CONTROLADOR VISTA METOLOGIA.PHP*/
      function Grupo(){
        $cabecera = "";
        $cabecera = "Grupo";
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/grupo');
      }

      function crearGrupo(){
        $cabecera = "";
        $cabecera = "Grupo";
        $confirmacion = "";
        $grupos = [];
        $grupos = $this->model->loadEstudiantes();
        //var_dump($grupos);
        $this->view->grupos = $grupos;
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/crearGrupo');
      }

      function detallesGrupo(){
        $cabecera = "";
        $cabecera = "Grupo";
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/detallesGrupo');
      }



     
}

?>