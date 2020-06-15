<?php
require_once 'libs/session.php';
require_once 'helpers/Encriptar.php';
class Docente extends Controller{

    function __construct(){
      parent::__construct();
      $this->view->mensaje= "";
      $this->view->nombreGrupo = "";
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
      $this->view->datos_grupo = [];
      $this->view->estados = [];
      $this->view->proyecto = [];
      $this->view->num_proyecto = 0;
      $this->view->num_grupo = 0;
      $this->view->num_metodologia = 0;
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render() {
        $cabecera = "Inicio";
        $num_proyecto= $this->model->cargarProyectoIndex();
        $this->view->num_proyecto = $num_proyecto;

        $num_grupo= $this->model->cargarGrupoIndex();
        $this->view->num_grupo = $num_grupo;

        $num_metodologia= $this->model->cargarMetodologiaIndex();
        $this->view->num_metodologia = $num_metodologia;

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
     ///////////////
    //METODOLOGIA//
    //////////////
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

      //FIN DE MÉTODOLOGIA//
      /////////////////////

       ///////////////////////////
       // MÉTODOS PARA PROYECTOS
       //////////////////////////
      function Proyecto(){
        $cabecera = "";
        $cabecera = "Proyecto";
        $this->view->cabecera = $cabecera;
        $proyecto = $this->model->loadProyectos();
        $this->view->proyecto = $proyecto;
        $this->view->render('docente/proyecto');
      }

      function crearProyecto(){
        //libs
        require_once 'libs/database.php';
        require_once 'models/Grupo.php';
        $this->db = new Database();
        
        //variables auxiliares

        $grupos_proyectos = [];
        $_grupos = [];

        //statement return dates
       //Cálculo de listas para seleccionar en la consulta solo los
       //grupos que están disponibles.

        $_query = $this->db->connect()->query("SELECT IdGrupo FROM grupoproyecto");
        while($row_gp = $_query->fetch()) {
            $item = $row_gp['IdGrupo'];
            array_push($grupos_proyectos,$item);
        }
        //print_r($grupos_proyectos);
        
          //print($grupos_proyectos[$i]);
          $query = $this->db->connect()->query("SELECT Id FROM grupo");
          while($row = $query->fetch()) { 
              $item = $row['Id'];
              array_push($_grupos,$item);
          }
        
        $res = array_diff($_grupos, $grupos_proyectos);
        //var_dump($res);
        //print_r($res);
        /*for ($i=2; $i<count($res); $i++) { 
          print($i)." ";
        }*/
        $items = [];
        foreach ($res as $variable) {
          $query_grupos = $this->db->connect()->query("SELECT Id, nombre FROM grupo WHERE Id = '$variable' ");      
            while ($row =$query_grupos->fetch()) {
              $item = new Grupo();
              $item->id = $row['Id'];
              $item->nombre = $row['nombre'];
              array_push($items,$item);
            }
        }

        $grupos = [];
        $this->view->grupos = $items;

        $query_estados = $this->db->connect()->query("SELECT Id, Nombre FROM estado;");
        $estados = $query_estados->fetchAll();
        $this->view->estados = $estados;
        $cabecera = "";
        $cabecera = "Proyecto";
        //$this->view->grupos = $grupos;
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/crearProyecto');
      }

      function detalleGeneralProyecto($param = null){
        $id_proyecto = $param[0];
        $this->detalleProyecto($id_proyecto);
      }

      function detalleProyecto($id_proyecto) {
        //header
        $cabecera = "";
        $cabecera = "Proyecto";
        
        //variables auxiliares
        $proyecto = [];
        $estados = [];
        $id_estado_proyecto = 0;
        //libs

        require_once 'libs/database.php';

        //instancemet new object
        $this->db = new Database();

        //query statement
        $query_estado_proyecto = $this->db->connect()->query("SELECT IdEstado FROM proyecto WHERE Id = '$id_proyecto'");
        while($row = $query_estado_proyecto->fetch()) {
           $id_estado_proyecto = $row['IdEstado'];
        }

        $query_estados = $this->db->connect()->query("SELECT * FROM estado WHERE Id != '$id_estado_proyecto'");
        $estados = $query_estados->fetchAll();
        $proyecto = $this->model->getProyecto($id_proyecto);
        
        //return views
        $this->view->proyecto = $proyecto;
        $this->view->cabecera = $cabecera;
        $this->view->estados = $estados;
        $this->view->render('docente/detallesProyecto');
      }

      function actualizar_proyecto() {
        //recepcion POST
        $nombre = $_POST['NombreProyecto'];
        $fecha_fin = $_POST['fecha_fin'];
        $idEstado = $_POST['idEstado'];
        $id_proyecto = $_POST['id_proyecto'];
        //logic
        
        if($this->model->update_Proyecto(['NombreProyecto' => $nombre, 'id_proyecto' => $id_proyecto, 'fecha_fin' => $fecha_fin, 'idEstado' => $idEstado ])){
          $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> proyecto actualizado correctamente.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }else{
          $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> El proyecto no se pudo actualizar.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        } 
        
        
        //return view
        $this->view->confirmacion = $confirmacion;
        $this->detalleProyecto($id_proyecto);
      }

       

      function agregarProyecto(){
        $nombreProyecto = $_POST['nombreProyecto'];
        $fechaFin = $_POST['fechaFin'];
        $idMetodologia = $_POST['idMetodologia'];
        $idEstado = $_POST['idEstado'];
        $idGrupo = $_POST['idGrupo'];

        if($this->model->insertarProyecto(['nombreProyecto' => $nombreProyecto, 'grupo' => $idGrupo, 'fechaFin' => $fechaFin, 'idMetodologia' => $idMetodologia, 'idEstado' => $idEstado, 'correo' => $this->session->getCurrentUser()])){
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

      function eliminarProyecto($param = null) {
        $id_proyecto = $param[0];

        //libs
        require_once 'libs/database.php';

        //objetc
        $this->db = new Database();

        //variables auxiliares
        $num_historias = 0;

        /*En la siguiente consulta se pretende
        saber si hay historias de usuario ya en los proyectos
        para tomar la decisión si se eliminan o no*/

        $query_historia_proyecto = $this->db->connect()->query("SELECT COUNT(*) AS 'Historia Usuario'
        FROM historiausuario as h
        JOIN modulo as m ON h.IdModulo = m.Id
        JOIN fase as f ON f.Id = m.IdFase
        JOIN metodologia as me ON me.Id = f.IdMetodologia
        JOIN proyecto as p ON p.IdMetodologia = me.Id
        WHERE p.Id = '$id_proyecto'");

        while ($row = $query_historia_proyecto->fetch()) {
            $num_historias = $row[0];
        }

        if ($num_historias > 0) {
          if ($this->model->inactive_proyecto(['id_proyecto' => $id_proyecto])) {
            $confirmacion = '<div class="alert alert-dark" role="alert" > <strong><i class="fas fa-eye-slash"></i> ¡El proyecto no se puede eliminar!</strong>
            Se ha colocado en estado inactivo <a href="'.constant("URL").'/docente/detalleGeneralProyecto/'.$id_proyecto.'">Revisar</a>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';  
          } else {
            $confirmacion = '<div class="alert alert-danger" role="alert" > <strong><i class="fas fa-eye-slash"></i> ¡Eror interno, el proyecto no se pudo deshabilitar!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
          }
          
        } else {

          if($this->model->deleteProyecto(['id_proyecto' => $id_proyecto])){
            $confirmacion = '<div class="alert alert-info" role="alert" ><strong>¡Éxito!</strong> proyecto eliminado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
          }else{
            $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> el Proyecto no pudo eliminarse.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
          }
        }
        $this->view->confirmacion = $confirmacion;
        $this->Proyecto();
      }

    
       ///////////////////////////
       //FIN MÉTODOS PARA PROYECTOS
       //////////////////////////



      ///////////////////////////
       // MÉTODOS PARA GRUPOS
       //////////////////////////

      function Grupo(){
        $cabecera = "";
        $ggrupos = [];
        $grupos = $this->model->loadGrupo();
        $this->view->grupos = $grupos;
        $cabecera = "Grupo";
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/grupo');
      }

      function crearGrupo(){
        
        //libs
        require_once 'libs/Database.php';
        $this->db = new Database();

        //variables
        $cabecera = "";
        $cabecera = "Grupo";
        $confirmacion = "";
        $programas = [];

        //Cargar programas
        $query_programa = $this->db->connect()->query("SELECT * FROM programa ORDER BY Nombre");
        $programas = $query_programa->fetchAll();
        



        $grupos = [];
        $grupos = $this->model->loadEstudiantes();
        //var_dump($grupos);
        $this->view->grupos = $grupos;
        $this->view->programas = $programas;
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/crearGrupo');
      }

      function agregarGrupo(){
        $nombre = $_POST['Nombre'];
        $estudiantes = isset($_POST['estudiantes_seleccionados']);
        //print_r($estudiantes);
        
        if(isset($_POST['estudiantes_seleccionados'])){
          $estudiantes = $_POST['estudiantes_seleccionados'];
          if($this->model->insertarGrupo(['nombre' => $nombre, 'estudiantes' => $estudiantes])){
            $confirmacion = '<div class="alert alert-info" role="alert" ><strong>¡Oye!</strong> se creó el grupo.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
          }else{
            $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> el grupo NO se creó.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
          } 
        }else{
          $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> debes seleccionar un estudiante.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }
        $this->view->nombreGrupo = $nombre;
        $this->view->confirmacion = $confirmacion;
        $this->crearGrupo(); 
      }

      function detalleGeneralGrupo($param = null){
        $id = $param [0];
        $this->detalleGrupo($id);
      
      }


      function detalleGrupo($id){
        //recepcion de parametros
        $id_grupo = $id;
        
        //llamado de libreria
        require_once 'libs/Database.php';
        $this->db = new Database();

        //variables
        $programas = [];
        $cabecera = "";
        $cabecera = "Grupo";
        $grupos = [];
        $datos_grupo = [];
       
        //llamado de métodos.
        
        $datos_grupo = $this->model->getGrupo($id_grupo);
        $grupos = $this->model->loadEstudiantesGrupo($id_grupo);

        //Consulta programas
        $query_programa = $this->db->connect()->query("SELECT * FROM programa ORDER BY Nombre");
        $programas = $query_programa->fetchAll();
        
        //Devolucion de datos
        $this->view->datos_grupo = $datos_grupo; 
        $this->view->grupos = $grupos;
        $this->view->programas = $programas;
        $this->view->cabecera = $cabecera;
        $this->view->render('docente/detallesGrupo');
      }

      function actualizar_grupo () {
        //Recepción de variables
        $id_grupo = $_POST['id_grupo'];
        $nombre = $_POST['nombre'];

        if($this->model->update_Grupo(['nombre' => $nombre, 'id_grupo' => $id_grupo])){
          $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> grupo actualizado correctamente.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }else{
          $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> El grupo no se pudo actualizar.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        } 
      
        $this->view->confirmacion = $confirmacion;
        $this->detalleGrupo($id_grupo);
      }

      function actualizar_grupo_estudiante ($param = null) {
        $id_estudiante = $param[0];
        $id_grupo = $param[1];
          if($this->model->update_estudiante_x_Grupo(['id_estudiante' => $id_estudiante, 'id_grupo' => $id_grupo])){
            $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> Estudiante añadido correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
          }else{
            $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> El estudiante no se pudo añadir.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
          } 
        
          $this->view->confirmacion = $confirmacion;
          $this->detalleGrupo($id_grupo);
      }

      function eliminar_grupo_estudiante($param = null) {
        $id_estudiante = $param[0];
        $id_grupo = $param[1];
          if($this->model->delete_estudiante_x_Grupo(['id_estudiante' => $id_estudiante, 'id_grupo' => $id_grupo])){
            $confirmacion = '<div class="alert alert-info" role="alert" ><strong>¡Éxito!</strong> Estudiante eliminado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
          }else{
            $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> El estudiante no se pudo eliminar.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
          } 
        
          $this->view->confirmacion = $confirmacion;
          $this->detalleGrupo($id_grupo);
      }


      function eliminarGrupo($param = null) {
        $id_grupo = $param[0];

        //comprobar si el grupo ya pertenece a un proyecto

         //llamado de libreria
         require_once 'libs/Database.php';
         $this->db = new Database();

         //variable auxiliar
        $i = 0;

        //consulta
        $query_grupo = $this->db->connect()->query("SELECT IdGrupo FROM grupoproyecto WHERE IdGrupo = '$id_grupo'");
        while ($row = $query_grupo->fetch()) {
          $i++;
        }

        if ($i>0) {
          $confirmacion = '<div class="alert alert-warning" role="alert" > <strong> ¡Lo sentimos! </strong> El grupo no se pudo eliminar, porque ya está asignado a un proyecto.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }else {
          if($this->model->delete_Grupo(['id_grupo' => $id_grupo])){
            $confirmacion = '<div class="alert alert-info" role="alert" ><strong>¡Éxito!</strong> Grupo eliminado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
          }else{
            $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> El grupo no pudo eliminarse.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
          } 
        }
        $this->view->confirmacion = $confirmacion;
        $this->Grupo();

      }

     
   
}

?>