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

}
?>
