<?php

require_once('libs/database.php');

class UsuarioModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    /*CRUD*/
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

              $rol = $datos['rol'];

              $consulta_3 = $this->db->connect()->query("SELECT * FROM rol WHERE nombre = '$rol' Limit 1;");

              while($fila = $consulta_3->fetch()){
                  $idRol = $fila['id'];
              }

              $consulta_4 = $this->db->connect()->prepare('INSERT INTO rolusuario(IdUsuario, IdRol, _status) VALUES (:idUsuario,:idRol,:estado)');
              $consulta_4->execute(['idUsuario' => $id, 'idRol' => $idRol, 'estado' => 'Pendiente']);



              return true;



          } catch (PDOException $e) {

              return false;
          }




    }

    public function insertEstudiante($datos) {

        $correo = $datos['correo_usuario'];
          try {

              //return IdUsuario
              $query_1 = $this->db->connect()->query("SELECT * FROM `usuario` WHERE correo_usuario = '$correo' Limit 1;");

              while($row_1 = $query_1->fetch()){
                  $idUsuario = $row_1['Id'];
              }

              //statement insert
              $query_2 = $this->db->connect()->prepare('INSERT INTO estudiante (CedulaEstudiante, IdTipoDocumento, NombreEstudiante, ApellidoEstudiante, CodigoPrograma, NumeroSemestre, IdUsuario) VALUES (:CedulaEstudiante, :IdTipoDocumento, :NombreEstudiante, :ApellidoEstudiante, :CodigoPrograma, :NumeroSemestre, :IdUsuario)');
              $query_2->execute(['CedulaEstudiante' => $datos['CedulaEstudiante'], 'IdTipoDocumento' => $datos['IdTipoDocumento'], 'NombreEstudiante'=> $datos['NombreEstudiante'], 'ApellidoEstudiante' => $datos['ApellidoEstudiante'], 'CodigoPrograma' => $datos['CodigoPrograma'], 'NumeroSemestre' => $datos['NumeroSemestre'],
              'IdUsuario'=> $idUsuario ]);

              return true;
          } catch (PDOException $e) {
                  return false;
          }



    }

    public function insertDocente($datos) {

        $correo = $datos['correo_usuario'];
          try {

              //return IdUsuario
              $query_1 = $this->db->connect()->query("SELECT * FROM `usuario` WHERE correo_usuario = '$correo' Limit 1;");

              while($row_1 = $query_1->fetch()){
                  $idUsuario = $row_1['Id'];
              }

              //statement insert
              $query = $this->db->connect()->prepare('INSERT INTO docente (CedulaDocente, IdTipoDocumento, NombreDocente, ApellidoDocente, TituloDocente, IdUsuario) VALUES (:CedulaDocente, :IdTipoDocumento, :NombreDocente, :ApellidoDocente, :TituloDocente, :IdUsuario)');
              $query->execute(['CedulaDocente' => $datos['CedulaDocente'], 'IdTipoDocumento' => $datos['IdTipoDocumento'], 'NombreDocente'=> $datos['NombreDocente'], 'ApellidoDocente' => $datos['ApellidoDocente'], 'TituloDocente' => $datos['TituloDocente'],
              'IdUsuario'=> $idUsuario ]);

              return true;
          } catch (PDOException $e) {
                  return false;
          }



    }



}


?>
