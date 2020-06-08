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
      $this->view->metodologias = [];
      $this->view->fuentes = [];
      $this->view->historiasUsuario = [];
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render() {
      $cabecera = "Inicio";
      $this->view->cabecera = $cabecera;
      $this->view->render('estudiante/index');

    }

    function crearhistoria() {
      $cabecera = "Crear Historia de Usuario";
      $this->view->cabecera = $cabecera;
      $this->view->render('estudiante/historiasusuario/crearhistoria');

    }

    function perfil () {
      $cabecera = "";
      $cabecera = "Perfil";
      $this->view->cabecera = $cabecera;
      $id_correo = $this->session->getCurrentUser();
      $datos_perfil = $this->model->loadPerfil($id_correo);
      $this->view->datos_perfil = $datos_perfil;
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
        
      
        $this->view->render('estudiante/readMetodologia');
    }

    //HISTORIAS DE USUARIO 

    //VISTAS DE INDEX
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

      $consulta = "SELECT hu.id, hu.Nombre 
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
          WHERE us.correo_usuario = 'camiliitoyeahyeah@udi.edu.co';";

        $query = $this->db->connect()->query($consulta);
        $arr = $query->fetchAll();

      $this->view->historiasUsuario = $arr;
      $this->view->cabecera = $cabecera;
      $this->view->render('estudiante/historiasusuario/actividad/index');
    }

    function crearRecurso() {
      $cabecera = "";
      $cabecera = "Recurso";
      $this->view->cabecera = $cabecera;
      $this->view->render('estudiante/historiasusuario/recurso/index');
    }

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
      $this->view->render('estudiante/historiasusuario/modulo/index');
    }

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
      $this->view->render('estudiante/historiasusuario/fase/index');
    }



    }

?>
