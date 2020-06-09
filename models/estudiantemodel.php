<?php
require_once 'libs/database.php';

class EstudianteModel extends Model {


    public function __construct() {
        parent::__construct();
    }

    public function loadData($correo) {

      try {
        //SELECT * FROM estudiante JOIN usuario ON estudiante.IdUsuario = usuario.Id WHERE correo_usuario = "_juanalejo2010@gmail.com"
        $query_1 = $this->db->connect()->query("SELECT * FROM `estudiante` WHERE correo_usuario = '$correo' Limit 1;");

        while($row_1 = $query_1->fetch()){
            $idUsuario = $row_1['Id'];
        }

      } catch (PDOException $e) {
          return $e;
      }


    }

    function loadPerfil($correo) {

      //statement return IDadmin

      require_once 'models/Users.php';
      $item = new Users();
        try {



          $items = [];
          $this->db = new Database();
          $query_1 = $this->db->connect()->query("SELECT ID from usuario WHERE usuario.correo_usuario = '$correo'");

            while($row = $query_1->fetch()){
                 $IdAdmin = $row['ID'];
            }

          $query_2 = $this->db->connect()->query("SELECT * FROM estudiante WHERE estudiante.IdUsuario = '$IdAdmin' ");


            while($row_2 = $query_2->fetch()){
              //retornar datos

              $item->cedula = $row_2['CedulaEstudiante'];
              $item->id_documento = $row_2['IdTipoDocumento'];
              $IdDocumento = $row_2['IdTipoDocumento'];
              $item->nombre = $row_2['NombreEstudiante'];
              $item->apellido = $row_2['ApellidoEstudiante'];
              $item->numero_semestre = $row_2['NumeroSemestre'];
              $item->codigo_programa = $row_2['CodigoPrograma'];
              $CodigoPrograma =  $row_2['CodigoPrograma'];

              //statement return NameDocument


            }

            $query_3 = $this->db->connect()->query("SELECT NombreDocumento FROM tipodocumento WHERE tipodocumento.Id = '$IdDocumento' ");

              while($row_3 = $query_3->fetch()){
                $item->tipo_documento = $row_3['NombreDocumento'];

                array_push($items,$item);
              }

              $query_4 = $this->db->connect()->query("SELECT Nombre FROM programa JOIN estudiante ON programa.codigo = estudiante.CodigoPrograma WHERE estudiante.CodigoPrograma = '$CodigoPrograma' ");

              while($row_4 = $query_4->fetch()){
                $item->programa = $row_4['Nombre'];

                array_push($items,$item);
              }

          return $items;
        } catch (PDOException $e) {
            return $e;
        }


    }


    public function updatePerfil($datos) {
      try{
        $cedula = $datos['CedulaEstudiante'];
        $query = $this->db->connect()->prepare("UPDATE `estudiante` SET NombreEstudiante=:nombre,ApellidoEstudiante=:apellido,NumeroSemestre=:semestre WHERE CedulaEstudiante = '$cedula';");
        $query->execute(['nombre' => $datos['NombreEstudiante'], 'apellido' => $datos['ApellidoEstudiante'],  'semestre' => $datos['NumeroSemestre']]);

        return true;
      }catch(PDOException $e){
        return false;
      }


    }

    function updateClave($datos) {

        $correo = $datos['correo_usuario'];

        $clave = $datos['clave_usuario'];

        try {
            $query = $this->db->connect()->prepare("UPDATE `usuario` SET clave_usuario=:clave_usuario WHERE correo_usuario = '$correo';");
            $query->execute(['clave_usuario' => $clave]);
            return true;
        } catch(PDOException $e){
          return false;
        }


    }

    //INSTRUCCIONES CRUD FASE
    function insertarFase($datos) {
      //bindig de datos
      $metodologia = $datos['metodologia'];
      $nombre = $datos['nombre'];
      //encotrar idmetodologia
      $id_metodologia = 0;
      $id_fase = 0;
      $query_metodologia = $this->db->connect()->query("SELECT Id FROM metodologia WHERE Nombre = '$metodologia'");
      while($row = $query_metodologia->fetch()) {
          $id_metodologia = $row['Id'];
      }
      
      
      try {
        //insertar fase

        $insert_fase = $this->db->connect()->prepare("INSERT INTO `fase`(`IdMetodologia`, `IdEstado`, `Nombre`, `Descripcion`, `UrlFase`) 
        VALUES ( :IdMetodologia, :IdEstado, :Nombre, :Descripcion, :UrlFase)");
        $insert_fase->execute(['IdMetodologia' => $id_metodologia, 'IdEstado' => $datos['idestado'], 'Nombre' => $datos['nombre'], 'Descripcion' => $datos['descripcion'], 'UrlFase' => $datos['url']]);
        
        $query_id_fase = $this->db->connect()->query("SELECT Id FROM fase WHERE Nombre = '$nombre'");
        while($_row = $query_id_fase->fetch()) {
            $id_fase = $_row['Id'];
        }

        $insert_objetivo = $this->db->connect()->prepare("INSERT INTO `objetivo`(`Descripcion`, `IdFase`) VALUES ( :Descripcion, :IdFase) ");
        $insert_objetivo->execute(['Descripcion' => $datos['descripcion_objetivo'], 'IdFase' => $id_fase]);

        return true;

      } catch (PDOException $e) {
        return $e;
      }
    }
    function updateFase($datos) {

    }
    function getbyIdFase($id) {

    }

    function loadFases() {

    }

    function deleteFase() {

    }
     //FIN CRUD FASE

    // Inicio CRUD Historia de Usuario
    function insertarHistoriaUsuario($datos) {
      try{
        //Consulta para insertar una nueva Historia de Usuario
        $query_1 = $this->db->connect()->prepare("INSERT INTO `historiausuario`(`NumHistoriaUsuario`, `Prioridad`, `Nombre`, `Descripcion`, `IdModulo`, `IdEstado`) VALUES (:NumHistoriaUsuario,:Prioridad,:Nombre,:Descripcion,:IdModulo,:IdEstado);");
        $query_1->execute(['NumHistoriaUsuario' => $datos['NumHistoriaUsuario'], 'Prioridad' => $datos['Prioridad'], 'Nombre' => $datos['Nombre'], 'Descripcion' => $datos['Descripcion'], 'IdModulo' => $datos['IdModulo'], 'IdEstado' => $datos['IdEstado']]);
        return true;
      }catch(PDOException $e){
        return false;
      }
    }

    // Fin CRUD Historia de Usuario

    // Inicio CRUD Actividad
    function insertarActividad($datos) {
      $nombre_actividad = $datos['Nombre'];
      $id_user = $datos['id_user'];
      $id_actividad = 0;
      $id_estudiante = 0;
      
      try{
        //Consulta para insertar una nueva Historia de Usuario
        $query_1 = $this->db->connect()->prepare("INSERT INTO `actividad`(`Descripcion`, `IdHistoriaUsuario`, `Nombre`) VALUES (:Descripcion,:IdHistoriaUsuario,:Nombre);");
        $query_1->execute(['Descripcion' => $datos['Descripcion'], 'IdHistoriaUsuario' => $datos['IdHistoriaUsuario'] ,'Nombre' => $datos['Nombre']]);

        
        $query_id_actividad = $this->db->connect()->query("SELECT Id FROM actividad WHERE Nombre = '$nombre_actividad'");
        while($row = $query_id_actividad->fetch()) {
           $id_actividad = $row['Id'];
        }
        $query_estudiantes = $this->db->connect()->query("SELECT e.Id as 'IdEstudiante' FROM estudiante as e JOIN usuario as u ON e.IdUsuario = u.Id WHERE u.correo_usuario = '$id_user'");
        while($rowe = $query_estudiantes->fetch()) {
          $id_estudiante = $rowe['IdEstudiante'];
        }
        $query_2 = $this->db->connect()->prepare("INSERT INTO `responsable`(`IdActividad`, `IdEstudiante`) VALUES (:IdActividad, :IdEstudiante)");
        $query_2->execute(['IdActividad' => $id_actividad, 'IdEstudiante' => $id_estudiante]);
        return true;
      }catch(PDOException $e){
        return false;
      }
    }

    // Fin CRUD Historia de Usuario

     //INSTRUCCIONES CRUD FASE
    function insertarModulo($datos) {
      //bindig de datos
      //encotrar idmetodologia
      $id_metodologia = 0;
      $id_fase = 0;
     
      try {
        //insertar MOdulo
        $insert_objetivo = $this->db->connect()->prepare("INSERT INTO `modulo`(`Nombre`,`Descripcion`, `IdFase`) VALUES ( :Nombre, :Descripcion, :IdFase) ");
        $insert_objetivo->execute(['Nombre' => $datos['nombre'],'Descripcion' => $datos['descripcion'], 'IdFase' => $datos['idfase']]);
        

        return true;

      } catch (PDOException $e) {
        return $e;
      }
    }
    function updateModulo($datos) {

    }
    function getbyIdModulo($id) {

    }

    function loadModulo() {

    }

    function deleteModulo() {

    }
     //FIN CRUD FASE

}
?>
