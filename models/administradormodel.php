<?php
require_once 'libs/database.php';

class AdministradorModel extends Model {


    public function __construct() {
        parent::__construct();
    }

     ////////////////////////
    ///CHARGE INDEX THINGS
    ///////////////////////
    public function cargarUsuariosIndex() {

      $query = $this->db->connect()->query("SELECT COUNT(*) AS 'numero_usuarios' FROM usuario ");
      $item = 0;
      try {
        while ($row =$query->fetch()) {
          $item = $row['numero_usuarios'];
        }
        
          return $item;
    
      } catch (PDOException $e) {
        return $e;
      }
    }

    public function cargarProgramaIndex() {

      $query = $this->db->connect()->query("SELECT COUNT(*) AS 'numero_programa' FROM programa ");
      $item = 0;
      try {
        while ($row =$query->fetch()) {
          $item = $row['numero_programa'];
        }
        
          return $item;
    
      } catch (PDOException $e) {
        return $e;
      }
    }

    public function cargarEstadosIndex() {

      $query = $this->db->connect()->query("SELECT COUNT(*) AS 'numero_estados' FROM estado ");
      $item = 0;
      try {
        while ($row =$query->fetch()) {
          $item = $row['numero_estados'];
        }
        
          return $item;
    
      } catch (PDOException $e) {
        return $e;
      }
    }

    ////////////////////////
    ///END INDEX THINGS
    ///////////////////////




    public function insert($datos) {

        /*request 1st-Insert*/

          try {
          //statement 1st insert
              $query_1 = $this->db->connect()->prepare('INSERT INTO usuario (correo_usuario, clave_usuario) VALUES( :correo_usuario, :clave_usuario)');
              $query_1->execute(['correo_usuario' => $datos['correo_usuario'], 'clave_usuario' => $datos['clave_usuario']]);

              $correo = $datos['correo_usuario'];

              $consulta_2 = $this->db->connect()->query("SELECT * FROM `usuario` WHERE correo_usuario = '$correo' Limit 1;");

              while($fila = $consulta_2->fetch()){
                  $id = $fila['Id'];
              }

              $consulta_4 = $this->db->connect()->prepare('INSERT INTO rolusuario(IdUsuario, IdRol, _status) VALUES (:idUsuario,:idRol,:estado)');
              $consulta_4->execute(['idUsuario' => $id, 'idRol' => '1', 'estado' => 'Pendiente']);



              return true;



          } catch (PDOException $e) {

              return false;
          }




    }

    public function insertAdministrador($datos) {

        $correo = $datos['correo_usuario'];
          try {

              //return IdUsuario
              $query_1 = $this->db->connect()->query("SELECT * FROM `usuario` WHERE correo_usuario = '$correo' Limit 1;");

              while($row_1 = $query_1->fetch()){
                  $idUsuario = $row_1['Id'];
              }

              //statement insert
              $query = $this->db->connect()->prepare('INSERT INTO administrador (CedulaAdmin, IdTipoDocumento, NombreAdmin, ApellidoAdmin, IdUsuario) VALUES (:CedulaAdmin, :IdTipoDocumento, :NombreAdmin, :ApellidoAdmin, :IdUsuario)');
              $query->execute(['CedulaAdmin' => $datos['CedulaAdmin'], 'IdTipoDocumento' => $datos['IdTipoDocumento'], 'NombreAdmin'=> $datos['NombreAdmin'], 'ApellidoAdmin' => $datos['ApellidoAdmin'],
              'IdUsuario'=> $idUsuario ]);

              return true;
          } catch (PDOException $e) {
                  return false;
          }



    }

    public function loadUsuarios($correo) {
      require_once 'models/Users.php';

      //
      try {

        $usuarios = [];

        $aux_correo = "";
        //statement return dates
        $query = $this->db->connect()->query("SELECT u.correo_usuario as 'correo' , DATE_FORMAT(u.FechaCreacion_Usuario,' %d-%M-%Y %h:%i %p') as 'fecha', rr.nombre as 'nombre' , r._status as 'estado' FROM usuario u JOIN rolusuario r ON u.Id = r.IdUsuario JOIN rol rr ON rr.id = r.IdRol WHERE u.correo_usuario != '$correo' ORDER BY r._status ='Pendiente' OR r._status ='Suspendido' AND u.FechaCreacion_Usuario  DESC ");

        while($row = $query->fetch()) {
           $item = new Users();
           $item->correo = $row['correo'];
           $aux_correo = $row['correo'];
           $item->fecha_registro = $row['fecha'];
           $item->rol = $row['nombre'];
           $item->estado = $row['estado'];

           if ($item->estado == "Pendiente") {
             $item->font = "warning";
           } elseif ($item->estado == "Activo") {
             $item->font = "success";
           } elseif ($item->estado == "Suspendido") {
             $item->font = "danger";
           }
           //array_push($usuarios,$item);
           //array_push($usuarios,$item);
             //statement return cedulaAdmin
           $query_ced_admin = $this->db->connect()->query("SELECT CedulaAdmin, NombreAdmin FROM administrador JOIN usuario ON administrador.IdUsuario = usuario.Id WHERE usuario.correo_usuario = '$aux_correo' ");

           while ($row_admin = $query_ced_admin->fetch()) {
               $item->_cedulas = $row_admin['CedulaAdmin'];
               $item->_nombres = $row_admin['NombreAdmin'];
           }
           //statement return cedulaEstudiante

            $query_ced_student = $this->db->connect()->query("SELECT CedulaEstudiante, NombreEstudiante FROM estudiante JOIN usuario ON estudiante.IdUsuario = usuario.Id WHERE usuario.correo_usuario = '$aux_correo' ");

            while ($row_student = $query_ced_student->fetch()) {
                $item->_cedulas = $row_student['CedulaEstudiante'];
                $item->_nombres = $row_student['NombreEstudiante'];
            }
           //statement return cedulaDocente

           $query_ced_doc = $this->db->connect()->query("SELECT CedulaDocente, NombreDocente FROM docente JOIN usuario ON docente.IdUsuario = usuario.Id WHERE usuario.correo_usuario = '$aux_correo' ");

           while ($row_doc = $query_ced_doc->fetch()) {
               $item->_cedulas = $row_doc['CedulaDocente'];
               $item->_nombres = $row_doc['NombreDocente'];


           }

           array_push($usuarios,$item);
        }

          return $usuarios;
      } catch (PDOException $e) {
        return $e;
      }


    }

    public function getById($id){
        require_once 'models/Users.php';
        $array = [];
        $query = $this->db->connect()->query("SELECT u.correo_usuario as 'correo' , u.FechaCreacion_Usuario as 'fecha', rr.nombre as 'nombre' , rr.id as 'id', r._status as 'estado' FROM usuario u JOIN rolusuario r ON u.Id = r.IdUsuario JOIN rol rr ON rr.id = r.IdRol where u.correo_usuario = '$id';");
        try{
            //$query->execute(['correo_usuario' => $id]);

            while($row = $query->fetch()){
                $item = new Users();
                $item->correo = $row['correo'];
                $item->id_rol = $row['id'];
                $item->fecha_registro = $row['fecha'];
                $item->rol = $row['nombre'];
                $item->estado = $row['estado'];
                array_push($array,$item);
            }
            return $array;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $correo = $item['correo'];

        $query_1 = $this->db->connect()->query("SELECT Id FROM `usuario` WHERE correo_usuario = '$correo';");

        while($row_1 = $query_1->fetch()){
            $idUsuario = $row_1['Id'];
        }

        $query = $this->db->connect()->prepare("UPDATE rolusuario SET _status = :estado where IdUsuario = '$idUsuario';");
        try{
            $query->execute(['estado' => $item['estado']]);
            return true;
        }catch(PDOException $e){
            return false;
        }

    }

    public function delete($correo){
        try{
            $query = $this->db->connect()->prepare("DELETE FROM usuario WHERE correo_usuario = :correo_usuario");
            $query->execute(['correo_usuario' => $correo['correo']]);
            return true;
        }catch(PDOException $e){
            return $e;
        }
    }

    function loadEstudiante($correo) {

      //statement return IDadmin
      require_once 'models/Users.php';
      $item = new Users();
        try {



          $items = [];
          $this->db = new Database();
          $query_1 = $this->db->connect()->query("SELECT ID, correo_usuario from usuario WHERE usuario.correo_usuario = '$correo'");

            while($row = $query_1->fetch()){
                 $IdAdmin = $row['ID'];
                 $item->correo = $row['correo_usuario'];
            }

          $query_2 = $this->db->connect()->query("SELECT * FROM estudiante WHERE IdUsuario = '$IdAdmin' ");


            while($row_2 = $query_2->fetch()){
              //retornar datos

              $item->cedula = $row_2['CedulaEstudiante'];
              $item->id_documento = $row_2['IdTipoDocumento'];
              $item->nombre = $row_2['NombreEstudiante'];
              $item->apellido = $row_2['ApellidoEstudiante'];
              $item->codigo_programa = $row_2['CodigoPrograma'];
              $item->numero_semestre = $row_2['NumeroSemestre'];
              $codigoPrograma = $row_2['CodigoPrograma'];
              $IdDocumento = $row_2['IdTipoDocumento'];
              //statement return NameDocument


            }
            $query_4 = $this->db->connect()->query("SELECT nombre FROM programa WHERE codigo = '$codigoPrograma' ");

              while($row_3 = $query_4->fetch()){
                $item->programa = $row_3['nombre'];
              }
            $query_3 = $this->db->connect()->query("SELECT NombreDocumento FROM tipodocumento WHERE Id = '$IdDocumento' ");

              while($row_3 = $query_3->fetch()){
                $item->tipo_documento = $row_3['NombreDocumento'];

                array_push($items,$item);
              }


          return $items;
        } catch (PDOException $e) {
            return $e;
        }


    }
    public function updateBull($datos) {
      $estado = $datos['estado'];
      $correo = $datos['correo'];
      $_status = 0;
      switch ($estado) {
        case "Activo":
          
          $query_g_activo = $this->db->connect()->query("SELECT Id FROM `usuario` WHERE correo_usuario = '$correo';");
  
          while($row_1 = $query_g_activo->fetch()){
              $idUsuario = $row_1['Id'];
          }
  
          $query_activo = $this->db->connect()->prepare("UPDATE rolusuario SET _status = :estado where IdUsuario = '$idUsuario';");
          try{
              $query_activo->execute(['estado' => 'Suspendido']);
              return true;
          }catch(PDOException $e){
              return false;
          }
          break;
        case "Pendiente":
          $query_g_pendiente = $this->db->connect()->query("SELECT Id FROM `usuario` WHERE correo_usuario = '$correo';");
  
          while($row_1 = $query_g_pendiente->fetch()){
              $idUsuario = $row_1['Id'];
          }
  
          $query_pendiente = $this->db->connect()->prepare("UPDATE rolusuario SET _status = :estado where IdUsuario = '$idUsuario';");
          try{
              $query_pendiente->execute(['estado' => 'Activo']);
              return true;
          }catch(PDOException $e){
              return false;
          }
          break;
        case "Suspendido":
          $query_g_suspendido = $this->db->connect()->query("SELECT Id FROM `usuario` WHERE correo_usuario = '$correo';");
  
          while($row_1 = $query_g_suspendido->fetch()){
              $idUsuario = $row_1['Id'];
          }
  
          $query_suspendido = $this->db->connect()->prepare("UPDATE rolusuario SET _status = :estado where IdUsuario = '$idUsuario';");
          try{
              $query_suspendido->execute(['estado' => 'Activo']);
              return true;
          }catch(PDOException $e){
              return false;
          }
          break;
        default:
      }
      return false;

    }
    public function updateEstudiante($datos) {
      try{
        $correo = $datos['correo_usuario'];

        $query_1 = $this->db->connect()->query("SELECT ID from usuario WHERE usuario.correo_usuario = '$correo'");

          while($row = $query_1->fetch()){
               $IdAdmin = $row['ID'];
          }

        $query = $this->db->connect()->prepare("UPDATE `estudiante` SET NombreEstudiante=:nombre,CodigoPrograma = :programa, NumeroSemestre = :semestre ,ApellidoEstudiante=:apellido, IdTipoDocumento= :id_documento, CedulaEstudiante =:cedula  WHERE IdUsuario = '$IdAdmin';");
        $query->execute(['cedula' => $datos['CedulaEstudiante'], 'id_documento' => $datos['IdTipoDocumento'],'semestre' => $datos['NumeroSemestre'], 'programa' => $datos['CodigoPrograma'],'nombre' => $datos['NombreEstudiante'], 'apellido' => $datos['ApellidoEstudiante']]);

        return true;
      }catch(PDOException $e){
        return false;
      }


    }
    function loadDocente($correo) {

      //statement return IDadmin
      require_once 'models/Users.php';
      $item = new Users();
        try {



          $items = [];
          $this->db = new Database();
          $query_1 = $this->db->connect()->query("SELECT ID, correo_usuario from usuario WHERE usuario.correo_usuario = '$correo'");

            while($row = $query_1->fetch()){
                 $IdAdmin = $row['ID'];
                 $item->correo = $row['correo_usuario'];
            }

          $query_2 = $this->db->connect()->query("SELECT * FROM docente WHERE IdUsuario = '$IdAdmin' ");


            while($row_2 = $query_2->fetch()){
              //retornar datos

              $item->cedula = $row_2['CedulaDocente'];
              $item->id_documento = $row_2['IdTipoDocumento'];
              $item->nombre = $row_2['NombreDocente'];
              $item->apellido = $row_2['ApellidoDocente'];
              $item->titulo_docente = $row_2['TituloDocente'];
              $IdDocumento = $row_2['IdTipoDocumento'];
              //statement return NameDocument


            }
            
            $query_3 = $this->db->connect()->query("SELECT NombreDocumento FROM tipodocumento WHERE Id = '$IdDocumento' ");

              while($row_3 = $query_3->fetch()){
                $item->tipo_documento = $row_3['NombreDocumento'];

                array_push($items,$item);
              }


          return $items;
        } catch (PDOException $e) {
            return $e;
        }


    }
    public function updateDocente($datos) {
      try{
        $correo = $datos['correo_usuario'];

        $query_1 = $this->db->connect()->query("SELECT ID from usuario WHERE usuario.correo_usuario = '$correo'");

          while($row = $query_1->fetch()){
               $IdAdmin = $row['ID'];
          }

        $query = $this->db->connect()->prepare("UPDATE `docente` SET NombreDocente=:nombre, ApellidoDocente=:apellido, TituloDocente = :titulo,IdTipoDocumento= :id_documento, CedulaDocente =:cedula  WHERE IdUsuario = '$IdAdmin';");
        $query->execute(['cedula' => $datos['CedulaDocente'], 'id_documento' => $datos['IdTipoDocumento'],'titulo' => $datos['TituloDocente'],'nombre' => $datos['NombreDocente'], 'apellido' => $datos['ApellidoDocente']]);

        return true;
      }catch(PDOException $e){
        return false;
      }


    }

    function loadPerfil($correo) {

      //statement return IDadmin
      require_once 'models/Users.php';
      $item = new Users();
        try {



          $items = [];
          $this->db = new Database();
          $query_1 = $this->db->connect()->query("SELECT ID, correo_usuario from usuario WHERE usuario.correo_usuario = '$correo'");

            while($row = $query_1->fetch()){
                 $IdAdmin = $row['ID'];
                 $item->correo = $row['correo_usuario'];
            }

          $query_2 = $this->db->connect()->query("SELECT * FROM administrador WHERE administrador.IdUsuario = '$IdAdmin' ");


            while($row_2 = $query_2->fetch()){
              //retornar datos

              $item->cedula = $row_2['CedulaAdmin'];

              $item->id_documento = $row_2['IdTipoDocumento'];
              $item->nombre = $row_2['NombreAdmin'];
              $item->apellido = $row_2['ApellidoAdmin'];
              $IdDocumento = $row_2['IdTipoDocumento'];
              //statement return NameDocument


            }
            $query_3 = $this->db->connect()->query("SELECT NombreDocumento FROM tipodocumento WHERE tipodocumento.Id = '$IdDocumento' ");

              while($row_3 = $query_3->fetch()){
                $item->tipo_documento = $row_3['NombreDocumento'];

                array_push($items,$item);
              }


          return $items;
        } catch (PDOException $e) {
            return $e;
        }


    }
    public function updatePerfil($datos) {
      try{
        $correo = $datos['correo_usuario'];

        $query_1 = $this->db->connect()->query("SELECT ID from usuario WHERE usuario.correo_usuario = '$correo'");

          while($row = $query_1->fetch()){
               $IdAdmin = $row['ID'];
          }

        $query = $this->db->connect()->prepare("UPDATE `administrador` SET NombreAdmin=:nombre, ApellidoAdmin=:apellido, IdTipoDocumento= :id_documento, CedulaAdmin =:cedula  WHERE IdUsuario = '$IdAdmin';");
        $query->execute(['cedula' => $datos['CedulaAdmin'], 'id_documento' => $datos['IdTipoDocumento'], 'nombre' => $datos['NombreAdmin'], 'apellido' => $datos['ApellidoAdmin']]);

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

    //////////////////////////
    ///START STATEMENT FOR PROGRAMA
    /////////////////////////

    public function insertPrograma($datos) {

      //casteo de variables

      $codigo = $datos['codigo'];
      $programa = $datos['programa'];

      try {
        $insert_programa = $this->db->connect()->prepare("INSERT INTO `programa` (codigo,Nombre) VALUES(:codigo, :Nombre)");
        $insert_programa->execute(['codigo' => $codigo, 'Nombre' => $programa]);
        return true;
    } catch(PDOException $e){
      return false;
    }

    
    }

    public function updatePrograma($datos) {

      $codigo = $datos['codigo'];
      $programa = $datos['programa'];

      try {
        $insert_programa = $this->db->connect()->prepare("UPDATE `programa` SET Nombre=:nombre WHERE codigo = '$codigo'");
        $insert_programa->execute(['nombre' => $programa]);
        return true;
      } catch(PDOException $e){
        return false;
      }

    }

    public function deletePrograma($datos) {

      $codigo = $datos['codigo'];
      //verificar si ese codigo está en uso
      $encontrado = 0;
      $query_estudiantes = $this->db->connect()->query("SELECT CodigoPrograma FROM Estudiante");
      while ($row = $query_estudiantes->fetch()) {
        if ($row[0] == $codigo)
          $encontrado++;
      }

      try {
        if ($encontrado > 0) {
         return false;
        } else {
          $insert_programa = $this->db->connect()->prepare("DELETE FROM programa WHERE codigo = :codigo");
          $insert_programa->execute(['codigo' => $codigo]);
        }
        return true;
      } catch(PDOException $e){
        return false;
      }

    }

    //////////////////////////
    ///END STATEMENT FOR PROGRAMA
    /////////////////////////
    

    //////////////////////////
    ///START STATEMENT FOR ESTADO
    /////////////////////////
 public function insertEstado($datos) {

      //casteo de variables
      $estado = $datos['estado'];

      try {
        $insert_programa = $this->db->connect()->prepare("INSERT INTO `estado` (Nombre) VALUES(:Nombre)");
        $insert_programa->execute(['Nombre' => $estado]);
        return true;
    } catch(PDOException $e){
      return false;
    }

    
    }

    public function updateEstado($datos) {

      $id = $datos['Id'];
      $estado = $datos['estado'];

      try {
        $insert_programa = $this->db->connect()->prepare("UPDATE `estado` SET Nombre=:nombre WHERE Id = '$id'");
        $insert_programa->execute(['nombre' => $estado]);
        return true;
      } catch(PDOException $e){
        return false;
      }

    }

    public function deleteEstado($datos) {

      $id = $datos['Id'];
      //verificar si ese estado está en uso en Proyecto,Historia de Usuario, Fase
      $encontrado = 0;

      //query proyecto
      $query_proyecto = $this->db->connect()->query("SELECT IdEstado FROM proyecto");
      while ($row = $query_proyecto->fetch()) {
        if ($row[0] == $id)
          $encontrado++;
      }

      //query proyecto
      $query_historia = $this->db->connect()->query("SELECT IdEstado FROM historiaUsuario");
      while ($row = $query_historia->fetch()) {
        if ($row[0] == $id)
          $encontrado++;
      }

      //query proyecto
      $query_fase = $this->db->connect()->query("SELECT IdEstado FROM fase");
      while ($row = $query_fase->fetch()) {
        if ($row[0] == $id)
          $encontrado++;
      }

      try {
        if ($encontrado > 0) {
         return false;
        } else {
          $insert_programa = $this->db->connect()->prepare("DELETE FROM estado WHERE Id = :Id");
          $insert_programa->execute(['Id' => $id]);
        }
        return true;
      } catch(PDOException $e){
        return false;
      }

    }



    //////////////////////////
    ///END STATEMENT FOR ESTADO
    /////////////////////////

   





}


?>
