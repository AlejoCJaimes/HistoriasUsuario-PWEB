<?php
require_once 'libs/session.php';
require_once 'helpers/Encriptar.php';
class Estudiante extends Controller{

    function __construct(){
      parent::__construct();

      $this->session = new Session();
      $this->session->init();
      if ($this->session->getStatus() === 1 || empty($this->session->get('correo_usuario')) || $this->session->getCurrentRolUser() != 3) {
        exit('<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Error!</strong> Acceso denegado, por favor iniciar sesión.
        </div>". "<script>
         setTimeout(function(){
         window.location="http://localhost/HistoriasUsuario-PWEB/account"}, 1000);
         </script>"

          ');

          $this->view->datos = [];

      }

      $this->view->mensaje= $this->session->getCurrentUser();
      $this->view->confirmacion = "";
      $this->view->datos_perfil = [];
      $this->view->id_correo = "";
      $this->view->cabecera = "";
      $this->view->historiausuario = [];
      $this->view->estado = [];
      $this->view->recursos = [];
      $this->view->totalRecursos = "";
      $this->view->actividad = [];
      $this->view->modulo = [];
      $this->view->metodologias = [];
      $this->view->fuentes = [];
      $this->view->historiasUsuario = [];
      $this->view->validacion = 0;

      //count index
      $this->view->num_historias = 0;
      $this->view->num_fase = 0;
      $this->view->num_modulo = 0;
      $this->view->num_actividad = 0;
      $this->view->num_recurso = 0;
      
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render() {
      $id_user = $this->session->getCurrentUser();
      $cabecera = "Inicio";

      $num_historias= $this->model->cargarHistoriaIndex($id_user);
      $this->view->num_historias = $num_historias;

      $num_fase= $this->model->cargarFaseIndex($id_user);
      $this->view->num_fase = $num_fase;

      $num_modulo= $this->model->cargarModuloIndex($id_user);
      $this->view->num_modulo = $num_modulo;

      $num_actividad= $this->model->cargarActividadIndex($id_user);
      $this->view->num_actividad = $num_actividad;

      $num_recurso= $this->model->cargarRecursoIndex($id_user);
      $this->view->num_recurso = $num_recurso;


      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->cabecera = $cabecera;
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/index');

    }

    function perfil () {
      $cabecera = "";
      $cabecera = "Perfil";
      $this->view->cabecera = $cabecera;
      $id_correo = $this->session->getCurrentUser();
      $datos_perfil = $this->model->loadPerfil($id_correo);
      $this->view->datos_perfil = $datos_perfil;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/perfil');
    }

    function EditarPerfil() {

      $confirmacion = "";
      $nombre = $_POST['NombreEstudiante'];
      $apellido = $_POST['ApellidoEstudiante'];
      $numero_semestre = $_POST['NumeroSemestre'];
      $cedula = $_POST['CedulaEstudiante'];


      if ($this->model->updatePerfil(['NombreEstudiante' => $nombre, 'ApellidoEstudiante' => $apellido, 'NumeroSemestre' => $numero_semestre, 'CedulaEstudiante' => $cedula])) {
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
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
     $this->view->render('estudiante/changeClave');

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
        if($clave!=""){
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
      else{
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

    //Read Metodologia 
    function readMetodologia() {
      
      $metodologias = [];
      $fuentes = [];
      require_once 'models/Metodologia.php';
      $correo_user = $this->session->getCurrentUser();
      require_once 'libs/database.php';
      $this->db = new Database();
      $query_id_estudiante = $this->db->connect()->query("SELECT g.IdGrupo as 'IdGrupo' FROM grupoestudiante AS g  
      JOIN estudiante as e ON e.Id = g.IdEstudiante
      JOIN usuario as u ON e.IdUsuario = u.Id 
      WHERE u.correo_usuario= '$correo_user'");
      while($row = $query_id_estudiante->fetch()) {
       $id_grupo = $row['IdGrupo'];
      }

      $query_metodologia_estudiante = $this->db->connect()->query("SELECT m.* FROM metodologia as m 
      JOIN proyecto as p ON p.IdMetodologia = m.Id
      JOIN grupoproyecto as gproyecto ON gproyecto.IdProyecto = p.Id
      WHERE gproyecto.IdGrupo = '$id_grupo'");
      $aux_id_meto = 0;
      while($rowe = $query_metodologia_estudiante->fetch()) {
          $item = new Metodologia();
          $item->id = $rowe['Id'];
          $item->nombre = $rowe['Nombre'];
          $item->descripcion = $rowe['Descripcion'];

          array_push($metodologias,$item);
          $aux_id_meto = $rowe['Id'];
      }

        $cabecera = "";
        $cabecera = "Metodología";
        $this->view->cabecera = $cabecera;
        $this->view->metodologias = $metodologias;
        
        $correo = $this->session->getCurrentUser();
        $validacion = $this->model->VerificarPerfil($correo);
        $this->view->validacion = $validacion;
        $this->view->render('estudiante/readMetodologia');
    }

    //HISTORIAS DE USUARIO 
    //INICIO HISTORIA DE USUARIO
    function crearhistoria() {
      $cabecera = "Crear Historia de Usuario";
      $this->view->cabecera = $cabecera;

      require_once 'libs/database.php';
      $this->db = new Database();

      $id_user = $this->session->getCurrentUser();
      $consulta = "SELECT mo.Id, mo.Nombre 
      FROM estudiante e 
      JOIN usuario us ON us.id = e.idusuario
      JOIN grupoestudiante ge ON ge.IdEstudiante = e.Id
      JOIN grupo g ON g.id = ge.IdGrupo
      JOIN grupoproyecto gp ON gp.IdGrupo = g.Id
      JOIN proyecto p ON p.id = gp.IdProyecto
      JOIN metodologia m ON m.id = p.IdMetodologia
      JOIN fase f ON f.IdMetodologia = m.Id
      JOIN modulo mo ON mo.IdFase = f.Id
      WHERE us.correo_usuario = '$id_user'
      GROUP BY mo.Id, mo.Nombre";

        $query = $this->db->connect()->query($consulta);
        $arr = $query->fetchAll();

      $this->view->modulo = $arr;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/historiasusuario/crearhistoria');

    }
    function addHistoriaUsuario() {
      $NumHistoriaUsuario = $_POST['NumHistoriaUsuario'];
      $Prioridad = $_POST['Prioridad'];
      $Nombre = $_POST['Nombre'];
      $Descripcion = $_POST['Descripcion'];
      $IdModulo = $_POST['IdModulo'];
      $IdEstado = $_POST['IdEstado'];

      if($this->model->insertarHistoriaUsuario(['NumHistoriaUsuario' => $NumHistoriaUsuario,'Prioridad' => $Prioridad,'Nombre' => $Nombre,
      'Descripcion' => $Descripcion,'IdModulo' => $IdModulo,'IdEstado' => $IdEstado])){
        $confirmacion = '<div class="alert alert-info text-center" role="alert" >Historia de Usuario creada correctamente.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      }else{
        $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> la Historia de Usuario NO se creó.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      }
      $this->view->confirmacion = $confirmacion;
      $this->crearhistoria();
    }


    function detalleHistoria() {
      $cabecera = "";
      $cabecera = "Detalle Historia";
      /*Body*/
      $fases = [];
      $correo_user = $this->session->getCurrentUser();
      require_once 'libs/database.php';
      require_once 'models/Fase.php';
      $this->db = new Database();

      //obtner grupo
      $id_grupo = "";
      $query_id_estudiante = $this->db->connect()->query("SELECT g.IdGrupo as 'IdGrupo' FROM grupoestudiante AS g  
      JOIN estudiante as e ON e.Id = g.IdEstudiante
      JOIN usuario as u ON e.IdUsuario = u.Id 
      WHERE u.correo_usuario= '$correo_user'");
      while($row = $query_id_estudiante->fetch()) {
       $id_grupo = $row['IdGrupo'];
      }


      $id_estudiante = "";
      $query_fase_estudiante = $this->db->connect()->query("SELECT f.*  FROM
      fase as f 
      JOIN proyecto as p ON p.IdMetodologia = f.IdMetodologia
      join grupoproyecto as gproyecto ON gproyecto.IdProyecto = p.Id
      JOIN grupo as g ON g.Id = gproyecto.IdGrupo
      JOIN grupoestudiante AS gestudiante ON gestudiante.IdGrupo = g.Id
      JOIN estudiante AS e ON e.Id = gestudiante.IdEstudiante
      JOIN usuario as u ON u.Id = e.IdUsuario
      WHERE u.correo_usuario =  '$correo_user' AND gproyecto.IdGrupo = '$id_grupo'");

      while($_row = $query_fase_estudiante->fetch()) {
        $item = new Fase(); 
        $item->Id = $_row['Id'];
        $item->Nombre = $_row['Nombre'];
        $item->Descripcion = $_row['Descripcion'];
        $item->FechaCreacion = $_row['FechaCreacion'];
        $item->FechaActualizacion = $_row['FechaActualizacion'];
        $item->UrlFase = $_row['UrlFase'];
        $item->IdEstado = $_row['IdEstado'];
        $item->IdMetodologia = $_row['IdMetodologia'];
        array_push($fases,$item);  
      }
      
      $this->view->fases = $fases;


      $this->view->cabecera = $cabecera;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/historiasusuario/index');

    }

    function readHistoria($param = null) {
      
      if($param != null){
        require_once 'libs/database.php';
        $this->db = new Database();
        $numero = $param[0];
        
        //Consulta para la historia del estudiante
        $query_1 = $this->db->connect()->query("SELECT * FROM historiausuario hu JOIN estado e ON e.Id = hu.IdEstado JOIN modulo m ON m.Id = hu.IdModulo WHERE hu.Id = '$numero' LIMIT 1;");
        $arr = $query_1->fetchAll();
        
        $this->view->historiausuario = $arr;

        //Consulta para obtener los estados
        $query_2 = $this->db->connect()->query("SELECT * FROM estado;");
        $arr2 = $query_2->fetchAll();

        $this->view->estado = $arr2;

        //Consulta para obtener los módulos
        $id_user = $this->session->getCurrentUser();
        $consulta = "SELECT mo.Id, mo.Nombre 
        FROM estudiante e 
        JOIN usuario us ON us.id = e.idusuario
        JOIN grupoestudiante ge ON ge.IdEstudiante = e.Id
        JOIN grupo g ON g.id = ge.IdGrupo
        JOIN grupoproyecto gp ON gp.IdGrupo = g.Id
        JOIN proyecto p ON p.id = gp.IdProyecto
        JOIN metodologia m ON m.id = p.IdMetodologia
        JOIN fase f ON f.IdMetodologia = m.Id
        JOIN modulo mo ON mo.IdFase = f.Id
        WHERE us.correo_usuario = '$id_user'
        GROUP BY mo.Id, mo.Nombre";

        $query_3 = $this->db->connect()->query($consulta);
        $arr3 = $query_3->fetchAll();

        $this->view->modulo = $arr3; 

      }
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/historiasusuario/readHistoria');
      
    }

    function editarHistoriaUsuario($id){

      if($id != ""){
        $idHistoria = $id[0];
        $NumHistoriaUsuario = $_POST['NumHistoriaUsuario'];
        $Prioridad = $_POST['Prioridad'];
        $IdEstado = $_POST['IdEstado'];
        $Nombre = $_POST['Nombre'];
        $Descripcion = $_POST['Descripcion'];
        $IdModulo = $_POST['IdModulo'];

        if ($this->model->updateHistoriaUsuario(['idHistoria' => $idHistoria,'NumHistoriaUsuario' => $NumHistoriaUsuario,'Prioridad' => $Prioridad,'IdEstado' => $IdEstado,'Nombre' => $Nombre,'Descripcion' => $Descripcion,'IdModulo' => $IdModulo])) {
          $confirmacion = '<div class="alert alert-info" role="alert" >Historia de usuario actualizada correctamente.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        } else {
          $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> la Historia de Usuario no pudo ser actualizada.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';

        }

        $this->view->confirmacion = $confirmacion;

      }
      
      $this->detalleHistoria();

    }

    function eliminarHistoriaUsuario($id){
      if($id != ""){
        if ($this->model->deleteHistoria($id)) {
          $confirmacion = '<div class="alert alert-info" role="alert" >Historia de usuario eliminada correctamente.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        } else {
          $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> la Historia de Usuario no pudo ser eliminada.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
  
        }
  
        $this->view->confirmacion = $confirmacion;
        $this->detalleHistoria();

      }

    }

    //FIN DE HISTORIA DE USUARIO
        
        ///////////////////////////
        // INICIO MÉTODOS PARA ACTVIDAD
      //////////////////////////

    //VISTAS DE INDEX INICIO DE ACTIVIDAD
    function crearActividad() {
      $cabecera = "";
      $cabecera = "Actividad";
      
      require_once 'libs/database.php';
      $this->db = new Database();
      $id_user = $this->session->getCurrentUser();
      $id_estudiante = "";
      $query_id_estudiante = $this->db->connect()->query(" SELECT e.Id as 'Id' FROM estudiante AS e  JOIN usuario as u ON e.IdUsuario = u.Id WHERE u.correo_usuario= '$id_user'");
      while($row = $query_id_estudiante->fetch()) {
       $id_estudiante = $row['Id'];
      }

      $consulta = "SELECT hu.Id, hu.Nombre 
          FROM estudiante e 
          JOIN usuario us ON us.id = e.idusuario
          JOIN grupoestudiante ge ON ge.IdEstudiante = e.Id
          JOIN grupo g ON g.id = ge.IdGrupo
          JOIN grupoproyecto gp ON gp.IdGrupo = g.Id
          JOIN proyecto p ON p.id = gp.IdProyecto
          JOIN metodologia m ON m.id = p.IdMetodologia
          JOIN fase f ON f.IdMetodologia = m.Id
          JOIN modulo mo ON mo.IdFase = f.Id
          JOIN historiausuario hu ON hu.IdModulo = mo.Id
          WHERE us.correo_usuario = '$id_user';";

        $query = $this->db->connect()->query($consulta);
        $arr = $query->fetchAll();

       
        $_consulta = "SELECT mo.Id, mo.Nombre 
        FROM estudiante e 
        JOIN usuario us ON us.id = e.idusuario
        JOIN grupoestudiante ge ON ge.IdEstudiante = e.Id
        JOIN grupo g ON g.id = ge.IdGrupo
        JOIN grupoproyecto gp ON gp.IdGrupo = g.Id
        JOIN proyecto p ON p.id = gp.IdProyecto
        JOIN metodologia m ON m.id = p.IdMetodologia
        JOIN fase f ON f.IdMetodologia = m.Id
        JOIN modulo mo ON mo.IdFase = f.Id
        WHERE us.correo_usuario = '$id_user'
        GROUP BY mo.Id, mo.Nombre";
  
          $_query = $this->db->connect()->query($_consulta);
          $_arr = $_query->fetchAll();
  
        $this->view->modulo = $_arr;
      
      $this->view->historiasUsuario = $arr;
      $this->view->cabecera = $cabecera;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/historiasusuario/actividad/index');
    }


    function detalleGeneralActividad() {
      
      //cabecera
      $cabecera = "Actividades Creadas";

      //llamar las actividades
      $id_usuario = $this->session->getCurrentUser();
      $actividad = $this->model->getActividades($id_usuario);
      //var_dump($id_usuario);
      //retornar vistas
      $this->view->actividad = $actividad;
      $this->view->cabecera = $cabecera;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/historiasusuario/actividad/detalleActividad');
    }

    function editActividad() {

      //Recepción de variables
      $id_actividad = $_POST['Id'];
      $nombre = $_POST['Nombre'];
      $descripcion = $_POST['Descripcion'];
      
      $confirmacion = "";


      if ($this->model->updateActividad(['Id' => $id_actividad, 'Nombre' => $nombre, 'Descripcion' => $descripcion])) {
        // code...
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> Actividad actualizado con éxito.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      } else {
        $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> La actividad no se pudo actualizar.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      }

      $this->view->confirmacion = $confirmacion;
      $this->detalleGeneralActividad();
    }

    function eliminarActividad() {

      //Recepción de variables
      $id_actividad = $_POST['Id'];
      
      $confirmacion = "";


      if ($this->model->deleteActividad(['Id' => $id_actividad])) {
        // code...
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> Actividad eliminada con éxito.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      } else {
        $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> La actividad no se pudo eliminar.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      }

      $this->view->confirmacion = $confirmacion;
      $this->detalleGeneralActividad();
    }

     ///////////////////////////
      // FIN MÉTODOS PARA ACTVIDAD
      //////////////////////////


    // Inicio sección de recurso

    function detalleRecurso(){
      $cabecera = "Total Recursos";
      $this->view->cabecera = $cabecera;
      $id_user = $this->session->getCurrentUser();

      require_once 'libs/database.php';
      $this->db = new Database();
      $id_grupo = 0;
      $query_id_grupo = $this->db->connect()->query("SELECT ge.IdGrupo FROM usuario u JOIN estudiante e ON e.IdUsuario = u.Id JOIN grupoestudiante ge ON ge.IdEstudiante = e.Id where u.correo_usuario = '$id_user';");
      while($row = $query_id_grupo->fetch()) {
       $id_grupo = $row['IdGrupo'];
      }

      $consulta = "SELECT re.Id, re.Tipo, re.valor
      FROM grupo g      
      JOIN grupoproyecto gp ON gp.IdGrupo = g.Id
      JOIN proyecto p ON p.id = gp.IdProyecto
      JOIN metodologia m ON m.id = p.IdMetodologia
      JOIN fase f ON f.IdMetodologia = m.Id
      JOIN modulo mo ON mo.IdFase = f.Id
      JOIN historiausuario hu ON hu.IdModulo = mo.Id
      JOIN actividad ac ON ac.IdHistoriaUsuario = hu.id
      JOIN recurso re ON re.idActividad = ac.Id
      WHERE g.Id = $id_grupo";

      $query = $this->db->connect()->query($consulta);
      $arr = $query->fetchAll();
      $this->view->recurso = $arr;

      $consulta = "SELECT SUM(re.valor) as Total
      FROM grupo g      
      JOIN grupoproyecto gp ON gp.IdGrupo = g.Id
      JOIN proyecto p ON p.id = gp.IdProyecto
      JOIN metodologia m ON m.id = p.IdMetodologia
      JOIN fase f ON f.IdMetodologia = m.Id
      JOIN modulo mo ON mo.IdFase = f.Id
      JOIN historiausuario hu ON hu.IdModulo = mo.Id
      JOIN actividad ac ON ac.IdHistoriaUsuario = hu.id
      JOIN recurso re ON re.idActividad = ac.Id
      WHERE g.Id = $id_grupo";
      
      $query = $this->db->connect()->query($consulta);
      while($row = $query->fetch()) {
        $total = $row['Total'];
      }
      $this->view->totalRecursos = $total;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/historiasusuario/recurso/detalleRecurso');
    }

    function crearRecurso() {
      $cabecera = "";
      $cabecera = "Recurso";

      require_once 'libs/database.php';
      $this->db = new Database();
      
      $id_user = $this->session->getCurrentUser();
      $consulta = "SELECT ac.Id, ac.Nombre 
      FROM estudiante e 
      JOIN usuario us ON us.id = e.idusuario
      JOIN grupoestudiante ge ON ge.IdEstudiante = e.Id
      JOIN grupo g ON g.id = ge.IdGrupo
      JOIN grupoproyecto gp ON gp.IdGrupo = g.Id
      JOIN proyecto p ON p.id = gp.IdProyecto
      JOIN metodologia m ON m.id = p.IdMetodologia
      JOIN fase f ON f.IdMetodologia = m.Id
      JOIN modulo mo ON mo.IdFase = f.Id
      JOIN historiausuario hu ON hu.IdModulo = mo.Id
      JOIN actividad ac ON ac.IdHistoriaUsuario = hu.id
      WHERE us.correo_usuario = '$id_user';";
      
      $query = $this->db->connect()->query($consulta);
      $arr = $query->fetchAll();

      $this->view->actividad = $arr;
      $this->view->cabecera = $cabecera;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/historiasusuario/recurso/index');
    }

    function editarRecursoView($id){
      $cabecera = "Editar Recurso";
      require_once 'libs/database.php';
      $this->db = new Database();

      if($id != ""){
        $idRecurso = $id[0];
        $consulta = "SELECT * FROM recurso WHERE Id = '$idRecurso';";
        $query = $this->db->connect()->query($consulta);
        $arr = $query->fetchAll();
        $this->view->recurso = $arr[0];
        
        $idActividad = $this->view->recurso["idActividad"];
        $consulta2 = "SELECT * FROM actividad WHERE Id = '$idActividad';";
        $query2 = $this->db->connect()->query($consulta2);
        $arr2 = $query2->fetchAll();
        $this->view->recurso["NombreActividad"] = $arr2[0]["Nombre"];
        $this->view->recurso["IdActividad"] = $arr2[0]["Id"];
        
        $id_user = $this->session->getCurrentUser();
        $consulta3 = "SELECT ac.Id, ac.Nombre 
        FROM estudiante e 
        JOIN usuario us ON us.id = e.idusuario
        JOIN grupoestudiante ge ON ge.IdEstudiante = e.Id
        JOIN grupo g ON g.id = ge.IdGrupo
        JOIN grupoproyecto gp ON gp.IdGrupo = g.Id
        JOIN proyecto p ON p.id = gp.IdProyecto
        JOIN metodologia m ON m.id = p.IdMetodologia
        JOIN fase f ON f.IdMetodologia = m.Id
        JOIN modulo mo ON mo.IdFase = f.Id
        JOIN historiausuario hu ON hu.IdModulo = mo.Id
        JOIN actividad ac ON ac.IdHistoriaUsuario = hu.id
        WHERE us.correo_usuario = '$id_user' && ac.Id != '$idActividad';";
        
        $query3 = $this->db->connect()->query($consulta3);
        $arr3 = $query3->fetchAll();

        $this->view->actividad = $arr3;
      }      
      
      $this->view->cabecera = $cabecera;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/historiasusuario/recurso/editarRecurso');

    }

    function editarRecurso(){
      $idRecurso = $_POST["idRecurso"];
      $Tipo = $_POST["Tipo"];
      $Descripcion = $_POST["Descripcion"];
      $Valor = $_POST["Valor"];
      $idActividad = $_POST["idActividad"];

      if ($this->model->updateRecurso(['idRecurso' => $idRecurso, 'Tipo' => $Tipo, 'Descripcion' => $Descripcion, 'Valor' => $Valor,'idActividad' => $idActividad])) {
        $confirmacion = '<div class="alert alert-info" role="alert" >Recurso actualizado correctamente.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      } else {
        $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> el recurso no pudo ser actualizado.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';

      }

      $this->view->confirmacion = $confirmacion;
      $this->detalleRecurso();

    }

    function eliminarRecurso($id){
      if($id != ""){
        if ($this->model->deleteRecurso($id)) {
          $confirmacion = '<div class="alert alert-info" role="alert" >Recurso eliminado correctamente.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        } else {
          $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> el recurso no pudo ser eliminado.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
  
        }
  
        $this->view->confirmacion = $confirmacion;
        $this->detalleRecurso();

      }

    }


    // Fin sesión Recurso

    ///////////////////////////
    // INICIO MÉTODOS PARA MÓDULOS
    //////////////////////////

    function crearModulo() {
      $fases = [];
      $correo_user = $this->session->getCurrentUser();
      require_once 'libs/database.php';
      require_once 'models/Fase.php';
      $this->db = new Database();

      //obtner grupo
      $id_grupo = "";
      $query_id_estudiante = $this->db->connect()->query("SELECT g.IdGrupo as 'IdGrupo' FROM grupoestudiante AS g  
      JOIN estudiante as e ON e.Id = g.IdEstudiante
      JOIN usuario as u ON e.IdUsuario = u.Id 
      WHERE u.correo_usuario= '$correo_user'");
      while($row = $query_id_estudiante->fetch()) {
       $id_grupo = $row['IdGrupo'];
      }


      $id_estudiante = "";
      $query_fase_estudiante = $this->db->connect()->query("SELECT f.*  FROM
      fase as f 
      JOIN proyecto as p ON p.IdMetodologia = f.IdMetodologia
      join grupoproyecto as gproyecto ON gproyecto.IdProyecto = p.Id
      JOIN grupo as g ON g.Id = gproyecto.IdGrupo
      JOIN grupoestudiante AS gestudiante ON gestudiante.IdGrupo = g.Id
      JOIN estudiante AS e ON e.Id = gestudiante.IdEstudiante
      JOIN usuario as u ON u.Id = e.IdUsuario
      WHERE u.correo_usuario =  '$correo_user' AND gproyecto.IdGrupo = '$id_grupo'");

      while($_row = $query_fase_estudiante->fetch()) {
        $item = new Fase(); 
        $item->Id = $_row['Id'];
        $item->Nombre = $_row['Nombre'];
        $item->Descripcion = $_row['Descripcion'];
        $item->FechaCreacion = $_row['FechaCreacion'];
        $item->FechaActualizacion = $_row['FechaActualizacion'];
        $item->UrlFase = $_row['UrlFase'];
        $item->IdEstado = $_row['IdEstado'];
        $item->IdMetodologia = $_row['IdMetodologia'];
        array_push($fases,$item);  
      }
      
      $this->view->fases = $fases;
      $cabecera = "";
      $cabecera = "Modulo";
      $this->view->cabecera = $cabecera;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/historiasusuario/modulo/crearModulo');
    }


    function addModulo() {
      $confirmacion = "";
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $fase = $_POST['idfase'];

      if ($this->model->insertarModulo(['nombre' => $nombre,'descripcion'=> $descripcion, 'idfase' => $fase])) {
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> El módulo fue creado con éxito.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>

          </div> ';
      } else {
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Lo sentimos!</strong>El módulo no pudo crearse.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>

          </div> ';

      }
      $this->view->confirmacion = $confirmacion;
      $this->crearModulo();
    }

    function detalleGeneralModulo() {
      $correo = $this->session->getCurrentUser();
      $cabecera = "";
      $cabecera = "Detalles Módulo";

      require_once 'libs/database.php';
      $this->db = new Database();

      ////CARGAR FASES///////////
      //obtner grupo
     
      //CARGAR MODULOS///

      $modulos = [];

      $query_modulos = $this->db->connect()->query("SELECT m.Id ,DATE_FORMAT(m.FechaCreacion,' %d-%M-%Y %h:%i %p') as '_FechaCreacion',
      DATE_FORMAT(m.FechaActualizacion,' %d-%M-%Y %h:%i %p') as '_FechaActualizacion',
      m.Nombre, m.IdFase, m.Descripcion,f.Nombre, f.Descripcion
      FROM modulo as m 
      JOIN fase as f ON m.IdFase = f.Id
      JOIN metodologia as me ON me.Id = f.IdMetodologia
      JOIN proyecto as p ON p.IdMetodologia = me.Id
      JOIN grupoproyecto as gpr ON gpr.IdProyecto = p.Id
      JOIN grupoestudiante as gp on gp.IdGrupo = gpr.IdGrupo
      JOIN estudiante AS e ON e.Id = gp.IdEstudiante
      JOIN usuario as u ON u.Id = e.IdUsuario
      WHERE u.correo_usuario = '$correo'");

      $modulos = $query_modulos->fetchAll();

     
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->cabecera = $cabecera;
      $this->view->modulos = $modulos;
      $this->view->render('estudiante/historiasusuario/modulo/detalleModulo');
    }


    function editModulo() {

      $id_modulo = $_POST['Id'];
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];

      $confirmacion = "";


      if ($this->model->updateModulo(['Id' => $id_modulo, 'nombre' => $nombre, 'descripcion' => $descripcion])) {
        // code...
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> Módulo actualizado con éxito.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      } else {
        $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> El módulo no se pudo actualizar.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      }

      $this->view->confirmacion = $confirmacion;
      $this->detalleGeneralModulo();
    }

    function eliminarModulo() {

      $id_modulo = $_POST['Id'];

      $confirmacion = "";


      if ($this->model->deleteModulo(['Id' => $id_modulo])) {
        // code...
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> Módulo eliminado correctamente.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      } else {
        $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> El módulo no se pudo eliminar.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      }

      $this->view->confirmacion = $confirmacion;
      $this->detalleGeneralModulo();
    }
    ///////////////////////////
    // FIN MÉTODOS PARA MÓDULOS
    //////////////////////////

    ////////COMIENZO FASE//////////
     
    ///////////////////////////
    // INICIO MÉTODOS PARA FASE
    //////////////////////////
    function crearFase() {

      $metodologia = "";
      require_once 'libs/database.php';
      $this->db = new Database();
      $id_user = $this->session->getCurrentUser();
      $id_estudiante = "";
      $query_id_estudiante = $this->db->connect()->query(" SELECT e.Id as 'Id' FROM estudiante AS e  JOIN usuario as u ON e.IdUsuario = u.Id WHERE u.correo_usuario= '$id_user'");
      while($row = $query_id_estudiante->fetch()) {
       $id_estudiante = $row['Id'];
      }
      
      
      $query_metodologia_estudiante = $this->db->connect()->query("SELECT m.Nombre as 'metodologia' from metodologia AS m
      JOIN proyecto as p ON p.IdMetodologia = m.Id
      JOIN grupoproyecto AS gproyecto ON gproyecto.IdProyecto = p.Id
      JOIN grupo as g ON g.Id = gproyecto.IdGrupo
      JOIN grupoestudiante as gestudiante ON gestudiante.IdGrupo = g.Id
      WHERE gestudiante.IdEstudiante = '$id_estudiante'");

      while($_row = $query_metodologia_estudiante->fetch()) {
         $metodologia = $_row['metodologia'];
      }


     
      $cabecera = "";
      $cabecera = "Fase";
      $this->view->metodologia = $metodologia;
      $this->view->cabecera = $cabecera;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/historiasusuario/fase/crearFase');
    }

    function addFase() {
      $confirmacion = "";
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $url = $_POST['url'];
      $_metodologia = $_POST['metodologia'];
      $estado = $_POST['idestado'];
      $objetivo = $_POST['descripcion_objetivo'];

      //DEVOLVER METODOLOGIA
      $metodologia = "";
      require_once 'libs/database.php';
      $this->db = new Database();
      $id_user = $this->session->getCurrentUser();
      $id_estudiante = "";
      $query_id_estudiante = $this->db->connect()->query(" SELECT e.Id as 'Id' FROM estudiante AS e  JOIN usuario as u ON e.IdUsuario = u.Id WHERE u.correo_usuario= '$id_user'");
      while($row = $query_id_estudiante->fetch()) {
       $id_estudiante = $row['Id'];
      }
      
      
      $query_metodologia_estudiante = $this->db->connect()->query("SELECT m.Nombre as 'metodologia' from metodologia AS m
      JOIN proyecto as p ON p.IdMetodologia = m.Id
      JOIN grupoproyecto AS gproyecto ON gproyecto.IdProyecto = p.Id
      JOIN grupo as g ON g.Id = gproyecto.IdGrupo
      JOIN grupoestudiante as gestudiante ON gestudiante.IdGrupo = g.Id
      WHERE gestudiante.IdEstudiante = '$id_estudiante'");

      while($_row = $query_metodologia_estudiante->fetch()) {
         $metodologia = $_row['metodologia'];
      }


     
     

      if ($this->model->insertarFase(['nombre' => $nombre, 'descripcion'=> $descripcion, 'url' => $url, 'metodologia' => $_metodologia, 'idestado' => $estado, 'descripcion_objetivo' => $objetivo])) {
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> La fase '.$nombre.' ha sido agregada correctamente
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>

          </div> ';
      } else {
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Lo sentimos!</strong> La fase no pudo crearse.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>

          </div> ';

      }
      

     
      $this->view->metodologia = $metodologia;
      $this->view->confirmacion = $confirmacion;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->render('estudiante/historiasusuario/fase/crearFase');
    }     


    function detalleGeneralFase() {
      $cabecera = "Detalles";
      $fases = [];
      $estados = [];
      $id_estado_aux;
      $correo_user = $this->session->getCurrentUser();
      require_once 'libs/database.php';
      require_once 'models/Fase.php';
      $this->db = new Database();

      //obtner grupo
      $id_grupo = "";
      $query_id_estudiante = $this->db->connect()->query("SELECT g.IdGrupo as 'IdGrupo' FROM grupoestudiante AS g  
      JOIN estudiante as e ON e.Id = g.IdEstudiante
      JOIN usuario as u ON e.IdUsuario = u.Id 
      WHERE u.correo_usuario= '$correo_user'");
      while($row = $query_id_estudiante->fetch()) {
       $id_grupo = $row['IdGrupo'];
      }


      $id_estudiante = "";
      $query_fase_estudiante = $this->db->connect()->query("SELECT f.*,DATE_FORMAT(f.FechaCreacion,' %d-%M-%Y %h:%i %p') as '_FechaCreacion',
      DATE_FORMAT(f.FechaActualizacion,' %d-%M-%Y %h:%i %p') as '_FechaActualizacion', o.Descripcion as 'Objetivo', o.Id as 'IdObjetivo',
      es.Nombre as 'Estado'
      FROM
      fase as f 
      JOIN objetivo as o ON o.IdFase = f.Id
      JOIN estado as es ON es.Id = f.IdEstado
      JOIN proyecto as p ON p.IdMetodologia = f.IdMetodologia
      join grupoproyecto as gproyecto ON gproyecto.IdProyecto = p.Id
      JOIN grupo as g ON g.Id = gproyecto.IdGrupo
      JOIN grupoestudiante AS gestudiante ON gestudiante.IdGrupo = g.Id
      JOIN estudiante AS e ON e.Id = gestudiante.IdEstudiante
      JOIN usuario as u ON u.Id = e.IdUsuario
      WHERE u.correo_usuario =  '$correo_user' AND gproyecto.IdGrupo = '$id_grupo'");

      while($_row = $query_fase_estudiante->fetch()) {
        $item = new Fase(); 
        $item->Id = $_row['Id'];
        $item->Nombre = $_row['Nombre'];
        $item->Descripcion = $_row['Descripcion'];
        $item->FechaCreacion = $_row['_FechaCreacion'];
        $item->FechaActualizacion = $_row['_FechaActualizacion'];
        $item->UrlFase = $_row['UrlFase'];
        $item->IdEstado = $_row['IdEstado'];
        $id_estado_aux = $_row['IdEstado'];
        $item->IdMetodologia = $_row['IdMetodologia'];
        $item->nombre_objetivo = $_row['Objetivo'];
        $item->id_objetivo = $_row['IdObjetivo'];
        $item->nombre_estado = $_row['Estado'];
        array_push($fases,$item);  
      }
      
      $query_estados = $this->db->connect()->query("SELECT `Id`, `Nombre` FROM `estado` WHERE Id IN (1,4,5)");
      $estados = $query_estados->fetchAll();
      $this->view->estados = $estados;
      $this->view->fases = $fases;
      $correo = $this->session->getCurrentUser();
      $validacion = $this->model->VerificarPerfil($correo);
      $this->view->validacion = $validacion;
      $this->view->cabecera = $cabecera;
      $this->view->render('estudiante/historiasusuario/fase/detalleFase');
    
    }

    function editFase() {

      //Recepción de variables
      $id_fase = $_POST['IdFase'];
      $id_objetivo = $_POST['IdObjetivo'];
      $id_estado = $_POST['id_estado'];
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $objetivo = $_POST['objetivo'];
      
      $confirmacion = "";


      if ($this->model->updateFase(['IdFase' => $id_fase, 'nombre' => $nombre, 'descripcion' => $descripcion, 'objetivo' => $objetivo, 'id_estado' => $id_estado, 'IdObjetivo' => $id_objetivo])) {
        // code...
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> Fase actualizado con éxito.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      } else {
        $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> La fase no se pudo actualizar.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      }

      $this->view->confirmacion = $confirmacion;
      $this->detalleGeneralFase();
    }

    function eliminarFase() {

      //Recepción de variables
      $id_fase = $_POST['Id'];
      
      $confirmacion = "";


      if ($this->model->deleteFase(['Id' => $id_fase])) {
        // code...
        $confirmacion = '<div class="alert alert-success" role="alert" ><strong>¡Éxito!</strong> Fase eliminada con éxito.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      } else {
        $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> La fase no se pudo eliminar.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
      }

      $this->view->confirmacion = $confirmacion;
      $this->detalleGeneralFase();
    }
    ///////////////////////////
    // FIN MÉTODOS PARA FASES
    //////////////////////////

     // Métodos de insersión para Historia de usuario, actividad y recursos

     
      function addActividad() {
        $Nombre = $_POST['Nombre'];
        $Descripcion = $_POST['Descripcion'];
        $IdHistoriaUsuario = $_POST['IdHistoriaUsuario'];
        $id_user = $this->session->getCurrentUser();
        if($this->model->insertarActividad(['Nombre' => $Nombre, 'Descripcion' => $Descripcion,'IdHistoriaUsuario' => $IdHistoriaUsuario, 'id_user' => $id_user])){
          $confirmacion = '<div class="alert alert-info text-center" role="alert" >Actividad creada correctamente.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }else{
          $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> la actividad NO se creó.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }
        $this->view->confirmacion = $confirmacion;
        $this->crearActividad();
      }

      function addRecurso() {
        $Descripcion = $_POST['Descripcion'];
        $Tipo = $_POST['Tipo'];
        $Valor = $_POST['Valor'];
        $idActividad = $_POST['idActividad'];
        $id_user = $this->session->getCurrentUser();
        if($this->model->insertarRecurso(['Descripcion' => $Descripcion, 'Tipo' => $Tipo,'Valor' => $Valor, 'idActividad' => $idActividad])){
          $confirmacion = '<div class="alert alert-info text-center" role="alert" >Recurso creado correctamente.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }else{
          $confirmacion = '<div class="alert alert-danger" role="alert" > <strong> ¡Lo sentimos! </strong> el Recurso NO se creó.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div> ';
        }
        $this->view->confirmacion = $confirmacion;
        $this->crearRecurso();
      }

    }

?>
